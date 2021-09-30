<section class="intro text-center">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if(isset($data->section1_title)) echo '<h1 class="h2 text-center subpage-title">'.$data->section1_title.'</h1>'; ?>
				<?php if(isset($data->section1)) echo $data->section1; ?>
				
			</div>
		</div>
	</div>
</section>

<section class="section projects text-center">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-sm-12 offset-sm-0">
				<?php if(isset($projects)) echo $projects; ?>
			</div>
		</div>
	</div>
</section>