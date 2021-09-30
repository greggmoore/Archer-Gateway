			<div class="block">
              <div class="text-img-block">
                <img class="img-fluid" src="/<?php echo $this->template_path ; ?>/assets/images/baghouse-1.jpg" title="<?php if(isset($data->title)) echo $data->title; ?>" alt="<?php if(isset($data->title)) echo $data->title; ?>">
              </div>
              
              <div class="pt-lg-4">
                <?php if(isset($data->title)) echo '<h3 class="sub-title mb-4">'.$data->title.'</h3>'; ?>
              </div>
              <div class="row">
                <div class="col-md-12">
					<?php if(isset($data->section1)) echo $data->section1; ?>
                </div>
              </div>
              
              <div class="row border-top pt-lg-4">
	              <div class="col-md-12">
		              <a class="get_quote btn alt text-light my-2 my-sm-0 mb-4" href="/quote" title="Get a Quote Today!">Get a Quote Today!</a>
	              </div>
              </div>
            </div>