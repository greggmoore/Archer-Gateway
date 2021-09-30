<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, findmoxie.com
 * @package \System\Application\
 * copyright Copyright (c) 2016, MOXIE.COM
 */

// ------------------------------------------------------------------------

$designation = $member->designation ? ', '.$member->designation : '';
				
$name = $member->fullname ? $member->fullname.$designation : '' ;
				
				
?>

<section id="header">
	<div class="header">
		<?php if(isset($title)) echo '<h1>'.$title.'</h1>'; ?>
		<div class="content">
		<?php if(isset($header_content)) echo $header_content; ?>
		</div>
	</div>
</section>


<section id="member">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				
				<div class="row">
					<div class="col-sm-6">
						<div class="img-wrapper">
							<img class="img-responsive center-block" src="/data/team/<?php echo $member->photo; ?>" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
							<div class="title-box">
								<dl>
									<dt><?php echo $name; ?></dt>
										<dd><?php echo $member->title; ?></dd>
								</dl>
							</div>
						</div>
					</div>
					
					<div class="col-sm-6">
						<?php echo $member->bio; ?>
					</div>
				</div>
				
			</div>
		</div>
		
		<div class="row divider">
			<div class="col-md-10 col-md-offset-1">
				<a class="back" href="#"><i class="fa fa-arrow-circle-o-left"></i> Go Back</a>
			</div>
		</div>
		
	</div>
</section>