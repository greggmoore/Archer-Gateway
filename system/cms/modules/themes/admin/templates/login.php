<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo SITE_TITLE; ?> Admin</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.3.2/css/simple-line-icons.css">
<!-- animation CSS -->
<link href="/<?php echo $this->template_path ; ?>/assets/css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="/<?php echo $this->template_path ; ?>/assets/css/style.css" rel="stylesheet">
<link href="/<?php echo $this->template_path ; ?>/assets/css/colors/orange.css" id="theme"  rel="stylesheet">
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="icon" type="image/x-icon" href="<?php echo $this->settings->site_url ; ?>/data/site/favicon.ico" />
<?php 
	  	if(isset($css_global)) echo $css_global;
	  	if(isset($css)) echo $css; 
	?>
<script src="https://use.fontawesome.com/9c53db4540.js"></script>
</head>
<body>

<?php if(isset($partial)) echo $partial; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="/<?php echo $this->template_path ; ?>/assets/js/jquery.slimscroll.js"></script>
<script src="/<?php echo $this->template_path ; ?>/assets/js/waves.js"></script>

<script src="/<?php echo $this->template_path ; ?>/assets/js/login.js"></script>
<?php 
	if( isset($js_global) ) echo $js_global; 
	if( isset($js) ) echo $js;
?>
</body>
</html>
