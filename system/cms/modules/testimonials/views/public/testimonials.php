<section class="subheader" style="background-image: url(/data/uploads/<?php if(isset($subheader)) echo $subheader; ?>);">
	<div class="subheadline">
		<div class="subheadline_outer">
			<div class="container">ssss</div>
		</div>
	</div>
</section>


<section class="spacer-20">
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