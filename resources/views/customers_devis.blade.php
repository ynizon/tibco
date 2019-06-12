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
							$title = "";
							foreach ($lines as $line1){								
								if ($title != $line1->title){
									$iStep++;
									?>
									<div class="step">
										<h3 class="main_question"><strong><?php echo $iStep;?>/3</strong><?php echo $line1->title;?></h3>
										<div class="row">
											<div class="col-md-3">
											</div>
											<div class="col-md-3">
											1
											</div>
											<div class="col-md-3">
											2
											</div>
											<div class="col-md-3">
											3
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
															<input class="form-control" type="text" name="line<?php echo $k;?>" id="line<?php echo $k;?>" placeholder="">
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
								<h3 class="main_question"><strong>3/3</strong>Send an optional message</h3>
								<div class="form-group">
									<textarea name="additional_message" class="form-control" style="height:150px;" placeholder="Hello world....write your messagere here!"></textarea>
								</div>
								<div class="form-group">
									<div id="signature" class="form-control" style="height:150px;"></div>
									<input type="text" id="info" value="" />
									<input type="button" onclick="getSignature()" value="coco"/>
									<input type="button" onclick="resetSignature()" value="reset"/>
									<input type="button" onclick="setSignature()" value="coco"/>
									<script>
										
										$(document).ready(function() {
											var $sigdiv = $("#signature");
											$sigdiv.jSignature();
											
										})
										function getSignature(){	
											var $sigdiv = $("#signature");
											$sigdiv.jSignature();
											var datapair = $sigdiv.jSignature("getData", "base30");
											$("#info").val(datapair);
										}
										
										function setSignature(){	
											var $sigdiv = $("#signature");
											$sigdiv.jSignature();
											var info = $("#info").val();
											$sigdiv.jSignature("setData", "data:" + info) 
											
										}
										
										function resetSignature(){
											var $sigdiv = $("#signature");
											$sigdiv.jSignature();
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
