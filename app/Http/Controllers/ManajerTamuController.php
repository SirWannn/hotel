<?php

namespace App\Http\Controllers;

use App\Models\Tamu;

class ManajerTamuController extends Controller
{
    public function index()
    {
        $tamus = Tamu::all();

        return view('manajer.tamu', compact('tamus'));
    }
}