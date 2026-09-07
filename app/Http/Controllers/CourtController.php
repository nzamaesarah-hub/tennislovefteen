<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index()
    {
        $courts = Court::where('status', 'available')->get();
        
        // Ubah dari 'welcome' ke 'user.index'
        return view('user.index', compact('courts'));
    }
}