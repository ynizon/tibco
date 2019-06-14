<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use DB;

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
    public function index(Request $request)
    {
		$search=$request->input("search");
		if ($search != ""){
			$customers =  DB::table('customers')->where("company","like",$search)->orderBy("company","asc")->orderBy("last_name","asc")->paginate(5);
		}else{
			$customers =  DB::table('customers')->orderBy("company","asc")->orderBy("last_name","asc")->paginate(5);
		}
        
		return view('home',compact("customers","search"));
    }
}
