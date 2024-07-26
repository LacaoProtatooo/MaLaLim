<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Stock;
class OrderController extends Controller
{
    public function dtpopulate()
    {
        $orders = Order::all();
        $orders = $orders->map(function($order) {
            $actions = '<button class="btn btn-primary Order-info" data-id="' . $order->id . '">View Content</button> ';

            if ($order->status == 'pending') {
                $actions .= '<button class="btn btn-primary ml-1 orderapprove" data-stat = "Approve" data-id="' . $order->id . '">Approve</button>';
            } elseif($order->status == 'Shipping') {
                $actions .= '<button class="btn btn-secondary nyaaa" data-stat = "Cancel" data-id="' . $order->id . '">Cancel</button>';
                $actions .= '<button class="btn btn-primary ml-1 order-complete" data-stat = "Complete" data-id="' . $order->id . '">Complete</button>';
            }

            return [
                'order_no' => $order->id,
                'Status' => $order->status,
                'Actions' => $actions,
                'full_data' => $order
            ];
        });

        return response()->json($orders);
    }

    public function contentModal(Request $request)
    {
        $OrderId = $request->input('id');
        $order = Order::find($OrderId);
        $courier = $order->courier->rate;
        $orderDetails = $order->colorJewelry()->with([
            'jewelry',
            'jewelry.classification',
            'jewelry.promos', // Fetch all promos but only use the first
            'jewelry.prices', // Fetch the single price
            'colors'
        ])->withPivot('quantity')->get();

        // Map the results to a simplified structure
        $mappedOrderDetails = $orderDetails->map(function ($colorJewelry) {
            $jewelry = $colorJewelry->jewelry;
            $price = $jewelry->prices; // Fetch the single price

            // Get the first promo if available
            $firstPromo = $jewelry->promos->first();


            return [
                'quantity' => $colorJewelry->pivot->quantity,
                'jewelry' => [

                    'name' => $jewelry->name,
                    'classification' => [

                        'name' => $jewelry->classification->classification,
                    ],
                    'promo' => $firstPromo ? [

                        'discount' => $firstPromo->discountRate,
                        // Add other promo fields as necessary
                    ] : null,
                    'price' => $price ? [
                        'amount' => $price->price,
                        // Add other price fields as necessary
                    ] : null,
                ],
                'colors' =>
                [

                    'name' => $colorJewelry->colors->color,
                ]
            ];
        });

        // Map the order details to be nested under 'colorJewelry'
        $mappedOrder = $mappedOrderDetails->map(function ($item) {
            return [
                'colorJewelry' => $item,
                ];
        });

        return response()->json([
            'success' => true,
            'order' => $mappedOrder,
            'courrier' => $courier,
        ]);


    }

    public function manipulator(Request $request)
    {
        $OrderId = $request->input('order');
        $stat = $request->input('stat');

        $currentOrd = Order::find($OrderId);

        if ($currentOrd) {
            switch($stat) {
                case 'Approve':
                    $currentOrd->status = 'Shipping';
                    break;
                case 'Cancel':
                    $currentOrd->status = 'Canceled';
                    break;
                case 'Complete':
                    $currentOrd->status = 'Completed';

                    // Extract quantities and deduct from stocks
                    $colorJewelryItems = $currentOrd->colorJewelry;
                    foreach ($colorJewelryItems as $colorJewelry) {
                        $quantity = $colorJewelry->pivot->quantity;
                        $colorJewelryId = $colorJewelry->id;

                        // Find the corresponding stock and deduct the quantity
                        $stock = Stock::where('color_jewelry_id', $colorJewelryId)->first();
                        if ($stock) {
                            $stock->quantity -= $quantity;
                            $stock->save();
                        }
                    }
                    break;
                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid status provided'
                    ]);
            }

            $currentOrd->save();

            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ]);
        }
    }
}




