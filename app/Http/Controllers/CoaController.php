<?php

namespace App\Http\Controllers;

use App\Models\Coa;

class CoaController extends Controller
{
    public function index()
    {
        $coa = Coa::all();

        return view('coa.index', compact('coa'));
    }
}
