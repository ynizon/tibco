@extends('layouts.app')

@section('content')
<div class="container">
	<div id="form_container">
		<div class="row">
			<div class="col-lg-5">
				<div id="left_form">
					<figure><img src="/img/registration_bg.svg" alt=""></figure>
					<h2><?php echo __("auth.Login");?></h2>
					<p></p>
				</div>
			</div>
			<div class="col-lg-7">
				<br/><br/><br/>
				<form method="POST" action="{{ route('login') }}">
					@csrf

					<?php
					if (env("LDAP_HOSTS") != ""){
						?>
						<div class="form-group row">
							<label for="username" class="col-sm-4 col-form-label text-md-right">{{ __('auth.Username') }}</label>
							<div class="col-md-6">
								<input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
								@if ($errors->has('username'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('username') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<?php
					}else{
						?>
						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right"><?php echo __("auth.E-Mail Address");?></label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<?php
						
					}
					?>

					<div class="form-group row">
						<label for="password" class="col-md-4 col-form-label text-md-right"><?php echo __("auth.Password");?></label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-6 offset-md-4">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

								<label class="form-check-label" for="remember">
									<?php echo __("auth.Remember Me");?>
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-8 offset-md-4">
							<button type="submit" class="btn btn-primary">
								<?php echo __("auth.Login");?>
							</button>

							@if (Route::has('password.request'))
								<a class="btn btn-link" href="{{ route('password.request') }}">
									<?php echo __("auth.Forgot Your Password?");?>
								</a>
							@endif
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>	
</div>
@endsection
