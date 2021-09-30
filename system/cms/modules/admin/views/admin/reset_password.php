<section id="wrapper" class="login-register">
<div id="infoMessage"><?php echo $message;?></div>
  <div class="login-box">
    <div class="white-box">
	    <header>
		   <img class="img-responsive center-block" src="/data/site/agios-logo-280.png" alt="" />   
	    </header>
	   <form class="form-horizontal form-material" action="/admin/reset_password/<?php echo $code; ?>" method="post" accept-charset="utf-8">		
		<div class="form-group ">
			<div class="col-xs-12">
				<h3>Reset Password</h3>
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
		
		<?php echo form_input($user_id); ?>
		<?php echo form_hidden($csrf); ?>

		<?php echo form_close();?>

    </div>
  </div>
</section>