<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class NpcController extends Controller
{
    public function index()
    {
        Artisan::call('npc');
    }
}
