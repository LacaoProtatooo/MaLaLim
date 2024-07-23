<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Jewelry;
use App\Models\Courier;
use App\Models\Payment;
class CheckoutController extends Controller
{
    public function CheckPop()
    {

        $user = Auth::user();
        $userId = $user->id;
        $userName = $user->fname . " " . $user->lname;
        $userAddress = $user->address;

        $courier = Courier::all();
        $paymentser = Payment::all();

        $Usercart = Cart::where('user_id', $userId)->first();

        if (!$Usercart)
        {
            return response()->json(['success' => false, 'message' => 'No cart found for user'], 404);
        }
        $cartID = $Usercart->id;

        // Retrieve the color_jewelry records along with pivot data
        $colorJewelries = $Usercart->colorJewelry()->with(['jewelry.classification', 'colors', 'jewelry.prices'])->get();
        // return response()->json(['success' => true, 'data' => $colorJewelries]);
        $data = [];
        $subtot = 0;
        $totalDiscount = 0;
        foreach ($colorJewelries as $colorJewelry)
        {
            $jewelryname = $colorJewelry->jewelry->name;
            $color = $colorJewelry->colors->color;
            $classification = $colorJewelry->jewelry->classification->classification;
            $quan = $colorJewelry->pivot->quantity;
            $price = $colorJewelry->jewelry->prices->price;
            $id = $colorJewelry->id;

            $jewelryID = $colorJewelry->jewelry->id;
            $jewelry = Jewelry::with('promos')->find($jewelryID)->first();

            if ($jewelry && $jewelry->promos->isNotEmpty())
            {
                $promo = $jewelry->promos->first();
                $rate = $promo->discountRate ?? 0;
            }
            else
            {
                $rate = 0;

            }

            $discound = $rate * $price;
            $totalDiscount += $discound;

            $subtot = $quan * $price;
                $data[] = [
                    'quantity' => $quan,
                    'jewelry' => $jewelryname,
                    'color' => $color,
                    'classification' => $classification,
                    'price' => $subtot,
                    'pivotId' => $id,
                ];

        }
        $userinfo = [
            'name'=> $userName,
            'address'=> $userAddress,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'user' => $userinfo,
            'totalDc' => $totalDiscount,
            'cour'=> $courier,
            'pay' => $paymentser,
            'totD' =>  $totalDiscount,
            'cartID'=> $cartID,
        ]);
    }

    public function Endo(Request $request)
    {
        // Retrieve inputs
        $colorJewId = $request->input('coJelId');
        $courierId = $request->input('courierId');
        $paymentId = $request->input('payId');
        $CusName = $request->input('name');
        $Address = $request->input('address');
        $CartoId = $request->input('cartId');
        $userId = Auth::id();

        // Validate inputs (Optional, but recommended)
        $request->validate([
            'coJelId' => 'required|array',
            'courierId' => 'required|integer',
            'payId' => 'required|integer',
            'name' => 'required|string',
            'address' => 'required|string',
            'cartId' => 'required|integer',
        ]);

        try {
            // Create a new order
            $order = Order::create([
                'user_id' => $userId,
                'courier_id' => $courierId,
                'payment_id' => $paymentId,
                'name' => $CusName,
                'address' => $Address,
                'status' => 'pending',
            ]);

            // Attach color jewelry to the order with quantities
            foreach ($colorJewId as $colorJewelry) {
                // Ensure $colorJewelry is an associative array with keys 'id' and 'quantity'
                $order->colorJewelry()->attach(
                    $colorJewelry['pivotId'],  // ID of the color jewelry
                    ['quantity' => $colorJewelry['quantity']]  // Additional fields for the pivot table
                );
            }

            // Delete the cart
            Cart::where('id', $CartoId)->delete();

            return response()->json(['success' => true, 'message' => 'Order created successfully']);
        } catch (\Exception $e) {
            // Handle exception
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function OrderPop()
    {
        $userId = Auth::user()->id; // Get the authenticated user's ID

        // Fetch the user's orders with couriers and payments
        $userOrders = Order::where('user_id', $userId)->with('courier', 'payment')->get();

        return response()->json([
            'success' => true,
            'orders' => $userOrders,
        ]);
    }

}

