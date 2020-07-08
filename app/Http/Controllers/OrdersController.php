<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Orders;
use App\Models\Clients;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::all();

        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_full_name' => ['required', 'max:80'],
            'client_phone' => ['required', 'max:25', 'regex:/^\+[0-9]{1}\([0-9]{3}\)[0-9]{3}-[0-9]{4}$/'],
            'address' => ['required', 'max:150'],
            'tariff_id' => ['required', 'numeric'],
            'delivery_date' => ['required', 'date_format:Y-m-d'],
        ]);
        $validator->validate();

        // request data valid
        $client = Clients::updateOrCreate(
            [
                'phone' => $request->input('client_phone'),
            ],
            [
                'full_name' => $request->input('client_full_name')
            ]
        );

        $order = Orders::create([
            'client_id' => $client->id,
            'tariff_id' => $request->input('tariff_id'),
            'address' => $request->input('address'),
            'delivery_date' => $request->input('delivery_date'),
        ]);

        return response()->json(['ok' => 1]);
    }
}
