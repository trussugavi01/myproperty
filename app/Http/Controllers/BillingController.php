<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BillingController extends Controller
{
    public function pricing()
    {
        $plans = SubscriptionPlan::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pricing', compact('plans'));
    }

    public function plans(Request $request)
    {
        $plans = SubscriptionPlan::where('is_active', true)
            ->orderBy('order')
            ->get();

        $currentSubscription = $request->user()->activeSubscription();

        return view('billing.plans', compact('plans', 'currentSubscription'));
    }

    public function checkout(Request $request, SubscriptionPlan $plan)
    {
        $billingCycle = $request->get('cycle', 'monthly');
        $amount = $billingCycle === 'annual' ? $plan->price_annual : $plan->price_monthly;
        
        // Check if user is eligible for free trial
        $user = $request->user();
        $hasUsedTrial = $user->subscriptions()->where('is_trial', true)->exists();
        $trialDays = !$hasUsedTrial ? ($plan->trial_days ?? 30) : 0;

        return view('billing.checkout', compact('plan', 'billingCycle', 'amount', 'trialDays', 'hasUsedTrial'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:subscription_plans,id',
            'billing_cycle' => 'required|in:monthly,annual',
            'payment_method' => 'required|in:card,bank_transfer,scan_to_pay,trial',
        ]);

        $user = auth()->user();
        $plan = SubscriptionPlan::findOrFail($request->plan_id);
        $amount = $request->billing_cycle === 'annual' ? $plan->price_annual : $plan->price_monthly;

        // Check if user is starting a free trial
        $hasUsedTrial = $user->subscriptions()->where('is_trial', true)->exists();
        $startTrial = $request->payment_method === 'trial' && !$hasUsedTrial;

        if ($startTrial) {
            // Create trial subscription
            $trialDays = $plan->trial_days ?? 30;
            
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'subscription_plan_id' => $plan->id,
                'billing_cycle' => $request->billing_cycle,
                'amount' => 0, // Free during trial
                'status' => 'active',
                'is_trial' => true,
                'starts_at' => now(),
                'trial_ends_at' => now()->addDays($trialDays),
                'ends_at' => now()->addDays($trialDays),
            ]);

            return redirect()->route('billing.subscriptions')
                ->with('success', "Your {$trialDays}-day free trial has started! Enjoy all {$plan->name} features.");
        }

        // Create paid subscription
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'subscription_plan_id' => $plan->id,
            'billing_cycle' => $request->billing_cycle,
            'amount' => $amount,
            'status' => 'pending',
            'is_trial' => false,
            'starts_at' => now(),
            'ends_at' => $request->billing_cycle === 'annual' 
                ? now()->addYear() 
                : now()->addMonth(),
        ]);

        // Create payment record
        $payment = Payment::create([
            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
            'transaction_reference' => 'TXN-' . strtoupper(Str::random(12)),
            'amount' => $amount,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        // TODO: Integrate with payment gateway (Paystack/Flutterwave)
        // For now, we'll simulate successful payment
        if ($request->payment_method === 'card') {
            $payment->markAsCompleted();
            $subscription->activate();

            return redirect()->route('billing.subscriptions')
                ->with('success', 'Subscription activated successfully!');
        }

        return redirect()->route('billing.subscriptions')
            ->with('info', 'Payment pending. Please complete the payment process.');
    }

    public function subscriptions(Request $request)
    {
        $user = $request->user();
        
        $activeSubscription = $user->subscriptions()
            ->with('plan')
            ->where('status', 'active')
            ->where('ends_at', '>', now())
            ->first();

        $payments = Payment::where('user_id', $user->id)
            ->with('subscription.plan')
            ->latest()
            ->paginate(10);

        return view('billing.subscriptions', compact('activeSubscription', 'payments'));
    }

    public function cancel(Request $request, Subscription $subscription)
    {
        if ($subscription->user_id !== auth()->id()) {
            abort(403);
        }

        $subscription->cancel();

        return redirect()->back()
            ->with('success', 'Subscription cancelled successfully.');
    }
}
