<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FindingController extends Controller
{
    public function index()
    {
        return view('finding.create');
    }
}