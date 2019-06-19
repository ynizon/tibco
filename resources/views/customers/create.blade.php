@extends('layouts.app')

@section('content')
<div class="container">
	{!! Form::open(['url' => 'customers', 'method' => 'post',"id"=>"wrapped",'class' => 'form-horizontal panel']) !!}	
        {{ csrf_field() }}
		<div id="form_container">
			<div class="row">
				<div class="col-lg-5">
					<div id="left_form">
						<figure><img src="/images/registration_bg.svg" alt=""></figure>
						<h2>Enregistrement</h2>
						<p>Merci de bien vouloir saisir les informations.</p>
					</div>
				</div>
				<div class="col-lg-7">

					<div id="wizard_container">
						<div id="top-wizard">
							<div id="progressbar"></div>
						</div>
						<!-- /top-wizard -->
						<input id="website" name="website" type="text" value="">
						<!-- Leave for security protection, read docs for details -->
						<div id="middle-wizard">

							<div class="step">
								<h3 class="main_question">Création d'un contact<strong>1/2</strong></h3>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" name="first_name" class="form-control required" placeholder="Prénom" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" name="last_name" class="form-control required" placeholder="Nom" required>
										</div>
									</div>
								</div>
								<!-- /row -->

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input type="email" name="email" class="form-control required" placeholder="Votre Email" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" name="phone" class="form-control" placeholder="Téléphone">
										</div>
									</div>
								</div>
								<!-- /row -->

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" name="company" class="form-control" placeholder="Société" required>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" name="grade" class="form-control" placeholder="Fonction" required>
										</div>
									</div>
								</div>
								<!-- /row -->
							</div>
							<!-- /step-->

							<div class="submit step">
								<h3 class="main_question"><strong>1/2</strong>Message optionnel</h3>
								<div class="form-group">
									<textarea name="note" class="form-control" style="height:150px;" placeholder="..."></textarea>
								</div>
							</div>
							<!-- /step-->
						</div>
						<!-- /middle-wizard -->
						<div id="bottom-wizard">
							<button type="button" name="backward" class="backward">Retour </button>
							<button type="button" name="forward" class="forward">Suivant</button>
							<button type="submit" name="process" class="submit">Valider</button>
						</div>
						<!-- /bottom-wizard -->
						
					</div>
					<!-- /Wizard container -->
				</div>
			</div><!-- /Row -->
		</div><!-- /Form_container -->			
	{!! Form::close() !!}               
</div>
@endsection
