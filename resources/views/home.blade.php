@extends('layouts.app')

@section('content')
<link href="/css/color_2.css" rel="stylesheet">
<div class="container">
	<div id="form_container">
		<div class="row">
			<div class="col-lg-5">
				<div id="left_form">
					<figure><img src="/images/reserve_bg.svg" alt=""></figure>
					<h2>Clients</h2>
					<p></p>
					<a href="/customers/create" id="more_info" ><i class="fa fa-plus"></i></a>
				</div>
			</div>
			<div class="col-lg-7">
				<div id="wizard_container">
					<div id="top-wizard">
						<div id="progressbar"></div>
					</div>
				
				
					<div id="middle-wizard">
						<table class="table table-striped">
							<thead>							
								<tr>
									<td>Société</td>
									<td>Nom</td>
									<td>Action</td>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($customers as $customer){
									?>
									<tr>
										<td><a href='/devis/<?php echo $customer->id;?>'><?php echo $customer->company;?></a></td>
										<td><?php echo $customer->first_name." ".$customer->last_name;?></td>
										<td><a href='/admin/customers/{!! $customer->id !!}/edit'><i class="fa fa-pencil"></i></a>
											&nbsp;&nbsp;<a href='/devis/{!! $customer->id !!}'><i class="fa fa-plus"></i></a>
										</td>
									</tr>
								<?php
								}	
								?>
							</tbody>
					   </table>
					   <script> 
							//Ajoute le bloc de recherche sur le table
							
						</script> 
						{{ $customers->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
   
@endsection
