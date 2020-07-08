<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Clients;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Clients::all();

        return response()->json($clients);
    }
}
