<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jewelry;
use App\Models\Stock;
use App\Models\User;
use App\Models\Cart;
use Auth;
class ItemController extends Controller
{
    public function home(Request $request)
    {
        $search = $request->input('search');
        $query = Jewelry::with('prices');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $jewelry = $query->paginate(10);

        return response()->json($jewelry);
    }

    public function index()
    {

        return view('home.home');
    }

    public function description($id)
    {
        // Retrieve item details based on $id
        $item = Jewelry::with(['prices', 'classification', 'colors', 'materials'])->find($id); // Assuming you have an Item model
        // dd($item);
        if ($item) {
            return response()->json([
                'success' => true,
                'data' => $item
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Item not found'
            ], 404);
        }
    }

    public function stonks(Request $request)
    {
        // dd($request->input('col'));
        $colID = $request->input('col');
        $IteID = $request->input('ite');

        $jewelry = Jewelry::find($IteID);


        if ($jewelry && $jewelry->colors()->where('color_id', $colID)->exists()) {

            $pivotRecord = $jewelry->colors()->wherePivot('color_id', $colID)->first();

            // dd($pivotRecord->pivot->id);
            $colorJewelryId = $pivotRecord->pivot->id;

            $stonks = Stock::where('color_jewelry_id', $colorJewelryId)->first();
            // dd($stonks);

            return response()->json([
                'success' => true,
                'data' => $stonks
            ]);

        } else {

            return response()->json(['message' => 'Record not found'], 404);
        }
    }
    public function AddFave(Request $request)
    {
        if(!(Auth::user()))
        {
            return view('home.favorites');
        }

        $user = Auth::user();
        $itemId = $request->input('item_id');

        if ($user->jewelries()->where('jewelry_id', $itemId)->exists()) {
            return response()->json(['success' => false, 'message' => 'Item already attached']);
        }

        $user->jewelries()->attach($itemId);

        return response()->json(['success' => true, 'message' => 'Item attached successfully']);
    }

    public function fetchFave()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        // Fetch the user's favorite jewelries
        $list = $user->jewelries()->with('prices')->get();


        return response()->json([
            'success' => true,
            'data' => $list
        ]);
    }
    public function detachJewelry($jewelryId)
    {
        $user = Auth::user();
        $user->jewelries()->detach($jewelryId);

        return response()->json(['success' => true, 'message' => 'Jewelry detached successfully.']);
    }

    public function addCart(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }

        $userId = Auth::id();
        $jewelId = $request->input('item_id');
        $colId = $request->input('col_id');
        $quantity = 1; // Default quantity to 1 if not provided


        $carttz = Cart::where('user_id', $userId)->first();
        if(!$carttz)
        {
            $carttz = Cart::create([
                'user_id' => $userId,
            ]);
        }
        $colorJewelry = $carttz->colorJewelry()
        ->where('jewelry_id', $jewelId)
        ->where('color_id', $colId)
        ->first();


        if($colorJewelry)
        {
            $colorJewelryId = $colorJewelry->id;
            return response()->json([
                'success' => true,
                'colorJewelryId' => $colorJewelryId
            ]);
        }
        // Find the jewelry item
        $jewelry = Jewelry::find($jewelId);
        if (!$jewelry) {
            return response()->json(['error' => 'Jewelry item not found'], 404);
        }

        $pivotRecord = $jewelry->colors()->wherePivot('color_id', $colId)->first();
        if (!$pivotRecord) {
            return response()->json(['error' => 'Color not found for this jewelry item'], 404);
        }

        $colorJewelryId = $pivotRecord->pivot->id;

        // Create or update the cart record with user_id
        $user = Cart::where('user_id', $userId)->first();
        if(!$user)
        {
            $cart = Cart::create([
                'user_id' => $userId,
            ]);
        }
        $cart = Cart::where('user_id', $userId)->first();
        if ($cart) {
            // Check if the relationship method exists
            if (method_exists($cart, 'colorJewelry')) {
                $cart->colorJewelry()->attach($colorJewelryId, ['quantity' => $quantity]);
            } else {
                // Handle the case where the colorJewelry relationship method is missing
                return response()->json(['error' => 'Relationship method colorJewelry is missing'], 500);
            }
        } else {
            // Handle the case where the cart does not exist
            return response()->json(['error' => 'Cart not found'], 404);
        }
        // $cart->colorJewelry()->attach($colorJewelryId, ['quantity' => $quantity]);

        return response()->json(['success' => 'Item added to cart']);
    }






}
