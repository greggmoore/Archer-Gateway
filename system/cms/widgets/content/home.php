<section class="welcome spacer-20 pt-2 pb-0">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<?php if(isset($title)) echo '<h1>'.$title.'</h1>'; ?>
				</div>
				
				<?php if(isset($content)) echo $content; ?>
				
			</div>
		</div>
	</div>
</section>