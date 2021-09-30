<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo SITE_TITLE; ?> | Admin</title>
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.3.2/css/simple-line-icons.css">
	<link href="/<?php echo $this->template_path ; ?>/assets/fonts/weather-icons/icons.css" rel="stylesheet">
	<link href="/<?php echo $this->template_path ; ?>/assets/fonts/font-mfizz/font-mfizz.css" rel="stylesheet">

	<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="/<?php echo $this->template_path ; ?>/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet">
	<link href="/<?php echo $this->template_path ; ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
	
	<link href="/<?php echo $this->template_path ; ?>/assets/plugins/css-chart/css-chart.css" rel="stylesheet">
	<link href="/<?php echo $this->template_path ; ?>/assets/plugins/jquery.gritter/jquery.gritter.css" rel="stylesheet">
	<link href="/<?php echo $this->template_path ; ?>/assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet">
	<link href="/<?php echo $this->template_path ; ?>/assets/plugins/uploadifive/uploadifive.css" rel="stylesheet">
	
	<link href="/<?php echo $this->template_path ; ?>/assets/plugins/custom-select/custom-select.css" rel="stylesheet">
	<link href="/<?php echo $this->template_path ; ?>/assets/plugins/multiselect/css/multi-select.css" rel="stylesheet">
	<link href="/<?php echo $this->template_path ; ?>/assets/plugins/summernote/summernote.css" rel="stylesheet">
	
	<link href="/<?php echo $this->template_path ; ?>/assets/css/animate.css" rel="stylesheet">
	<link href="/<?php echo $this->template_path ; ?>/assets/css/style.css" rel="stylesheet">
	<link href="/<?php echo $this->template_path ; ?>/assets/css/colors/blue.css" id="theme"  rel="stylesheet">
	<link rel="icon" type="image/x-icon" href="https://www.myrocketlisting.com/data/site/favicon.ico" />
	<?php 
	  	if(isset($css_global)) echo $css_global;
	  	if(isset($css)) echo $css; 
	?>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script src="https://kit.fontawesome.com/65ada7b070.js" crossorigin="anonymous"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php 
	    if( isset($map['js']) ) echo $map['js']; 
	?>

</head>

<body<?php if(isset($page_class)) echo ' class="'.$page_class.'"'; ?>>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-static-top m-b-0">
			<div class="navbar-header">
				<div class="top-left-part">
					<!-- <a class="logo" href="/admin"><img src="/data/site/admin-small-icon-60x60.png" alt="home" class="light-logo" /></a> -->
					<a class="logo" href="/admin"><i class="fa fa-dashboard"></i></a>
				</div>
					<ul class="nav navbar-top-links navbar-left hidden-xs">
					<li><a href="javascript:void(0)" class="logotext"><!--This is logo text--><img style="max-height: 25px;" src="/data/uploads/logo.svg" alt="home" class="light-logo" /></a></li>
				</ul>
				
				<ul class="nav navbar-top-links navbar-right pull-right">
					<li><a class="btn btn-primary site-btn" href="/" title="Live Site">VIEW SITE</a></li>
					<li class="dropdown"> <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <i class="fa fa-user-circle fa-lg"></i> </a>
						<ul class="dropdown-menu dropdown-user animated flipInY">
							<!-- <li><a href="/admin/users/profile"><i class="ti-user"></i> My Profile</a></li> -->
							<li role="separator" class="divider"></li>
							<?php if ($this->ion_auth->in_group(array(1,2))): ?>
							<li><a href="/admin/settings"><i class="ti-settings"></i> Settings</a></li>
							<li role="separator" class="divider"></li>
							<?php endif; ?>
							<li><a href="/admin/logout"><i class="fa fa-power-off"></i> Logout</a></li>
						</ul>
					</li>
				</ul>		      
			</div>
		</nav>
		
		<!-- .Side panel -->
		<div class="side-mini-panel">
			<ul class="mini-nav">

              <div class="togglediv"><a href="javascript:void(0)" id="togglebtn"><i class="ti-menu"></i></a></div>

			  <!-- .Pages -->
              <li<?php echo admin_active_parent($this->uri->segment(2), array('pages'), 0); ?>><a href="/admin/pages" style="text-align: center;" title="Pages"><i class="fa fa-file-text-o"></i></a>
                <div class="sidebarmenu">
                      <h3 class="menu-title">Pages</h3>                     
					  <ul class="sidebar-menu">
						<li<?php if($this->uri->segment(2) == 'pages') echo ' class="active"'; ?>><a href="/admin/pages/index">All Pages</a></li>
					  	<li<?php if($this->uri->segment(3) == 'add') echo ' class="active"'; ?>><a href="/admin/pages/add">Add New</a></li>
					  </ul>
                </div>
              </li>
              <!-- /.Pages -->
              
              <!-- .Blog -->
              <li<?php echo admin_active_parent($this->uri->segment(2), array('posts', 'blog'), 0); ?>><a href="/admin/posts" style="text-align: center;" title="Blog"><i class="fa fa-list-ul"></i></a>
                <div class="sidebarmenu">
                      <h3 class="menu-title">Blog</h3>                     
					  <ul class="sidebar-menu">
						<li<?php if($this->uri->segment(2) == 'posts') echo ' class="active"'; ?>><a href="/admin/posts/index">All Posts</a></li>
					  	<li<?php if($this->uri->segment(3) == 'add') echo ' class="active"'; ?>><a href="/admin/posts/add">Add New</a></li>
					  </ul>
                </div>
              </li>
              <!-- /.Blog -->
              
              <!-- .Users -->
              <?php if ($this->ion_auth->is_admin()) : ?>
              
              <li<?php echo admin_active_parent($this->uri->segment(2), array('users'), 0); ?>><a href="/admin/users/index"><i class="fa fa-user" title="Users"></i></a>
				<div class="sidebarmenu">
					<h3 class="menu-title">User Manager</h3>
					<ul class="sidebar-menu">
						 <li<?php if($this->uri->segment(2) == 'users') echo ' class="active"'; ?>><a href="/admin/users/index">All Users</a></li>
						  <li<?php if($this->uri->segment(3) == 'add') echo ' class="active"'; ?>><a href="/admin/users/add">Add User</a></li>
					</ul>
				</div>
              </li>
              
              
              <li<?php echo admin_active_parent($this->uri->segment(2), array('groups'), 0); ?>><a href="/admin/groups/index"><i class="fa fa-users" title="Users"></i></a>
				<div class="sidebarmenu">
					<h3 class="menu-title">User Groups</h3>
					<ul class="sidebar-menu">
						 <li<?php if($this->uri->segment(2) == 'groups') echo ' class="active"'; ?>><a href="/admin/groups/index">All Groups</a></li>
						  <li<?php if($this->uri->segment(3) == 'add') echo ' class="active"'; ?>><a href="/admin/groups/add">Add User</a></li>
					</ul>
				</div>
              </li>
              
              <!-- .Five9 Clients -->
              <li<?php echo admin_active_parent($this->uri->segment(2), array('five9'), 0); ?>><a href="/admin/five9" style="text-align: center;" title="Five9 Clients"><i class="fa fa-phone-office"></i></a>
                <div class="sidebarmenu">
                      <h3 class="menu-title">Five9 Clients</h3>                     
					  <ul class="sidebar-menu">
						<li<?php if($this->uri->segment(2) == 'five9') echo ' class="active"'; ?>><a href="/admin/five9/index" title="Team">All Clients</a></li>
					  </ul>
                </div>
              </li>
              <!-- /.Leads -->
              
              
              <li<?php echo admin_active_parent($this->uri->segment(2), array('settings'), 0); ?>><a href="/admin/settings" title="Settings"><i class="fa fa-cog"></i></a>
				<div class="sidebarmenu">
					<h3 class="menu-title">Settings</h3>
					<ul class="sidebar-menu">
						 <li<?php if($this->uri->segment(2) == 'settings') echo ' class="active"'; ?>><a href="/admin/settings">Edit</a></li>
					</ul>
				</div>
              </li>
              <?php endif; ?>
              <!-- /.Settings -->              
            </ul>
  		</div>
  		<!-- /.Side panel -->
  		
  		<div id="page-wrapper">
  			<div class="container-fluid">
	  			
	  			
	  			<?php if(isset($partial)) echo $partial; ?>
	  			
  			</div>
  		</div>
		<footer class="footer text-center"> <?php echo date('Y'); ?> &copy; <?php echo COPYRIGHT; ?> | All Rights Reserved.</footer>
	</div>


<script src="/<?php echo $this->template_path ; ?>/assets/js/jquery.slimscroll.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/js/waves.js"></script>
<!--
<script src="/<?php echo $this->template_path ; ?>/assets/plugins/flot/jquery.flot.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
-->
<script src="/<?php echo $this->template_path ; ?>/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/plugins/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/plugins/jquery.easy-pie-chart/easy-pie-chart.init.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/plugins/jquery.gritter/jquery.gritter.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/plugins/switchery/dist/switchery.min.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/plugins/custom-select/custom-select.min.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/plugins/summernote/summernote.min.js"></script>

<script src="/<?php echo $this->template_path ; ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/plugins/select2/select2.js"></script>


<script src="/<?php echo $this->template_path ; ?>/assets/plugins/mask/mask.js"></script>

<script src="/<?php echo $this->template_path ; ?>/assets/plugins/uploadifive/jquery.uploadifive.min.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/plugins/multiselect/js/jquery.multi-select.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/js/custom.min.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/js/validator.js"></script>

<?php 
	if( isset($js_global) ) echo $js_global; 
	if( isset($js) ) echo $js;
?>

</body>
</html>