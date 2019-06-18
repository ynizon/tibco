<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use DB;
use Auth;
use TCG\Voyager\Models\Permission;
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
		$customers = DB::table('customers');
		if ($search != ""){
			$customers = $customers->where("company","like",$search);
		}
		if (!Auth::user()->hasRole("admin")){
			$customers = $customers->where("user_id","=",Auth::user()->id);
		}
		$customers = $customers->orderBy("company","asc")->orderBy("last_name","asc")->paginate(5);
        
		return view('home',compact("customers","search"));
    }
}
