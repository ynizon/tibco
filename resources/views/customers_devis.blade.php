@extends('layouts.app')

@section('content')
<link href="/css/color_3.css" rel="stylesheet">
<div class="container">
	{!! Form::open(["id"=>"wrapper",'url' => 'customers', 'method' => 'post','class' => 'form-horizontal panel']) !!}	
	{{ csrf_field() }}
		<div id="form_container">
			<div class="row">
				<div class="col-lg-5">
					<div id="left_form">
						<figure><img src="/img/review_bg.svg" alt=""></figure>
						<h2>Devis</h2>
						<p>Société: <?php echo $customer->company;?><br/>Contact: <?php echo $customer->first_name ." ".$customer->last_name;?></p>
						<h3 id="total"></h3>
						<h3 id="total_points"></h3>
					</div>
				</div>
				<div class="col-lg-7">
					<div id="wizard_container">
						<div id="top-wizard">
							<div id="progressbar"></div>
						</div>
						<input id="website" name="website" type="text" value="">
					
						<div id="middle-wizard">							
							<?php
							$iStep = 0;
							$iNbStep = 0;
							$title = "";
							foreach ($lines as $line1){
								if ($title != $line1->title){
									$iNbStep++;
								}
								$title = $line1->title;
							}
							$title = "";
							foreach ($lines as $line1){
								if ($title != $line1->title){
									$iStep++;
									?>
									<div class="step">
										<h3 class="main_question"><?php echo $line1->title;?><strong><?php echo $iStep."/".$iNbStep;?></strong></h3>
										<div class="row">
											<div class="col-md-3">
											</div>
											<div class="col-md-3" style="text-align:right">
												Essentielle
											</div>
											<div class="col-md-3" style="text-align:right">
												Polyvalence
											</div>
											<div class="col-md-3" style="text-align:right">
												Optimale
											</div>
										</div>
										<?php
										
										foreach ($lines as $line2){
											if ($line2->title == $line1->title){
												?>								
												<div class="row">
													<div class="col-md-3">
														<?php echo $line2->description;?>
													</div>
													<?php 
													for ($k=1;$k<=3;$k++){
														?>
														<div class="col-md-3">
															<input onchange="updateTotal()" onKeyUp="updateTotal()" data-price="<?php echo $line2->points;?>" class="inputday form-control input<?php echo $k;?>" data-multi="<?php switch($k){case 1:echo 5;break;case 2:echo 10;break;case 3:echo 15;break;} ;?>" type="text" name="line<?php echo $k;?>" id="line<?php echo $k;?>" placeholder="">
														</div>
														<?php
													}
													?>														
												
												</div>
												<?php								
											}
										}
									?>
									</div>
								<?php
									$title = $line1->title;
								}
							}
							
							?>
							<div class="submit step">
								<h3 class="main_question">Validation</h3>
								<div class="form-group">
									<textarea name="additional_message" class="form-control" style="height:150px;" placeholder="Note facultative"></textarea>
								</div>
								<div class="form-group">
									<h7>Signature</h7>
									<div id="signature" style="height:150px;"></div>
									
									<input type="hidden" name="signature" id="info" value="" />
									<?php
									/*
									<br/><br/><br/><br/><br/><br/><br/>
									<input type="button" onclick="getSignature()" value="get"/>
									<input type="button" onclick="resetSignature()" value="reset"/>
									<input type="button" onclick="setSignature()" value="set"/>
									*/
									?>
									<script>
									
										function updateTotal(){
											var total = 0;
											var total_points = 0;
											$(".inputday").each(function( index ) {
											   if ($( this ).val() != ""){
													total = total + parseInt($( this ).val()) * $( this ).attr("data-multi") * $( this ).attr("data-price") ;
													total_points = total_points + parseInt($( this ).val()  * $( this ).attr("data-price"));
											   }
											});
											$("#total").html(total + " &euro;");
											$("#total_points").html(total_points + " points");
										}
										
										$(document).ready(function() {
											var $sigdiv = $("#signature");
											$sigdiv.jSignature();
											
										})
										function getSignature(){	
											var $sigdiv = $("#signature");
											var datapair = $sigdiv.jSignature("getData", "base30");
											$("#info").val(datapair);
										}
										
										function setSignature(){	
											var $sigdiv = $("#signature");
											var info = $("#info").val();
											$sigdiv.jSignature("setData", "data:" + info) 
											
										}
										
										function resetSignature(){
											var $sigdiv = $("#signature");
											$sigdiv.jSignature("reset") ;
										}
									</script>
								</div>
							</div>
						</div>
						<div id="bottom-wizard">
							<button type="button" name="backward" class="backward">Précédent </button>
							<button type="button" name="forward" class="forward">Suivant</button>
							<button type="submit" name="process" class="submit">Valider</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	{!! Form::close() !!}
</div>
@endsection
