<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\User;

class ProjectController extends Controller
{
    public function create(){

         $clients = User::where('is_client', true)->get();
        return view('create-project.create-project', compact('clients'));
    }
}
