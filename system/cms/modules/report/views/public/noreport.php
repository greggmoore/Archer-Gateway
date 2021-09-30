<section id="myrocketlisting" class="noreport">
	<div class="container range myrocket">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<h3>Property Data Could Not Be Found</h3>
					<p>We apologize, but we cannot find the data associated with <strong><?php echo $address; ?></strong></p>
					<p>Feel free to contact us <strong><?php echo DEFAULT_TELEPHONE; ?></strong> or fill the contact form out below.</p>
				</div>
			</div>
		</div>
	</div>
	
	<div id="nothankyou-forms" class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Contact MyRocketListing.com</h3>
					</div>
					<div class="panel-body">
						
						<div class="row">
							<div class="col-md-8">
								<div class="thankyou-message">
									<h3>Thank you!</h3>
								</div>
								
								<form id="contact">
								    <input type="hidden" name="lid" value="<?php echo $lid; ?>" />
								    <input type="hidden" name="register" value="true" />
								   	<div class="modal-body">
							          <div class="form-group">
							            <label for="first_name" class="control-label">First Name:</label>
							            <input type="text" class="form-control" id="first_name-name" name="first_name">
							          </div>
							          <div class="form-group">
							            <label for="last_name" class="control-label">Last Name:</label>
							            <input type="text" class="form-control" id="last_name" name="last_name">
							          </div>
							          <div class="form-group">
							            <label for="email" class="control-label">Email:</label>
							            <input type="email" class="form-control" id="email" name="email">
							          </div>
							          <div class="form-group">
							            <label for="phone" class="control-label">Phone:</label>
							            <input type="text" class="form-control" id="phone" name="phone">
							          </div>
							          <div class="form-group">
							            <label for="message-text" class="control-label">Message:</label>
							            <textarea class="form-control" id="message-text" name="message"></textarea>
							          </div>
							      </div>
							      <div class="modal-footer">
							        <button type="submit" class="btn btn-primary send">Send</button>
							      </div>
							      </form>
							</div>
							<div class="col-md-4">
								<h3 class="text-center">CALL US TODAY!<br /><?php echo DEFAULT_TELEPHONE; ?></h3>
								
								<div class="logo-right-col">
									<img class="img-responsive center-block" src="/system/cms/modules/themes/rocket/assets/images/logo/logo_400_new.png" alt="" />

								</div>
								
								<h4 class="text-center">MyRocketListing.com</h4>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
			
		</div>
	</div>
	
</section>