<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Tariffs;

class IndexController extends Controller
{
    public function show() {
        $tariffs = Tariffs::all();

        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);

        // next day
        $dateStart = Carbon::now()->addDays(1)->startOfDay();
        // week + 1 day
        $dateEnd = Carbon::now()->addDays(8)->startOfDay();

        $week = [];
        while($dateStart < $dateEnd) {
            // можно передать в шаблон и инстанс Carbon, но их нужно клонировать, а они не лёгковесные
            $week[] = [
                'date' => $dateStart->toDateString(),
                'day' => $dateStart->format('l'),
                'date_human' => $dateStart->format('j F Y'),
            ];

            $dateStart->addDays(1);
        }

        return view('index', [
            'tariffs' => $tariffs,
            'week' => $week
        ]);
    }
}
