<!--<div class="pageheader">
      <h2><i class="fa fa-home"></i> Dashboard</h2>
    </div>-->

    <div id="dashboard" class="contentpanel">

      <div class="row">
        <div class="col-md-12 dash-left">

          <div class="panel panel-announcement">
            <div class="panel-heading">
              <h4 class="panel-title alt">DASHBOARD</h4>
            </div>
          </div><!-- panel -->
          
          
          <div class="row panel-quick-page">
            
            <div class="col-md-3 page-blue-panel href" data-href="/admin/pages">
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">Pages</h4>
                </div>
                <div class="panel-body">
                  <div class="page-icon"><i class="fa fa-file-text-o"></i></div>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 page-blue-panel href" data-href="/admin/posts">
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">Blog</h4>
                </div>
                <div class="panel-body">
                  <div class="page-icon"><i class="fa fa-list-ul"></i></div>
                </div>
              </div>
            </div>
            <!--
            <div class="col-md-3 page-blue-panel href" data-href="/admin/leads">
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">Leads</h4>
                </div>
                <div class="panel-body">
                  <div class="page-icon"><i class="fa fa-bullseye"></i></div>
                </div>
              </div>
            </div>
            -->
		
          </div><!-- row -->
          
          <div class="row panel-quick-page">	            
            
                        
            <?php if ($this->ion_auth->is_admin()) : ?>
            <div class="col-md-3 page-blue-panel href" data-href="/admin/users">
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">User Management</h4>
                </div>
                <div class="panel-body">
                  <div class="page-icon"><i class="fa fa-user"></i></div>
                </div>
              </div>
            </div>
            <?php endif; ?>
            
            <?php if ($this->ion_auth->is_admin()) : ?>
            <div class="col-md-3 page-blue-panel href" data-href="/admin/groups">
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">Group Management</h4>
                </div>
                <div class="panel-body">
                  <div class="page-icon"><i class="fa fa-users"></i></div>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 page-blue-panel href" data-href="/admin/settings">
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">Settings</h4>
                </div>
                <div class="panel-body">
                  <div class="page-icon"><i class="fa fa-cog"></i></div>
                </div>
              </div>
            </div>
            <?php endif; ?>
	            
          </div>
          
        </div><!-- col-md-9 -->
        
      </div><!-- row -->

      

    </div><!-- contentpanel -->
