<?php

namespace App\Http\Controllers;
use App\Models\Clint;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    //

        public function index()
    {
        
        $clint = Clint::with('cars')->get();
        return response()->json($clint);

    }
 
}
