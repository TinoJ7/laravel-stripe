<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faker = Faker::create();

        // For generating random amount between $1 to $100
        $amount = $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 100) * 100;

        return view('home', compact('amount'));
    }
}
