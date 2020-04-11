<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       return redirect()->route(auth()->user()->role);
    }

    public function admin()
    {
        return view('admin.dashboard');
    }

    public function staff()
    {
        return view('staff.dashboard');
    }

    public function customer()
    {
        return view('customer.dashboard');
    }

}
