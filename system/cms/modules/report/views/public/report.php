<section id="myrocketlisting">
	<div class="container blur range myrocket">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">MyRocketListing.com Evaluation Report</h3>
					</div>
					<div class="panel-body text-center">
						<div class="row">
							<div class="col-md-12">
								<?php if(isset($results['fulladdress'])) echo '<h3>'.$results['fulladdress'].'</h3>'; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<dl>
									<dt>$<?php echo number_format($results['low']); ?></dt>
										<dd>Low</dd>
								</dl>
							</div>
							<div class="col-md-8">
								<img src="/system/cms/modules/report/assets/images/scorerange_meter.png" class="img-responsive center-block" />
							</div>
							<div class="col-md-2">
								<dl>
									<dt>$<?php echo number_format($results['high']); ?></dt>
										<dd>High</dd>
								</dl>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="rocketmap container blur myrocket">
		<div class="row">
			<div class="col-md-12">
					<?php if( isset( $map['html'] ) ) echo '<div class="gmap">'.$map['html'].'</div>'; ?>
			</div>
		</div>
	</div>
	
	<div id="nothankyou-form" class="container">
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
								<h3 class="text-center">CALL US TODAY! (503) 847-9210</h3>
								<img class="img-responsive center-block" src="/system/cms/modules/themes/default/assets/images/logo/logo_428x428.png" alt="" />
								<h4 class="pull-right">MyRocketListing.com</h4>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
			
		</div>
	</div>
</section>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tell Us a Little About Yourself!</h4>
      </div>
       <form id="register">
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
        <button type="submit" class="btn btn-default removeblur nothankyou" data-dismiss="modal">No, thank you!</button>
        <button type="submit" class="btn btn-primary removeblur moreinfo">Yes, I want more info!</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->