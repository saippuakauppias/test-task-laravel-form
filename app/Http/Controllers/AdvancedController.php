<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvancedController extends Controller
{
    public function show1()
    {
        // скорее всего можно через Eloquent Subquery на созданных моделях, но сходу не вышло написать + не ясно как он построит запрос
        $data = DB::select(
            'select
                clients.id,
                clients.full_name,
                (
                    select count(orders.id)
                    from orders
                    left join tariffs on tariffs.id = orders.tariff_id
                    where orders.client_id = clients.id and tariffs.price < 1000
                ) as count1,
                (
                    select count(orders.id)
                    from orders
                    left join tariffs on tariffs.id = orders.tariff_id
                    where orders.client_id = clients.id and tariffs.price > 1000
                ) as count2
            from clients'
        );

        return response()->json($data);
    }
}
