<section id="wrapper" class="login-register">

  <div class="login-box">
    <div class="white-box">
		<header>
			<img class="img-responsive center-block" src="/data/site/agios-logo-280.png" alt="" />   
		</header>  
	  <?php echo $message;?>	      
	  <?php echo form_open("admin/login", 'id="loginform" class="form-horizontal form-material" method="post"');?>
        <h3 class="box-title m-b-20"><?php echo $this->settings->site_title; ?> CMS</h3>
        <div class="form-group ">
          <div class="col-xs-12">
             <?php echo form_input($identity); ?>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <?php echo form_input($password);?>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary pull-left p-t-0">
              <input id="remember-me" type="checkbox" name="remember" value="1" checked>
              <label for="remember-me"> Remember me </label>
            </div>
            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-orange btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
          </div>
        </div>
      <?php echo form_close();?>
      
	  <form id="recoverform" class="form-horizontal form-material" action="/admin/forgot_password" method="post" accept-charset="utf-8">
	  
	  
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recover Password</h3>
            <p class="text-muted">Enter your email below.<br />Reset instructions will be sent to you! </p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input id="identity" class="form-control" name="identity" type="text" required="" placeholder="Username">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
          </div>
        </div>
      <?php echo form_close();?>
    </div>
  </div>
</section>