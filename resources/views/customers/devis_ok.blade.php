@extends('layouts.app')

@section('content')

<div id="success">
    <div class="icon icon--order-success svg">
              <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
                <g fill="none" stroke="#8EC343" stroke-width="2">
                  <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                  <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                </g>
              </svg>
     </div>
	<h4><span>Votre devis a été envoyé sur votre email : </span><?php echo Auth::user()->email;?></h4>
	<br/>
	<small>Vous allez être redirigé dans quelques secondes...</small>
	
	<script type="text/javascript">
		function delayedRedirect(){
			window.location = "/";
		}
		
		setTimeout('delayedRedirect()', 8000);
    </script>
</div>

@endsection