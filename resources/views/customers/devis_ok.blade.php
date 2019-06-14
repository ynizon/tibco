@extends('layouts.app')

@section('content')

<div id="success">
    <?php
	if ($mail){
		?>
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
	<?php
	}else{
		?>
		<div class="icon icon--order-success svg">
			<svg class="icon" height="72" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M512 0C229.22752 0 0 229.23264 0 512c0 282.77248 229.22752 512 512 512 282.76736 0 512-229.22752 512-512C1024 229.23264 794.76736 0 512 0m203.63776 677.00224a27.32544 27.32544 0 0 1-38.64064 38.64064L512 550.64064l-165.00224 165.00224a27.32544 27.32544 0 0 1-38.64064-38.64064L473.35936 512 308.35712 347.00288a27.32544 27.32544 0 0 1 38.64064-38.64064L512 473.36448l164.99712-165.00224a27.32544 27.32544 0 0 1 38.64064 38.64064L550.63552 512l165.00224 165.00224z" fill="#FA5454" /></svg>
		</div>
		<h4><span>Votre devis n'a pu être envoyé sur votre email</span></h4>
		<br/>
		<small><a href='/admin/quotations/<?php echo $quotation->id;?>/edit'>mais il est disponible en base...</a></small>
		<?php
	}
	?>
</div>

@endsection
