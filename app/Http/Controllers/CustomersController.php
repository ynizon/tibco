<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use TCG\Voyager\Models\Category;
use App\Customer;
use App\Line;
use App\Quotation;
use Mail;

class CustomersController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	function create(Request $request){
		return view('customers/create');
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
		return view('customers/edit',compact("customer"));
	}
	
	public function devis($customer_id, Request $request){
		$customer = Customer::find(	$customer_id);
		$lines = Line::orderBy("title")->orderBy("description")->get();
		return view('customers/devis', compact("customer","lines"));
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
	
	public function devis_add(Request $request){
		$id = $request->input("customer_id");
		$customer = Customer::find($id);
		
		/* TEST
		$customer = new Customer();
		$customer->first_name = uniqid();;
		$customer->last_name = uniqid();;
		$customer->company = uniqid();;
		$customer->phone = uniqid();;
		$customer->email = uniqid();;
		$customer->grade = uniqid();;
		$customer->save();
		*/
		
		$details = "Le ".date("d/m/Y h:i:s")."\n";
		$details .= "Client: ".$customer->company ." > ".$customer->grade."\n";
		$details .= $customer->first_name." ".$customer->last_name."\n";
		$details .= $customer->email ." | ".$customer->phone."\n";
		
		$quotation = new Quotation();
		$quotation->signature = $request->input("info_signature");
		$quotation->user_id = Auth::user()->id;
		$quotation->customer_id = $customer->id;
		
		//Recherche de la categorie choisie
		$cat = "";
		foreach (Category::get() as $category){
			if ($request->input("category") == $category->price){
				$cat = $category->name;
			}
		}

		$details .= "------------------------------\n";
		$details .= "Offre : ".$cat."<br/>\n\n";
		
		//Detail du devis
		$title = "";
		$lines = Line::orderBy("title")->orderBy("description")->get();
		foreach ($lines as $line1){
			if ($title != $line1->title){
				$details .= $line1->title.":\n";
				foreach ($lines as $line2){
					if ($line2->title == $line1->title){
						if ($request->input("line_".$line2->id) != ""){
							$details .= " > ".$line2->description.": ". $request->input("line_".$line2->id) ."\n";
						}
					}
				}
				$details .= "------------------------------\n";
			}
			$title = $line1->title;			
		}
		
		$quotation->note = $request->input("note");
		$quotation->details = "";
		$quotation->save();
		
		//Update du lien avec l'identifiant
		$details .= "Lien: ".config("app.url")."/admin/quotations/".$quotation->id."/edit";
		$quotation->details = $details;
		$quotation->save();
		
		//Envoi du mail
		$user = Auth::user();
		try{
			Mail::send('emails.message', ["messages"=>str_replace("\n","<br/>\n",$details)], function ($m)  use ($user) {
				$m->from(config('mail.from.address'), config('mail.from.name'));
				$m->to($user->email, $user->name)->subject(config("app.name").' > Devis');
			});
			$mail = true;
		}catch(\Exception $e){
			$mail = false;
		}
		
		return view('customers/devis_ok',compact('mail','quotation'));
	}
}
