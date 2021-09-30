<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, blumoocreative.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, blumoocreative.com
 */

// ------------------------------------------------------------------------
?>

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, blumoocreative.com
 * @package \System\Application\
 * @page Users
 * copyright Copyright (c) 2017, blumoocreative.com
 */

// ------------------------------------------------------------------------
?>
<section class="section1">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="col-md-offset-2">Login</h1>
				<?php if(isset($message)) echo '<div class="alert alert-warning" role="alert">'.$message.'</div>'; ?>	
				<?php echo form_open('login', 'id="loginform" class="form-horizontal form-material" method="post" data-toggle="validator"');?>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
				    <div class="col-sm-10">
					     <?php echo form_input($identity); ?>
				      <div class="help-block with-errors"></div>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
				    <div class="col-sm-10">
				      <?php echo form_input($password); ?>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <div class="checkbox">
				        <label>
				          <input id="remember-me" type="checkbox" name="remember" value="1" checked> Remember me
				        </label>
				      </div>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-primary">Sign in</button>
				    </div>
				  </div>
				 </form>
			</div>
		</div>
	</div>
</section>