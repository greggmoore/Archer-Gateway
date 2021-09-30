<section id="wrapper" class="login-register">
<div id="infoMessage"><?php echo $message;?></div>
  <div class="login-box">
    <div class="white-box">
	    <header>
		   <img class="img-responsive center-block" src="/data/site/agios-logo-280.png" alt="" />   
	    </header>	      
		<?php echo form_open("/admin/change_password", 'class="form-horizontal form-material" method="post"');?>
		<div class="form-group ">
			<div class="col-xs-12">
				<h3>Change Password</h3>
				<p class="text-muted">Enter your Email and instructions will be sent to you! </p>
			</div>
		</div>
		<div class="form-group ">
			<div class="col-xs-12">
				<?php echo form_input($old_password);?>
			</div>
		</div>
		
		<div class="form-group ">
			<div class="col-xs-12">
				 <?php echo form_input($new_password);?>
			</div>
		</div>
		
		<div class="form-group ">
			<div class="col-xs-12">
				 <?php echo form_input($new_password_confirm);?>
			</div>
		</div>
		 
		
		<div class="form-group text-center m-t-20">
			<div class="col-xs-12">
				<button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
			</div>
		</div>
		
		<?php echo form_input($user_id);?>
		
		<div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Change Password</button>
          </div>
        </div>
		
		<?php echo form_close();?>

    </div>
  </div>
</section>