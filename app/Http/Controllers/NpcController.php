<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class NpcController extends Controller
{
    public function index()
    {
       return Artisan::call('npc:export');
        return view('welcome');
    }
}
