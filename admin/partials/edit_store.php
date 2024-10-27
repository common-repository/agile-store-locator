<!-- Container -->
<div class="asl-p-cont">
	<div class="dump-message asl-dumper"></div>
	<h2>Edit Store</h2>
	<form class="form-horizontal" id="frm-addstore">
	<input type="hidden" id="update_id" value="<?php echo $store->id ?>" />
		<fieldset>
		 <div class="row">
			<div class="col-md-8">
				<div class="alert alert-dismissable alert-danger hide">
					 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4>Alert!</h4> <strong>Warning!</strong> Best check yo self <a href="#" class="alert-link">alert link</a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading"><h3 class="panel-title">Store Name</h3></div>

				  	<div class="panel-body">
						<!-- Text input-->
						<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_title">Title</label>
				            <div class="col-sm-9"><input type="text" value="<?php echo $store->title ?>" id="txt_title" name="data[title]" class="form-control validate[required]"></div>
			           	</div>

			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_description">Description</label>
				            <div class="col-sm-9"><textarea id="txt_description" name="data[description]" rows="3"  placeholder="Enter Description" maxlength="500" class="input-medium form-control"><?php echo $store->description ?></textarea></div>
			           	</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading"><h3 class="panel-title">Store Address</h3></div>
				  	<div class="panel-body">
				  		<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_phone">Phone</label>
				            <div class="col-sm-9"><input value="<?php echo $store->phone ?>" type="text" id="txt_phone" name="data[phone]" class="form-control"></div>
			           	</div>
			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_fax">Fax</label>
				            <div class="col-sm-9"><input type="text" value="<?php echo $store->fax ?>" id="txt_fax" name="data[fax]" class="form-control"></div>
			           	</div>
			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_email">Email</label>
				            <div class="col-sm-9"><input type="text" value="<?php echo $store->email ?>" id="txt_email" name="data[email]" class="form-control validate[custom[email]]"></div>
			           	</div>
			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_street">Street</label>
				            <div class="col-sm-9"><input type="text" value="<?php echo $store->street ?>" id="txt_street" name="data[street]" class="form-control validate[required]"></div>
			           	</div>
			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_city">City</label>
				            <div class="col-sm-9"><input type="text" value="<?php echo $store->city ?>" id="txt_city" name="data[city]" class="form-control validate[required]"></div>
			           	</div>
			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_state">State</label>
				            <div class="col-sm-9"><input type="text" value="<?php echo $store->state ?>" id="txt_state" name="data[state]" class="form-control validate[required]"></div>
			           	</div>
			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_postal_code">Postal Code</label>
				            <div class="col-sm-9"><input type="text" value="<?php echo $store->postal_code ?>" id="txt_postal_code" name="data[postal_code]" class="form-control validate[required]"></div>
			           	</div>
			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_country">Country</label>
				            <div class="col-sm-9">
					            <select  id="txt_country" style="width:100%" name="data[country]" class="form-control validate[required]">
					            	<?php foreach($countries as $country): ?>
					            		<option <?php if($store->country == $country->id) echo 'selected' ?> value="<?php echo $country->id ?>"><?php echo $country->country ?></option>
					            	<?php endforeach ?>
					            </select>
				            </div>
			           	</div>

			           	<div class="form-group">
				            <div id="map_canvas" class="map_canvas"></div>
			           	</div>
			           	<p class="help">You can drag the marker to change lat/lng</p>
			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_lng">Longitude</label>
				            <div class="col-sm-9"><input value="<?php echo $store->lng ?>" type="text" id="asl_txt_lng" name="data[lng]" readonly="true" class="form-control validate[required]"></div>
			           	</div>
			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_lat">Latitude</label>
				            <div class="col-sm-9"><input value="<?php echo $store->lat ?>" type="text" id="asl_txt_lat" name="data[lat]" readonly="true" class="form-control validate[required]"></div>
			           	</div>
			           	<div class="dump-message"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading"><h3 class="panel-title">Detailed Information</h3></div>
				  	<div class="panel-body">
						<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_categories">Category</label>
				            <div class="col-sm-9">
				            	<select name="ddl_categories"  id="ddl_categories" multiple class="chosen-select-width form-control">				            	
					            	<?php foreach($category as $catego): ?>
					            	<option 
					            	<?php foreach($storecategory as $scategory ){ ?>
					            		<?php if($scategory->category_id == $catego->id) echo 'selected' ?>
					            		
					            	<?php }?>
					            	value="<?php echo $catego->id ?>"><?php echo $catego->category_name ?></option>	

					            	<?php endforeach ?>
				            	</select>
				            </div>
			           	</div>
			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_url">Site URL</label>
				            <div class="col-sm-9"><input value="<?php echo $store->website ?>" type="text" id="txt_url" name="data[url]" placeholder="http://example.com" class="form-control"></div>
			           	</div>
			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="txt_description_2">Additional Details</label>
				            <div class="col-sm-9"><textarea id="txt_description_2" id="txt_description_2" name="data[description_2]" name="txt_description_1" rows="3"  placeholder="Enter Description" maxlength="500" class="input-medium form-control"><?php echo $store->description_2 ?></textarea></div>
			           	</div>
			           	<div class="form-group">
			           		<label class="col-sm-3 control-label"  for="chk_enabled">Disabled</label>
							<div class="col-sm-9">
								<input name="data[is_disabled]" <?php if($store->is_disabled == 1) echo 'checked' ?> id="chk_disabled" value="1" type="checkbox">
							</div>
						</div>
					    <input type="hidden" name="data[logo_id]" value="<?php echo $storelogo[0]->id ?>" class="logoidclass"/>
						 <div class="form-group">
			           		<label class="col-sm-3 control-label" for="chk_enabled">Logo</label>
							<div class="col-sm-6">
                                <select id="ddl-asl-logos">
                                	<?php foreach($logos as $t):?>
							        <option value="<?php echo $t->id?>" data-imagesrc="<?php echo AGILESTORELOCATOR_URL_PATH.'public/Logo/'.$t->path;?>" data-description="&nbsp;"><?php echo $t->name;?></option>
								    <?php endforeach; ?>
							    </select>
							</div>
							<div class="col-sm-3">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addimagemodel">New Logo</button>
                            </div>
						</div>

						<div class="form-group">
			           		<label class="col-sm-3 control-label" for="chk_enabled">Marker</label>
							<div class="col-sm-6">
                                <select id="ddl-asl-markers">
                                	<option value="1" data-imagesrc="<?php echo AGILESTORELOCATOR_URL_PATH.'public/icon/';?>default.png" data-description="&nbsp;">M1 (Full Version)</option>
							    </select>
							</div>
							<div class="col-sm-3">
                                <button type="button" class="btn btn-success" onclick="asl_lock()">New Marker</button>
                            </div>
						</div>
						
						<div class="form-group">
							<label for="ddl-open_days" class="col-sm-3 control-label">Open Days</label>
			              	<div class="col-sm-4">
								<select multiple  style="height: 150px; width: 100%" class="form-control" id="asl-open_days">
									<option value="0">Sunday</option>
									<option value="1">Monday</option>
									<option value="2">Tuesday</option>
									<option value="3">Wednesday</option>
									<option value="4">Thursday</option>
									<option value="5">Friday</option>
									<option value="6">Saturday</option>
								</select>
							</div>
						</div>
						<div class="form-group half">
			              <label for="txt-startdate" class="col-sm-3 control-label">Timing</label>
			              <div class="col-sm-4">
			                <div class="input-append input-group bootstrap-timepicker">
			                  <input type="text" name="data[start_time]" id="start_time" value="<?php echo $store->start_time ?>" class="form-control start_time timepicker" placeholder="Start Time">
			                  <span class="input-group-addon add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
			                </div>
			              </div>
			              <div class="col-sm-4">
			                <div class="input-append input-group bootstrap-timepicker">
			                  <input type="text" name="data[end_time]" id="end_time" value="<?php echo $store->end_time ?>" class="form-control end_time timepicker" placeholder="End Time">
			                  <span class="input-group-addon add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
			                </div>
			              </div>
			            </div>

			             <div class="form-group half">
			              <label for="txt-startdate" class="col-sm-3 control-label">Custom Timing</label>
                          <div class="col-xs-6">
                              <div class="onoffswitch">
                                  <input type="checkbox" name="data[time_per_day]" class="onoffswitch-checkbox" id="time_per_day">
                                  <label class="onoffswitch-label" for="time_per_day">
                                      <span class="onoffswitch-inner"></span>
                                      <span class="onoffswitch-switch"></span>
                                  </label>
                              </div>
                          </div>
                        </div>

                        <!--- end of timing -->
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group ralign">
		            <button type="button" class="btn btn-primary mrg-r-10" data-loading-text="Updating..." data-completed-text="Updated" id="btn-asl-add">Update Store</button>
	           	</div>
			</div>
		</div>
		</fieldset>
	</form>



    <div class="modal fade addimagemodel" id="addimagemodel" role="dialog">
        <div class="modal-dialog">     
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Upload Logo</h4>
            </div>
            <div class="modal-body">
            	<form id="frm-upload-logo" name="frm-upload-logo" class="frm-upload-box">
		        	<div class="form-group">                    
                      	<div class="form-group col-md-12">
	                        <label for="txt_name" class="col-sm-2 control-label">Name</label>
	                        <div class="col-sm-10"><input type="text" class="form-control validate[required]" name="data[category_name]"></div>
                      	</div>
			        	<div class="input-group col-sm-offset-2 col-sm-10" id="drop-zone">
					      	<input type="text" class="form-control file-name" placeholder="File Path...">
					      	<input type="file" class="btn btn-default" style="width:98%;opacity:0;position:absolute;top:0;left:0"  name="files" />
					      	<span class="input-group-btn">
					        	<button class="btn btn-default" onclick="jQuery('#drop-zone input[type=file]').trigger('click')" style="padding:3px 12px" type="button">Browse</button>
					      	</span>
					    </div>
			        </div>
				    <div class="form-group ralign">
						<button class="btn btn-primary btn-start mrg-r-15" type="button" data-loading-text="Submitting ...">Upload Logo</button>
					</div>
					<div class="form-group">
						<div class="progress hideelement progress_bar_" style="display:none">
				          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
				            <span style="position:relative" class="sr-only">0% Complete</span>
				          </div>
				        </div>
					</div>
					<ul></ul>
					<p id="message_upload" class="alert alert-warning hide"></p>
				</form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    <!-- Add Marker -->
    <div class="modal fade addimagemodel" id="addmarkermodel" role="dialog">
        <div class="modal-dialog">     
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Upload Marker</h4>
            </div>
            <div class="modal-body">
            	<form id="frm-upload-marker" name="frm-upload-marker" class="frm-upload-box">
		        	<div class="form-group">                    
                      	<div class="form-group col-md-12">
	                        <label for="txt_name" class="col-sm-2 control-label">Name</label>
	                        <div class="col-sm-10"><input type="text" class="form-control validate[required]" name="data[category_name]"></div>
                      	</div>
			        	<div class="input-group col-sm-offset-2 col-sm-10" id="drop-zone-2">
					      	<input type="text" class="form-control file-name" placeholder="File Path...">
					      	<input type="file" class="btn btn-default" style="width:98%;opacity:0;position:absolute;top:0;left:0"  name="files" />
					      	<span class="input-group-btn">
					        	<button class="btn btn-default" onclick="jQuery('#drop-zone-2 input[type=file]').trigger('click')" style="padding:3px 12px" type="button">Browse</button>
					      	</span>
					    </div>
			        </div>
				    <div class="form-group ralign">
						<button class="btn btn-primary btn-start mrg-r-15" type="button" data-loading-text="Submitting ...">Upload Marker</button>
					</div>
					<div class="form-group">
						<div class="progress hideelement progress_bar_" style="display:none">
				          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
				            <span style="position:relative" class="sr-only">0% Complete</span>
				          </div>
				        </div>
					</div>
					<ul></ul>
					<p id="message_upload_1" class="alert alert-warning hide"></p>
				</form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


</div>
<!-- SCRIPTS -->
<script type="text/javascript">

	var asl_configs =  <?php echo json_encode($all_configs); ?>;
	var ASL_Instance = {
		url: '<?php echo AGILESTORELOCATOR_URL_PATH; ?>',
		sideurl: '<?php echo get_site_url();?>'
	};
	
	asl_engine.pages.edit_store(<?php echo json_encode($store) ?>);
</script>
