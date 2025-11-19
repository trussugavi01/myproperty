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

        return view('billing.checkout', compact('plan', 'billingCycle', 'amount'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:subscription_plans,id',
            'billing_cycle' => 'required|in:monthly,annual',
            'payment_method' => 'required|in:card,bank_transfer,scan_to_pay',
        ]);

        $plan = SubscriptionPlan::findOrFail($request->plan_id);
        $amount = $request->billing_cycle === 'annual' ? $plan->price_annual : $plan->price_monthly;

        // Create subscription
        $subscription = Subscription::create([
            'user_id' => auth()->id(),
            'subscription_plan_id' => $plan->id,
            'billing_cycle' => $request->billing_cycle,
            'amount' => $amount,
            'status' => 'pending',
            'starts_at' => now(),
            'ends_at' => $request->billing_cycle === 'annual' 
                ? now()->addYear() 
                : now()->addMonth(),
        ]);

        // Create payment record
        $payment = Payment::create([
            'user_id' => auth()->id(),
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
        $subscriptions = $request->user()
            ->subscriptions()
            ->with('plan')
            ->latest()
            ->paginate(10);

        return view('billing.subscriptions', compact('subscriptions'));
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
