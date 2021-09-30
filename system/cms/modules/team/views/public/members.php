<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------
?>

<section id="header">
	<div class="header">
		<?php if(isset($title)) echo '<h1>'.$title.'</h1>'; ?>
		<div class="content">
		<?php if(isset($header_content)) echo $header_content; ?>
		</div>
	</div>
</section>