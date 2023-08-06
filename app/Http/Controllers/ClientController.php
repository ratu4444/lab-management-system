<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = User::where('is_client', true)
            ->withCount('projects')
            ->paginate(10);

        return view('client.index', compact('clients'));
    }
}
