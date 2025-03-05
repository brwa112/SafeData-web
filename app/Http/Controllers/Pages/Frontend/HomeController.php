<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages\Client;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $clients = Client::query()->all();

        dd($clients);

        return inertia('Pages/Frontend/Home', [
            'clients' => $clients,
        ]);
    }
}
