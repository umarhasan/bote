<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PaymentsController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('YAPPY_BASE_URI'), // Get the base URI from .env
            'timeout'  => 2.0,
        ]);
    }

    public function initiatePayment(Request $request)
    {

        $amount = $request->amount; // Assume the amount is passed from the Flutter app
        $transactionDetails = $request->transactionDetails; // Additional transaction details

        try {
            $response = $this->client->request('POST', '/payments/create', [
                'json' => [
                    'merchantId' => env('YAPPY_MERCHANT_ID'),
                    'secretKey' => env('YAPPY_SECRET_KEY'),
                    'amount' => $amount,
                    'transactionDetails' => $transactionDetails,
                    // 'returnUrl' => route('payments.callback'), // Return URL that Yappy will redirect to
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            return response()->json(['paymentUrl' => $body['paymentUrl']]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paymentCallback(Request $request)
    {
        $status = $request->status; // Assuming Yappy sends 'success' or 'failed'
        // Logic to handle the payment status
        // Update database, etc.

        // Redirect to the Flutter app with a deep link
        return redirect()->to('your_flutter_app_scheme://payment_result?status='.$status);
    }
}
