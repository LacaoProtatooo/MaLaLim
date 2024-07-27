<?php

namespace App\Http\Controllers;
use App\Models\Jewelry;
use App\Models\Classification;
use App\Models\Order;
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

        // $classi = Classification::all();
        // $jewel = $classi->jewelries();
        $labels = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
        $datasets = [
            [
                'label' => 'data 1',
                'data' => [12, 19, 3, 5, 2, 3],
                'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'borderWidth' => 1,
            ],
            [
                'label' => 'data 2',
                'data' => [10, 15, 3, 5, 2, 3],
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
        $labels = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
        $datasets = [
            [
                'label' => 'Data Set 1',
                'data' => [12, 19, 3, 5, 2, 3],
                'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'borderWidth' => 1,
            ],
            [
                'label' => 'Data Set 2',
                'data' => [10, 15, 3, 5, 2, 3],
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

    public function piechart()
    {
        $labels = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
        $datasets = [
            [
                'label' => 'data 1',
                'data' => [12, 19, 3, 5, 2, 3],
                'backgroundColor' => [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                'borderColor' => [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                'borderWidth' => 1,
            ],
        ];

        return response()->json([
            'labels' => $labels,
            'datasets' => $datasets,
        ]);
    }
}
