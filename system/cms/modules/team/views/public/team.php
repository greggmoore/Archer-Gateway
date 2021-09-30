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

<section id="our-history">
	<div class="container-fluid">
		<div class="row row-eq-height">
			<div class="col-sm-6 no-padding">
				<div class="left-col pull-right">
					<?php if(isset($content)) echo $content; ?>
				</div>
			</div>
			<div class="col-sm-6 no-padding lge-bg"></div>
		</div>
	</div>
</section>

<section id="exceptional-people-culture">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 no-padding">
				<?php if(isset($section2)) echo $section2; ?>
			</div>
		</div>
	</div>
</section>

<section id="executive-leadership-alt">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			  <div class="editas-tabs">
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a data-target="#executive-leadership" aria-controls="executive-leadership" role="tab" data-toggle="tab">Executive Leadership</a></li>
				    <li role="presentation"><a href="#board-of-directors" aria-controls="board-of-directors" role="tab" data-toggle="tab">Board of Directors</a></li>
				    <li role="presentation"><a href="#founding-scientific-advisors" aria-controls="founding-scientific-advisors" role="tab" data-toggle="tab">Founding Scientific Advisors</a></li>
				  </ul>
				
				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="executive-leadership">
					    <?php echo $this->team_m->get_members(1); ?>
				    </div>
				    <div role="tabpanel" class="tab-pane" id="board-of-directors">
					    <?php echo $this->team_m->get_members(2); ?>
				    </div>
				    <div role="tabpanel" class="tab-pane" id="founding-scientific-advisors">
					    <?php echo $this->team_m->get_members(3); ?>
				    </div>
				  </div>
			  </div>
			</div>
		</div>
	</div>
</section>

<div id="teamModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body"></div>
      <div class="modal-footer">
	      <a class="close-modal" data-dismiss="modal" aria-label="Close" href="javascript:void()">close <i class="fa fa-close"></i></a>
      </div>
    </div>
  </div>
</div>

<?php if($this->uri->segment(3)): ?>
hello
<?php endif; ?>