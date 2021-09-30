<div class="page-header">
	<h2><?php if( isset( $title ) ) echo $title; ?></h2>
	<?php if( isset($description) ) : ?>
	<div classs="cat-description">
		<?php echo $description; ?>
	</div>
	<?php endif; ?>
</div>


<?php if(!empty($posts)): foreach($posts as $key => $post):  echo $this->posts_m->prepare_post($post, $key); endforeach; else: ?>
	<p><em>Sorry, there are no articles to display at the moment. Please check back soon</em></p>
<?php endif; ?>

<?php echo $this->pagination->create_links(); ?>