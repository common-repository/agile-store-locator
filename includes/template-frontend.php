
<script type="text/javascript">
  //if(!((typeof google === 'object' && typeof google.maps === 'object')))
  var asl_configuration = <?php echo json_encode($all_configs); ?>,
    asl_categories      = <?php echo json_encode($all_categories); ?>,
		asl_markers	        = [];
</script>

<div id="asl-storelocator" class="container no-pad storelocator-main asl-p-cont asl-bg-0 asl-text-0">
  <div class="row">
      <div class="col-md-12" id="filter-options">
          <div class="inner-filter"></div>
      </div>
  </div>
  <div class="row">
  	<div class="col-sm-4 col-xs-12 asl-panel">
      <div class="col-xs-12 inside search_filter">
        <p><?php echo __( 'Search Location', 'asl_locator') ?></p>
        <div class="asl-store-search">
            <input type="text" id="auto-complete-search" class="form-control" placeholder="">
            <span><i class="glyphicon glyphicon-screenshot" title="Current Location"></i></span>
        </div>
        <div class="Num_of_store">
          <span><?php echo __('Stores', 'asl_locator') ?>: <span class="count-result">0</span></span>
        </div>    
      </div>
      <!--  Panel Listing -->
      <div id="panel" class="storelocator-panel">
      	<div class="asl-overlay" id="map-loading">
          <div class="white"></div>
          <div class="loading"><img style="margin-right: 10px;" class="loader" src="<?php echo AGILESTORELOCATOR_URL_PATH ?>public/Logo/loading.gif"><?php echo __('Loading...', 'asl_locator') ?></div>
        </div>
        <div class="panel-cont">
            <div class="panel-inner">
              <div class="col-md-12">
                    <ul id="p-statelist" class="accordion" role="tablist" aria-multiselectable="true">
                  </ul>
              </div>
            </div>
        </div>
        <div class="directions-cont hide">
          <div class="agile-modal-header">
            <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
            <h4><?php echo __('Directions', 'asl_locator') ?></h4>
          </div>
          <div class="rendered-directions"></div>
        </div>
      </div>
  	</div> 
  	<div class="col-sm-8 col-xs-12 asl-map">
      <div class="store-locator">
        <div id="map-canvas"></div>
        <!-- agile-modal -->
        <div id="agile-modal-direction" class="agile-modal fade">
          <div class="agile-modal-backdrop-in"></div>
          <div class="agile-modal-dialog in">
            <div class="agile-modal-content">
              <div class="agile-modal-header">
                <button type="button" class="close-directions close" data-dismiss="agile-modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4><?php echo __('Get Your Directions', 'asl_locator') ?></h4>
              </div>
              <div class="form-group">
                <label for="frm-lbl"><?php echo __('From', 'asl_locator') ?>:</label>
                <input type="text" class="form-control frm-place" id="frm-lbl" placeholder="Enter a Location">
              </div>
              <div class="form-group">
                <label for="frm-lbl"><?php echo __('To', 'asl_locator') ?>:</label>
                <input readonly="true" type="text"  class="directions-to form-control" id="to-lbl" placeholder="Prepopulated Destination Address">
              </div>
              <div class="form-group">
                <span for="frm-lbl"><?php echo __('Show Distance In', 'asl_locator') ?></span>
                <label class="checkbox-inline">
                  <input type="radio" name="dist-type" checked id="rbtn-km" value="0"> KM
                </label>
                <label class="checkbox-inline">
                  <input type="radio" name="dist-type" id="rbtn-mile" value="1"> Mile
                </label>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-default btn-submit"><?php echo __('GET DIRECTIONS', 'asl_locator') ?></button>
              </div>
            </div>
          </div>
        </div>

      </div>
  	</div>
  </div>
  <div class="asl-footer">Powered by Store Locator WordPress | WordPress.org</div>
</div>

<script id="tmpl_list_item" type="text/x-jsrender">
	<div class="item">
    <div class="addr-sec">
    <p class="p-title">{{:title}}</p>
    </div>
  	<div class="clear"></div>
  	<div class="col-md-9 col-xs-9 addr-sec">
    	
    	<p class="p-area"><span class="glyphicon glyphicon-map-marker"></span>{{:address}}</p>
      {{if phone}}
    	<p class="p-area"><span class="glyphicon glyphicon-earphone"></span> <?php echo __( 'Phone','asl_locator') ?>: {{:phone}}</p>
      {{/if}}
      {{if fax}}
        <p class="p-area"><span class="glyphicon glyphicon-fax"></span> Fax:{{:fax}}</p>
      {{/if}}  
      {{if c_names}}
      <p class="p-category"><span class="glyphicon glyphicon-tags"></span> {{:c_names}}</p>
      {{/if}}
  	</div>
    <div class="col-md-3 col-xs-3">
    	<div class="col-xs-5 col-md-12 item-thumb">
      </div>
  	</div>
    <div class="col-xs-12 distance">
        <div class="col-xs-6">
          <p class="p-direction"><span class="s-direction"><?php echo __('Directions', 'asl_locator') ?></span></p>
        </div>
        {{if distance}}
        <div class="col-xs-6">
            <a class="s-distance"><?php echo __( 'Distance','asl_locator') ?>: {{:dist_str}}</a>
        </div>
        {{/if}}
    </div>
  	<div class="clear"/>
  </div>
</script>



<script id="asl_too_tip" type="text/x-jsrender">
  <h3>{{:title}}</h3>
  <div class="infowindowContent">
    <div class="info-addr">
      <div class="address"><span class="glyphicon glyphicon-map-marker"></span>{{:address}}</div>
      <div class="phone"><span class="glyphicon glyphicon-earphone"></span><b>Phone: </b><a href="tel:{{:phone}}">{{:phone}}</a></div>
    </div>
  <div class="asl-buttons"></div>
</div><div class="arrow-down"></div>
</script>

