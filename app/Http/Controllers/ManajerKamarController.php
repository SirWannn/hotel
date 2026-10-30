<?php

namespace App\Http\Controllers;

use App\Models\Kamar;

class ManajerKamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::all();

        return view('manajer.kamar', compact('kamars'));
    }
}