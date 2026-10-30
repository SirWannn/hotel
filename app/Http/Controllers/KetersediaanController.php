<?php

namespace App\Http\Controllers;

use App\Models\Kamar;

class KetersediaanController extends Controller
{
    public function index()
    {
        $kamars = Kamar::where('status', 'tersedia')->get();

        return view('tamu.ketersediaan', compact('kamars'));
    }
}