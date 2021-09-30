<div class="row bg-title">
	<div class="col-lg-12">
		<h4 class="page-title"><?php if( isset($title) ) echo $title; ?></h4>
	</div>
	<div class="col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-left">
			<li><a href="/admin"> Dashboard</a></li>
			<li class="active">Settings</li>
		</ol>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">SETTINGS</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					
					<ul class="nav nav-tabs" role="tablist">
		              <li role="presentation" class="active"><a href="#site" aria-controls="site" role="tab" data-toggle="tab" aria-expanded="true">Site</a></li>
		              <li role="presentation" class=""><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab" aria-expanded="false">Contact</a></li>
		              <li role="presentation" class=""><a href="#location" aria-controls="location" role="tab" data-toggle="tab" aria-expanded="false">Location</a></li>
		              <li role="presentation" class=""><a href="#analytics" aria-controls="analytics" role="tab" data-toggle="tab" aria-expanded="false">Analytics</a></li>
		            </ul>
		            
		           
					<div class="tab-content">
						 <!-- .Site -->
						<div role="tabpanel" class="tab-pane active" id="site">
							<form class="form-material"  data-toggle="validator">
								<input type="hidden" name="update" value="site_settings" />
								<div class="form-group">
									<label for="site_name">Site Name</label>
									<input id="site_name" type="text" name="site_name" value="<?php if( isset($data['site_name']) ) echo $data['site_name']; ?>" class="form-control"  />
								</div>
								
								<div class="form-group">
									<label for="site_domain">Site Domain</label>
									<input id="site_domain" type="text" name="site_domain" value="<?php if( isset($data['site_domain']) ) echo $data['site_domain']; ?>" class="form-control"  />
								</div>
								
								<div class="form-group">
									<label for="public_theme">Public Theme</label>
									<input id="public_theme" type="text" name="public_theme" value="<?php if( isset($data['public_theme']) ) echo $data['public_theme']; ?>" class="form-control"  />
								</div>
								
								<div class="form-group">
									<label for="admin_theme">Admin Theme</label>
									<input id="admin_theme" type="text" name="admin_theme" value="<?php if( isset($data['admin_theme']) ) echo $data['admin_theme']; ?>" class="form-control"  />
								</div>
								
								<div class="form-group">
									<label for="app_path">App Path</label>
									<input id="app_path" type="text" name="app_path" value="<?php if( isset($data['app_path']) ) echo $data['app_path']; ?>" class="form-control disabled" disabled />
								</div>
								
								<div class="form-group submit-row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary submit pull-right">Submit</button>
									</div>
								</div>
							</form>
							<div class="clearfix"></div>
						</div>
						
						 <!-- .Contact -->
						<div role="tabpanel" class="tab-pane" id="contact">
							<form class="form-material"  data-toggle="validator">
								<input type="hidden" name="update" value="contact_settings" />
								
								<div class="form-group">
									<label for="default_email">Email</label>
									<input id="default_email" type="email" name="default_email" value="<?php if( isset($data['default_email']) ) echo $data['default_email']; ?>" class="form-control"  />
								</div>
								
								<div class="form-group">
									<label for="default_telephone">Telephone</label>
									<input id="default_telephone" type="text" name="default_telephone" value="<?php if( isset($data['default_telephone']) ) echo $data['default_telephone']; ?>" class="form-control" />
								</div>
								
								<div class="form-group">
									<label for="default_mobile_phone">Mobile</label>
									<input id="default_mobile_phone" type="text" name="default_mobile_phone" value="<?php if( isset($data['default_mobile_phone']) ) echo $data['default_mobile_phone']; ?>" class="form-control" />
								</div>
								
								<div class="form-group">
									<label for="default_toll_free">Toll Free</label>
									<input id="default_toll_free" type="text" name="default_toll_free" value="<?php if( isset($data['default_toll_free']) ) echo $data['default_toll_free']; ?>" class="form-control" />
								</div>
								
								<div class="form-group">
									<label for="default_fax">Fax</label>
									<input id="default_fax" type="text" name="default_fax" value="<?php if( isset($data['default_fax']) ) echo $data['default_fax']; ?>" class="form-control" />
								</div>
								
								<div class="form-group submit-row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary submit pull-right">Submit</button>
									</div>
								</div>
							</form>
							<div class="clearfix"></div>
						</div>
						
						<!-- .Location -->
						<div role="tabpanel" class="tab-pane" id="location">
							<form class="form-material"  data-toggle="validator">
								<input type="hidden" name="update" value="location_settings" />
								
								<div class="form-group">
									<label for="default_address">Address</label>
									<input id="default_address" type="text" name="default_address" value="<?php if( isset($data['default_address']) ) echo $data['default_address']; ?>" class="form-control" />
								</div>
								
								<div class="form-group">
									<label for="default_address2">Address 2</label>
									<input id="default_address2" type="text" name="default_address2" value="<?php if( isset($data['default_address2']) ) echo $data['default_address2']; ?>" class="form-control" />
								</div>
								
								<div class="form-group">
									<label for="default_city">City</label>
									<input id="default_city" type="text" name="default_city" value="<?php if( isset($data['default_city']) ) echo $data['default_city']; ?>" class="form-control" />
								</div>
								
								<div class="form-group">
									<label for="default_state">State</label>
									<?php echo form_dropdown('default_state', $states, $data['default_state'], 'id="default_state" class="form-control"'); ?>
								</div>
								
								<div class="form-group">
									<label for="default_zipcode">Zip Code</label>
									<input id="default_zipcode" type="text" name="default_zipcode" value="<?php if( isset($data['default_zipcode']) ) echo $data['default_zipcode']; ?>" class="form-control" />
								</div>
								
								<div class="form-group submit-row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary submit pull-right">Submit</button>
									</div>
								</div>
								
							</form>
							<div class="clearfix"></div>
						</div>
						
						<!-- .Analytics -->
						<div role="tabpanel" class="tab-pane" id="analytics">
							<form class="form-material"  data-toggle="validator">
								<input type="hidden" name="update" value="analytics_settings" />
								
								<div class="form-group">
									<label for="ga_profile">Google Analytics Profile</label>
									<input id="ga_profile" type="text" name="ga_profile" value="<?php if( isset($data['ga_profile']) ) echo $data['ga_profile']; ?>" class="form-control" />
								</div>
								
								<div class="form-group">
									<label for="ga_profile">Google Analytics Tracking Code</label>
									<textarea id="ga_tracking_code" name="ga_tracking_code" class="form-control" rows="10">
										<?php if(isset($data['ga_tracking_code'])) echo $data['ga_tracking_code']; ?>
									</textarea>
								</div>
								
								<div class="form-group">
									<label for="ga_profile">Google Analytics Tag Manager</label>
									<textarea id="ga_tag_manager" name="ga_tag_manager" class="form-control" rows="10">
										<?php if(isset($data['ga_tag_manager'])) echo $data['ga_tag_manager']; ?>
									</textarea>
								</div>
								
								<div class="form-group">
									<label for="bing_verification_code">Bing Verification Code</label>
									<input id="bing_verification_code" type="text" name="bing_verification_code" value="<?php if( isset($data['bing_verification_code']) ) echo $data['bing_verification_code']; ?>" class="form-control" />
								</div>
								
								<div class="form-group submit-row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary submit pull-right">Submit</button>
									</div>
								</div>
								
							</form>
							<div class="clearfix"></div>
						</div>
		
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>