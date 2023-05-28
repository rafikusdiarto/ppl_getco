<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AkunPremium;
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
        $akun = AkunPremium::all();

        $valid = $akun->where('expired_date', '<', Carbon::now());
        $expired = $akun->where('expired_date', '>', Carbon::now());
        foreach ($valid as $i){
            $user = $i->user_id;
            User::where('id', $user)->update(['is_premium' => true]);
        }
        foreach ($expired as $i){
            $user = $i->user;
            User::where('id', $user)->update(['is_premium' => false]);
        }
        return view('home');
    }
}
