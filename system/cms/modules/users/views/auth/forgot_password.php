<section id="wrapper" class="login-register">
<div id="infoMessage"><?php echo $message;?></div>
  <div class="login-box">
    <div class="white-box">	      
		<header>
		   <img class="img-responsive center-block" src="/data/site/agios-logo-280.png" alt="" />   
	    </header>	  
	 <form class="form-horizontal form-material" action="/admin/forgot_password" method="post" accept-charset="utf-8">
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recover Password</h3>
            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">            
            <input type="text" id="identity" class="form-control" name="identity"  placeholder="Enter Email" />
            
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