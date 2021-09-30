<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$articles = $this->posts_m->recent_posts_home(1, 60);
	
?>
<section class="spacer-none">
	
	<div class="container-fluid spacer-20 bg-brown"></div>
	
	<div class="container-fluid no-padding text-center">
		<div class="row row-eq-height no-gutters">
			<div class="col-md-4 col-sm-12 blog-placeholder-image" style="background-image: url(data/uploads/rasa-dogs-HDR-550w.jpg);"></div>
			<div class="col-md-8">
				<div class="blog-placeholder-content">
					<h2>From Our Blog</h2>
					<h5>Properties. People. Places.</h5>
					<hr />
					
					<div class="blog-articles text-left">
						<?php if(isset($articles)) echo $articles; ?>
					</div>
					
					<h5 class="view-all"><a href="/blog" title="From Our Blog - View All Posts">view all</a></h5>
				
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid spacer-20 bg-brown"></div>
</section>