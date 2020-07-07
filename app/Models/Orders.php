<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = ['client_id', 'tariff_id', 'address', 'delivery_date'];
}
