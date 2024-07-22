<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function dtpopulate(){
        $payments = Payment::all();
        $payments = $payments->map(function($payment) {
            return [
            'id' => $payment->id,
            'method' => $payment->method,
            'actions' => '<button class="btn btn-primary payment-edit" data-id="' . $payment->id . '">Details</button> ' .
                           '<button class="btn btn-secondary payment-delete" data-id="' . $payment->id . '">Delete</button>',
            'full_data' => $payment
            ];
        });
        return response()->json($payments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'method' => 'required|string|max:255',
        ]);

        $payment = Payment::create($validatedData);

        return response()->json($payment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }
        
        return response()->json($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $validatedData = $request->validate([
            'method' => 'required|string|max:255',
        ]);

        $payment->update($validatedData);
        return response()->json($payment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->delete();
        return response()->json(['message' => 'Payment deleted successfully'], 200);
    }
}
