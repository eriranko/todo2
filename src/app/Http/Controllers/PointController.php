<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointController extends Controller
{
    public function create() {
        $points = Point::all();

        return view ('create', compact('points'));
    }
}
