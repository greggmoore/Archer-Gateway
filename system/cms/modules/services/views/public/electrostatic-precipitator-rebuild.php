			<div class="block">
              <div class="row">
	              <div class="col-md-6">
		              <div class="text-img-block">
		                <img class="img-fluid" src="/<?php echo $this->template_path ; ?>/assets/images/electrostatic-precipitator-rebuild-1.jpg" alt="">
		              </div>
	              </div>
	              <div class="col-md-6">
		              <div class="text-img-block">
		                <img class="img-fluid" src="/<?php echo $this->template_path ; ?>/assets/images/electrostatic-precipitator-rebuild-4.jpg" alt="">
		              </div>
	              </div>
              </div>
              
              
              <div class="pt-lg-4">
                <?php if(isset($data->title)) echo '<h1 class="sub-title mb-4">'.$data->title.'</h1>'; ?>
              </div>
              <div class="row">
                <div class="col-md-12">
					<?php if(isset($data->section1)) echo $data->section1; ?>
                </div>
              </div>
              <div class="row border-top pt-lg-4">
	              <div class="col-md-12">
		              <a class="get_quote btn alt text-light my-2 my-sm-0 mb-4" href="/request-consultation" title="REQUEST CONSULTATION!">REQUEST CONSULTATION</a>
	              </div>
              </div>
              
            </div>