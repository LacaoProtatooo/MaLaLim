<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\User;
use App\Models\Classification;
use App\Models\Courier;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     *  LABELS = X AXIS: Fixed Data
     *  DATASETS = Data of each Variable , data-array represents
     *             data in corresponding to labels provided
     *
     *  Y AXIS LABELS: NOTHING SINCE IT DEPENDS ON DATA YOU HAVE
     *
     *  Bahala kana mag query xD
     *
     *  -> Linechart pwedeng damihan datasets
     *  -> Barchart 2 dataset lang para hindi packed, usually ata pang compare to ng 2 variables per set label
     *  -> Pie Chart 1 dataset lang to, chopped into pieces accumulating into a whole dataset
     */

    public function linechart(){

        $orders = Order::where('status', 'Completed')->get();

        $labels = [];
        $totalExpendituresByDate = [];
        $totalExpendituresPlusByDate = [];

        foreach ($orders as $order) {
            $date = $order->updated_at->format('F j, Y');
            if (!in_array($date, $labels)) {
                $labels[] = $date;
            }
            $courierRate = $order->courier->rate;

            // Get the user with their role
            $userinfo = User::with('role')->where('id', $order->user_id)->first();

            if ($userinfo->role->title === 'customer') {
                $OrderTotal = 0;  // Initialize OrderTotal for this order

                // Get the colorJewelry items for this order with pivot data
                $colorJewelries = $order->colorjewelry()->withPivot('quantity')->get();

                foreach ($colorJewelries as $colorJewelry) {
                    $price = $colorJewelry->jewelry->prices->price;  // Get the price from the jewelry
                    $quantity = $colorJewelry->pivot->quantity;  // Get the quantity from the pivot table
                    $OrderTotal += $price * $quantity;  // Calculate the total expenditure
                }

                if (!isset($totalExpendituresByDate[$date])) {
                    $totalExpendituresByDate[$date] = 0;
                }
                $totalExpendituresByDate[$date] += $OrderTotal +  $courierRate;  // Add the total expenditure for the date
            }

            if ($userinfo->role->title === 'CustomerPlus') {
                $OrderTotalPlus = 0;  // Initialize OrderTotal for this order

                // Get the colorJewelry items for this order with pivot data
                $colorJewelries = $order->colorjewelry()->withPivot('quantity')->get();

                foreach ($colorJewelries as $colorJewelry) {
                    if ($dc = $colorJewelry->jewelry->promos()->first()) {
                        $promo = $dc->discountRate;
                    } else {
                        $promo = 0;
                    }
                    $price = $colorJewelry->jewelry->prices->price;  // Get the price from the jewelry
                    $quantity = $colorJewelry->pivot->quantity;
                    $totDC = $promo * $price * $quantity;  // Get the quantity from the pivot table
                    $OrderTotalPlus += ($price * $quantity) - $totDC;  // Calculate the total expenditure
                }

                if (!isset($totalExpendituresPlusByDate[$date])) {
                    $totalExpendituresPlusByDate[$date] = 0;
                }
                $totalExpendituresPlusByDate[$date] += $OrderTotalPlus +  $courierRate;  // Add the total expenditure for the date
            }
        }



        // $jewel = $classi->jewelries();

        $datasets = [
            [
                'label' => 'Customers Expenditure',
                'data' =>  $totalExpendituresByDate,
                'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'borderWidth' => 1,
            ],
            [
                'label' => 'CustomersPlus Expenditure',
                'data' =>  $totalExpendituresPlusByDate,
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1,
            ],
        ];

        return response()->json([
            'labels' => $labels,
            'datasets' => $datasets,

        ]);
    }

    public function barchart(){
        $classi = Classification::all();

        $labels = []; // Initialize an empty array to hold the classification labels

        foreach ($classi as $class) {
            $labels[] = $class->classification;
            $completed = $class->jewelries()
            ->whereHas('colorJewelries.orders', function ($query) {
                $query->where('status', 'Completed');
            })
            ->with(['colorJewelries.orders' => function ($query) {
                $query->where('status', 'Completed');
            }])
            ->get()
            ->flatMap(function ($jewelry) {
                return $jewelry->colorJewelries->flatMap(function ($colorJewelry) {
                    return $colorJewelry->orders;
                });
            })
            ->pluck('pivot.quantity')
            ->sum();

            $shipping = $class->jewelries()
            ->whereHas('colorJewelries.orders', function ($query) {
                $query->where('status', 'Shipping');
            })
            ->with(['colorJewelries.orders' => function ($query) {
                $query->where('status', 'Shipping');
            }])
            ->get()
            ->flatMap(function ($jewelry) {
                return $jewelry->colorJewelries->flatMap(function ($colorJewelry) {
                    return $colorJewelry->orders;
                });
            })
            ->pluck('pivot.quantity')
            ->sum();

            $pending = $class->jewelries()
            ->whereHas('colorJewelries.orders', function ($query) {
                $query->where('status', 'pending');
            })
            ->with(['colorJewelries.orders' => function ($query) {
                $query->where('status', 'pending');
            }])
            ->get()
            ->flatMap(function ($jewelry) {
                return $jewelry->colorJewelries->flatMap(function ($colorJewelry) {
                    return $colorJewelry->orders;
                });
            })
            ->pluck('pivot.quantity')
            ->sum();

            $cancelled = $class->jewelries()
            ->whereHas('colorJewelries.orders', function ($query) {
                $query->where('status', 'Cancelled');
            })
            ->with(['colorJewelries.orders' => function ($query) {
                $query->where('status', 'Cancelled');
            }])
            ->get()
            ->flatMap(function ($jewelry) {
                return $jewelry->colorJewelries->flatMap(function ($colorJewelry) {
                    return $colorJewelry->orders;
                });
            })
            ->pluck('pivot.quantity')
            ->sum();

            $comp[] = $completed;
            $pen[] = $pending;
            $ship[] = $shipping;
            $can[] = $cancelled;
        }

        $datasets = [
            [
                'label' => 'Pending',
                'data' => $pen,
                'backgroundColor' => 'rgba(255, 192, 203, 0.2)', // Pink
                'borderColor' => 'rgba(255, 192, 203, 1)',
                'borderWidth' => 1,
            ],
            [
                'label' => 'Shipping',
                'data' => $ship,
                'backgroundColor' => 'rgba(255, 165, 0, 0.2)', // Orange
                'borderColor' => 'rgba(255, 165, 0, 1)',
                'borderWidth' => 1,
            ],
            [
                'label' => 'Completed',
                'data' => $comp,
                'backgroundColor' => 'rgba(75, 192, 192, 0.2)', // Green
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1,
            ],
            [
                'label' => 'Cancelled',
                'data' => $can,
                'backgroundColor' => 'rgba(255, 99, 132, 0.2)', // Red
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'borderWidth' => 1,
            ],
        ];

        return response()->json([
            'labels' => $labels,
            'datasets' => $datasets,
        ]);
    }

    public function piechart()
    {
        $couriers = Courier::all();
        $labels = [];
        $earnings = [];

        // Predefined colors
        $backgroundColors = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ];

        $borderColors = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ];

        // Function to generate random colors
        function getRandomColor() {
            $r = rand(0, 255);
            $g = rand(0, 255);
            $b = rand(0, 255);
            return "rgba($r, $g, $b, 0.2)";
        }

        function getRandomBorderColor() {
            $r = rand(0, 255);
            $g = rand(0, 255);
            $b = rand(0, 255);
            return "rgba($r, $g, $b, 1)";
        }

        foreach ($couriers as $index => $courier) {
            $labels[] = $courier->name;

            // Calculate the number of completed orders for the courier
            $completedOrdersCount = $courier->orders()->where('status', 'Completed')->count();

            // Calculate the total earnings
            $earning = $completedOrdersCount * $courier->rate;
            $earnings[] = $earning;

            // Assign colors
            if ($index >= count($backgroundColors)) {
                $backgroundColors[] = getRandomColor();
                $borderColors[] = getRandomBorderColor();
            }
        }

        $datasets = [
            [
                'label' => 'Earnings',
                'data' => $earnings,
                'backgroundColor' => $backgroundColors,
                'borderColor' => $borderColors,
                'borderWidth' => 1,
            ],
        ];

        return response()->json([
            'labels' => $labels,
            'datasets' => $datasets,
        ]);
    }

}
