<section class="section author-intro">
	<div class="container author">
		<div class="row">
			<div class="col-md-12">
				<?php if( isset($intro) ) echo $intro; ?>
			</div>
		</div>
	</div>
</section>

<section class="section posts">
	<div class="container">
		<div class="row">
			<?php if(!empty($posts)): foreach($posts as $key => $post):  echo $this->posts_m->prepare_post($post, $key); endforeach; else: ?>
					<p><em>Sorry, there are no articles to display at the moment. Please check back soon</em></p>
				<?php endif; ?>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="col-m-12">
			<div class="row">
				<div class="pagination">
	                <?php echo $this->pagination->create_links(); ?>
                </div>
			</div>
		</div>
	</div>
</section>