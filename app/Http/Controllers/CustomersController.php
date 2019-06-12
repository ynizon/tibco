<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Customer;
use App\Line;
class CustomersController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	function create(Request $request){
		return view('customers_create');
	}
	function store(Request $request){
		try{
			$customer = new Customer();
			$customer->first_name = $request->input("first_name");
			$customer->last_name = $request->input("last_name");
			$customer->phone = $request->input("phone");
			$customer->company = $request->input("company");
			$customer->grade = $request->input("grade");
			$customer->email = $request->input("email");
			$customer->note = $request->input("note");
			$customer->save();
			
			return redirect('/devis/'.$customer->id)->withOk("Le client a bien été enregistré.");
		}catch(\Exception $e){
			return redirect('/home')->withError("Le client n'a pas été enregistré pour la raison suivante: ".$e->getMessage() );
		}
	}
	
	public function edit($id, Request $request){
		$customer = Customer::find($id);	
		return view('customers_edit',compact("customer"));
	}
	
	public function devis($customer_id, Request $request){
		$customer = Customer::find(	$customer_id);
		$lines = Line::all()->sortBy("title");
		return view('customers_devis', compact("customer","lines"));
	}
	
	public function update(Request $request, $id)
	{
		$customer = Customer::find($id);
		$customer->first_name = $request->input("first_name");
		$customer->last_name = $request->input("last_name");
		$customer->phone = $request->input("phone");
		$customer->company = $request->input("company");
		$customer->grade = $request->input("grade");
		$customer->email = $request->input("email");
		$customer->save();
		
		return redirect('/')->withOk("L'utilisateur " . $request->input('name') . " a été modifié." );			
	}
}
