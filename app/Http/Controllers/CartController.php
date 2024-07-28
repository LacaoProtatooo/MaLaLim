<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\ColorJewelry;
use Auth;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function CartPop()
    {
        $userID = Auth::user()->id;

        $Usercart = Cart::where('user_id', $userID)->first();
        if (!$Usercart) {
            $Usercart = new Cart();
            $Usercart->user_id = $userID;

            $Usercart->save();

        }

        // Retrieve the color_jewelry records along with pivot data
        $colorJewelries = $Usercart->colorJewelry()->with(['jewelry.classification', 'colors', 'jewelry.prices'])->get();


        if ($colorJewelries->isEmpty()) {
            $withItems = false;
        } else {
            $withItems = true;
        }

        // return response()->json(['success' => true, 'data' => $colorJewelries]);
        $data = [];
        $subtot = 0;
        foreach ($colorJewelries as $colorJewelry) {
            $jewelryname = $colorJewelry->jewelry->name;
            $color = $colorJewelry->colors->color;
            $classification = $colorJewelry->jewelry->classification->classification;
            $quan = $colorJewelry->pivot->quantity;
            $price = $colorJewelry->jewelry->prices->price;
            $id = $colorJewelry->id;
            $image_path = $colorJewelry->image_path;


            $subtot = $quan * $price;
                $data[] = [
                    'quantity' => $quan,
                    'jewelry' => $jewelryname,
                    'color' => $color,
                    'classification' => $classification,
                    'price' => $subtot,
                    'pivotId' => $id,
                    'image_path' => $image_path,
                ];

        }
        return response()->json(['success' => true, 'data' => $data, 'items'=> $withItems]);

    }

    public function Increase(Request $request)
    {
        $userID = Auth::user()->id;
        $cartId = Cart::where('user_id', $userID)->pluck('id')->first();
        $colorJewelryId = $request->input('item_id');
        $Quantity = $request->input('quants');
        // Ensure a cart was found for the user
        if (!$cartId) {
            return response()->json(['error' => 'Cart not found for the user.'], 404);
        }

        // Retrieve the Cart instance
        $cart = Cart::find($cartId);
        $colorfirst = $cart->colorJewelry()->where('color_jewelry_id', $colorJewelryId)->first()->stocks()->first()->quantity;
        if($Quantity >= $colorfirst)
        {
            return response()->json(['success' => true, 'message' => 'Failed']);
        }
        $pivotEntry = $cart->colorJewelry()->where('color_jewelry_id', $colorJewelryId)->first();

        if (!$pivotEntry) {
            return response()->json(['error' => 'ColorJewelry item not found in the cart.'], 404);
        }


        $newQuantity = $pivotEntry->pivot->quantity + 1;


        $cart->colorJewelry()->updateExistingPivot($colorJewelryId, ['quantity' => $newQuantity]);

        return response()->json(['success' => true, 'message' => 'Quantity increased successfully.']);
    }


    public function Decrease(Request $request)
    {
        $userID = Auth::user()->id;
        $cartId = Cart::where('user_id', $userID)->pluck('id')->first();
        $colorJewelryId = $request->input('item_id');

        // Ensure a cart was found for the user
        if (!$cartId) {
            return response()->json(['error' => 'Cart not found for the user.'], 404);
        }

        // Retrieve the Cart instance
        $cart = Cart::find($cartId);

        $pivotEntry = $cart->colorJewelry()->where('color_jewelry_id', $colorJewelryId)->first();

        if (!$pivotEntry) {
            return response()->json(['error' => 'ColorJewelry item not found in the cart.'], 404);
        }


        $newQuantity = $pivotEntry->pivot->quantity - 1;


        $cart->colorJewelry()->updateExistingPivot($colorJewelryId, ['quantity' => $newQuantity]);

        return response()->json(['success' => true, 'message' => 'Quantity increased successfully.']);
    }

    public function Remove(Request $request)
    {
        $userID = Auth::user()->id;
        $colorJewelryId = $request->input('item_id');


        $cart = Cart::where('user_id', $userID)->first();

        if (!$cart) {
            return response()->json(['error' => 'Cart not found for the user.'], 404);
        }


        $exists = $cart->colorJewelry()->where('color_jewelry_id', $colorJewelryId)->exists();

        if (!$exists) {
            return response()->json(['error' => 'ColorJewelry item not found in the cart.'], 404);
        }


        $cart->colorJewelry()->detach($colorJewelryId);

        return response()->json(['success' => true, 'message' => 'ColorJewelry item removed from the cart.']);
    }



}
