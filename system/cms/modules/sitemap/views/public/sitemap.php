
<section id="sitemap" class="lead-gen-mod">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h2 class="h2 text-center mt-0"><?php if (isset($title)) echo $title; ?></h2>
				<div class="d-flex">
					<?php echo $this->pages_m->get_active(); ?>
				</div>
			</div>
		</div>
	</div>
</section>