<section class="intro text-center">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if(isset($project->title)) echo '<h2 class="h1 text-center subpage-title">'.$project->title.'</h1>'; ?>
				<?php if(isset($project->description)) echo $project->description; ?>
			</div>
		</div>
	</div>
</section>

<section class="section text-center pb-2">
	<div class="container">
		<?php if(isset($gallery)) echo $gallery; ?>
	</div>
	
</section>


<section class="section">
	<div class="container">
		<div class="row border-blue-top">
			<div class="col-md-12">
				<a class="btn btn-primary wci-btn" href="/projects" title="View All Projects">View All Projects</a>
			</div>
		</div>
	
	</div>
	
</section>