<?php

namespace App\Http\Controllers;

use App\Payment;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Charging the Card
     *
     */
    public function charge(Request $request)
    {
    	try {
            // For initialize Stripe package
    		Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            //For creating a customer in Stripe system
    		$customer = Customer::create(array(
    			'email' => $request->stripeEmail,
    			'source' => $request->stripeToken
    		));

            // For charge money from customer
    		$charge = Charge::create(array(
    			'customer' => $customer->id,
    			'amount' => $request->amount,
    			'currency' => 'usd'
    		));

    		// For storing payment information
    		$storePayment = Payment::create([
    			'id' => $charge->id,
    			'user_id' => auth()->user()->id,
    			'amount' => $charge->amount,
    			'status' => 1

    		]);

    		return redirect('home')->with('success', 'Payment successful!');
    	} catch (\Exception $ex) {
    		$body = $ex->getJsonBody();
    		$error = $body['error'];
    		
    		// For storing payment information
    		$storePayment = Payment::create([
    			'id' => $error['charge'],
    			'user_id' => auth()->user()->id,
    			'amount' => $request->amount,
    			'status' => 0,
    			'failure_reason' => $ex->getMessage()
    		]);

    		return redirect('home')->with('error', $ex->getMessage());
    	}
    }
}
