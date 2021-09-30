<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	$recent_posts = $this->posts_m->recent_posts(8, 120);
?>
<!-- blog single page -->
  <div class="section-space">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="block row blog-details">
            <div class="col-md-12">              
              <?php if(isset($article->lead_image)) echo '<img class="img-fluid" src="/data/uploads/'.$article->lead_image.'" alt="'.$article->title.'" />'; ?>
              <?php if( isset( $article->title ) ) echo '<h1 class="blog-title mt-4">'.ucwords($article->title).'</h1>'; ?>
              <div class="blog-mata">
                <ul>
                  <li class="d-inline-block align-items-center">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <a href="#"><?php if(isset($article->created_ts)) echo date('M jS Y', strtotime($article->created_ts)); ?></a>
                  </li>
                  <li class="d-inline-block  align-items-center">
                    <i class="fa fa-user-o" aria-hidden="true"></i>
                    <?php echo isset($article->fullname) ? '<a href="#">'.$article->fullname.'</a>' : '<a href="#">WCI</a>'; ?></a>
                  </li>
                </ul>
              </div>
              <div class="blog-content">
                <?php if( isset( $article->content ) ) echo $article->content; ?>
                
                <?php if ( $article->is_external == 1 ) echo '<p><a href="'.$article->link.'" title="Read The Full Original Article" rel="external">Read The Full Original Article</a></p>';?>
                
              </div>
              <div class="blog-inner-tag mt-4 mt-xl-5 pt-3 col-md-12 p-0 d-lg-flex justify-content-lg-between align-items-lg-center">
                <div class="col-md-6 p-0 mb-3 mb-xl-0">&nbsp;</div>
                <div class="col-md-6 p-0 mb-4 mb-xl-0">
                  <div class="blog-social-media">
                    <ul>
                      <li><a href="javascript:var w = window.open('http://twitter.com/home?status=WCI+company+news+alert!%21++' + window.location.href, 'twittersharer', 'toolbar=0,status=0,width=400,height=325'); w.focus();"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                      <li><a href="javascript:var w = window.open('http://www.facebook.com/sharer.php?u=' + window.location.href, 'sharer', 'toolbar=0,status=0,width=660,height=400'); w.focus();"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                      <li><a href="javascript:var w = window.open('https://www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark' + window.location.href,'toolbar=0,status=0,width=400,height=325'); w.focus();"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="col-md-12 col-lg-4">
          <div class="blog-sidebar">
            <div class="recent-blog">
              <h6 class="sidebar-recent-blog-title">Recent News</h6>
               <?php if(isset($recent_posts)) echo $recent_posts; ?>
            </div>
    
            <div class="tag mt-4 mt-lg-5">
              <h6 class="sidebar-recent-blog-title">
                Tag
              </h6>
              <div class="tag-group">
               <?php if(isset($keywords)) echo $keywords; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End blog single page -->

<section class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="divider">
	                <a class="btn btn-primary wci-btn" onclick="history.back(-1)" href="#"><i class="fa fa-arrow-circle-o-left"></i> Back</a>
               </div>
			</div>
		</div>
	</div>
</section>
