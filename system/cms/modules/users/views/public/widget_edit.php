<div id="top" class="header-inner">
	<?php 
		if(isset($title)) echo $title; 
		if(isset($subtitle)) echo $subtitle;
	?>
</div>

<?php if($this->uri->segment(3) == 'success'): ?>
<div class="col-md-offset-2 alert alert-success">
	<p>Success! Your micro has been created.</p>
</div>
<?php endif; ?>



<button id="copycode" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
  <span class="glyphicon glyphicon-pencil"></span> Edit
</button>


<div id="iframe-wrapper">
	<?php if( isset( $iframe ) ) echo $iframe ; ?>
</div>
<p id="copysuccess"></p>
<section>
	<code class="copy">Copy</code>
	<pre>
		<code id="codeblock" class="code-block"><?php if( isset( $iframe ) ) echo htmlspecialchars($iframe) ; ?></code>
	</pre>
</section>


<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Customize Widget</h4>
      </div>
      <div class="modal-body">
         <!-- Nav tabs -->
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#wtitle" data-toggle="tab">Title</a></li>
		  <li><a href="#wdescription" data-toggle="tab">Description</a></li>
		  <li><a href="#worigin" data-toggle="tab">Origin</a></li>
		  <li><a href="#wbutton" data-toggle="tab">Button</a></li>
		</ul>
		
		<!-- Tab panes -->
		<div class="tab-content">
		
		  <div class="tab-pane active" id="wtitle">
		  <div class="alert wtitle" style="display: none;"></div>
		  	
			  <form id="widgetTitle" class="form-horizontal" role="form">
				  <input type="hidden" name="widget" value="title" />
				   <input type="hidden" name="id" value="<?php echo $this->uri->segment(4); ?>" />
				  <div class="form-group">
				    
				    <div class="col-sm-12">
						<textarea class="form-control redactor_content" id="title" name="title" rows="3"><?php if(isset($data->title)) echo $data->title ; ?></textarea>
						<span class="help-block">Text that will appear as the title for the widget</span>
				    </div>
				  </div>
				  
				  <div class="form-group">  
					  <div class="col-sm-12">
					      <button type="submit" class="btn btn-block btn-primary">Submit</button>
					  </div>
				  </div>
		  
			  </form>
		  </div>
		  
		  <div class="tab-pane" id="wdescription">
		  <div class="alert wdescription" style="display: none;"></div>
			  
			  <form id="widgetDescription" class="form-horizontal" role="form">
				  <input type="hidden" name="widget" value="description" />
				   <input type="hidden" name="id" value="<?php echo $this->uri->segment(4); ?>" />
				  <div class="form-group">
				    
				    <div class="col-sm-12">
				    	<input type="text" class="form-control" id="description" name="description" value="<?php if(isset($data->description)) echo $data->description ; ?>" />
						<span class="help-block">Simple note to help organize your widgets.</span>
				    </div>
				  </div>
				  
				  <div class="form-group">  
					  <div class="col-sm-12">
					      <button type="submit" class="btn btn-block btn-primary">Submit</button>
					  </div>
				  </div>
		  
			  </form>		  
		  </div>
		  
		  <div class="tab-pane" id="worigin">
		 	 <div class="alert worigin" style="display: none;"></div>
		 	  <form id="widgetOrigin" class="form-horizontal" role="form">
				  <input type="hidden" name="widget" value="origin" />
				   <input type="hidden" name="id" value="<?php echo $this->uri->segment(4); ?>" />
				  <div class="form-group">
				    
				    <div class="col-sm-12">
				    	<input type="text" class="form-control" id="origin" name="origin" value="<?php if(isset($data->origin)) echo $data->origin ; ?>" />
						<span class="help-block">Page URL where the widget will reside. Use this to help track where leads came from</span>
				    </div>
				  </div>
				  
				  <div class="form-group">  
					  <div class="col-sm-12">
					      <button type="submit" class="btn btn-block btn-primary">Submit</button>
					  </div>
				  </div>
		  
			  </form>
		  </div>
		  
		  <div class="tab-pane" id="wbutton">
		  	<div class="alert wbutton" style="display: none;"></div>
			  <form id="widgetButton" class="form-horizontal" role="form">
				  <input type="hidden" name="widget" value="button" />
				   <input type="hidden" name="id" value="<?php echo $this->uri->segment(4); ?>" />
				  
				  <div class="form-group">
				    <div class="col-sm-12">
				    	<input type="text" class="form-control" id="btntxt" name="btntxt" value="<?php if(isset($data->btntxt)) echo $data->btntxt ; ?>" />
						<span class="help-block">Text that will appear within the button.</span>
				    </div>
				  </div>
				  
				  <hr />
				  
				  
				  
				  
			<div class="form-group">
				<div class="col-sm-12">
					<input type="text" class="pick-a-color form-control" id="btncolor" name="btncolor" value="<?php if(isset($data->btncolor)) echo $data->btncolor ; ?>" />
					<span class="help-block">Color of button text.</span>
				</div>
			</div>
			
			
			<div class="form-group">
				<div class="col-sm-12">
					<input type="text" class="pick-a-color form-control" id="btnbkg" name="btnbkg" value="<?php if(isset($data->btnbkg)) echo $data->btnbkg ; ?>" />
					<span class="help-block">Background color of button.</span>
				</div>
			</div>
				  
				  
		  
				  <div class="form-group">  
					  <div class="col-sm-12">
					      <button type="submit" class="btn btn-block btn-primary">Submit</button>
					  </div>
				  </div>
			  </form>
		  </div>
		
		
		
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>