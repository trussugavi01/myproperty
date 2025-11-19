@component('mail::message')
# Payment Confirmation

Thank you for your payment! Your transaction has been successfully processed.

## Payment Details

**Transaction Reference:** {{ $payment->transaction_reference }}  
**Amount:** {{ $payment->formatted_amount }}  
**Payment Method:** {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}  
**Date:** {{ $payment->paid_at->format('F j, Y g:i A') }}

@if($payment->subscription)
**Subscription Plan:** {{ $payment->subscription->plan->name }}  
**Billing Cycle:** {{ ucfirst($payment->subscription->billing_cycle) }}  
**Valid Until:** {{ $payment->subscription->ends_at->format('F j, Y') }}
@endif

@component('mail::button', ['url' => route('billing.subscriptions')])
View Subscription Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
