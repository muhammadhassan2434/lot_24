<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100,  // Convert to cents
                'currency' => 'usd',
                'metadata' => ['order_id' => $request->order_id],
            ]);

            // Store Payment Record
            Payment::create([
                'payment_intent_id' => $paymentIntent->id,
                'order_id' => $request->order_id,
                'amount' => $request->amount,
                'currency' => 'usd',
                'payment_status' => 'pending',  // Initially pending
            ]);

            return response()->json(['clientSecret' => $paymentIntent->client_secret]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function confirmPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = \Stripe\PaymentIntent::retrieve($request->payment_intent_id);

            if ($paymentIntent->status === 'succeeded') {
                // Get card details
                $paymentMethod = $paymentIntent->charges->data[0]->payment_method_details->card ?? null;

                // Update Payment Record
                Payment::where('payment_intent_id', $paymentIntent->id)->update([
                    'payment_status' => 'succeeded',
                    'last4' => $paymentMethod ? $paymentMethod->last4 : null,
                    'brand' => $paymentMethod ? $paymentMethod->brand : null,
                ]);

                return response()->json(['message' => 'Payment successful']);
            } else {
                return response()->json(['error' => 'Payment not completed'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
