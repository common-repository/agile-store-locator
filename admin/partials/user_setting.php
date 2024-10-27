<!-- Container -->
<div class="asl-p-cont">
<div class="dump-message asl-dumper"></div>
<form class="form-horizontal" id="frm-usersetting">
	<div class="row" id="message_complete"></div>	
	<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading"><h3 class="panel-title">Agile Locator Setting</h3></div>
				  	<div class="panel-body">
				  		
			           	<div class="form-group s-option no-0">
				            <label class="col-sm-3 control-label" for="txt_Cluster">Cluster</label>
				          	 <select  id="asl-cluster" name="data[cluster]"   class="form-control">
				            	<option value="0">OFF</option>	
				            	<option value="1">ON</option>
					        </select>
			           	</div>
			           	<div class="form-group s-option no-1">
				            <label class="col-sm-3 control-label" for="map_type">Default Map</label>
				          	 <select   id="asl-map_type"   name="data[map_type]" class="form-control">
				          	 	<option value="hybrid">HYBRID</option>
					            	<option value="roadmap">ROADMAP</option>
					            	<option value="satellite">SATELLITE</option>
					            	<option value="terrain">TERRAIN</option>
					        </select>
			           	</div>
			           	<div class="form-group s-option no-2">
				            <label class="col-sm-3 control-label" for="txt_time_format">Time Format</label>
				          	 <select  id="asl-time_format" name="data[time_format]" class="form-control">
				            	<option value="0">12 Hours</option>	
				            	<option value="1">24 Hours</option>
					        </select>
			           	</div>
			           	<div class="form-group s-option no-3">
				            <label class="col-sm-3 control-label" for="display_list">Display List</label>
				          	<select id="asl-display_list" disabled="disabled"  name="data[display_list]" class="form-control">
				          	 	<option value="1">Yes</option>
					            <option value="0">No</option>
					        </select>
			           	</div>
			           	<div class="form-group s-option no-4 full">
				            <label class="col-sm-3 control-label" for="prompt_location">Prompt Location</label>
				          	 <select  id="asl-prompt_location" disabled="disabled"  name="data[prompt_location]" class="form-control">
					         		<option value="0">OFF</option>	
					            	<option value="1">ON</option>
					        </select>
					        <p class="help-p col-sm-offset-3 col-sm-9">(Prompt a dailog box for Current Location)</p>
			           	</div>
			           	<div class="form-group s-option no-5">
				            <label class="col-sm-3 control-label" for="distance_unit">Distance Unit</label>
				          	 <select  id="asl-distance_unit"  name="data[distance_unit]" class="form-control">
					            	<option value="KM">KM</option>	
					            	<option value="Miles">Miles</option>
					        </select>
			           	</div>
			           	<div class="form-group s-option no-6">
				            <label class="col-sm-3 control-label" for="asl-zoom">Default Zoom</label>
				          	 <select  id="asl-zoom" name="data[zoom]" class="form-control">
					            	<?php for($index = 2;$index <= 20;$index++):?>
					            		<option value="<?php echo $index ?>"><?php echo $index ?></option>
					            	<?php endfor; ?>
					        </select>
			           	</div>
			           	<div class="form-group s-option no-7 full">
				            <label class="col-sm-3 control-label" for="asl-zoom_li">Clicked Zoom</label>
				          	 <select  id="asl-zoom_li" name="data[zoom_li]" disabled="disabled"  class="form-control">
					            	<?php for($index = 2;$index <= 20;$index++):?>
					            		<option value="<?php echo $index ?>"><?php echo $index ?></option>
					            	<?php endfor; ?>
					        </select>
					        <p class="help-p col-sm-offset-3 col-sm-9">(Zoom Value when List Item is Clicked)</p>
			           	</div>
			           	<div class="form-group s-option no-7 full">
				            <label class="col-sm-3 control-label" for="load_all">Marker Load</label>
				          	 <select  name="data[load_all]" disabled="disabled"  id="asl-load_all" class="form-control">
					            	<option value="0">Load on Bound</option>
					            	<option value="1">Load All</option>
					        </select>
					        <p class="help-p col-sm-offset-3 col-sm-9">(Use Load on Bound in case of 1000 plus markers)</p>
			           	</div>
                        
			           	<div class="form-group c-option no-0 thirdpart">
				            <label class="col-sm-3 control-label" for="asl-show_categories">Show Categories</label>
				          	<input type="checkbox" value="1"  disabled="disabled"  id="asl-show_categories" name="data[show_categories]">
			           	</div>
			           	<div class="form-group c-option no-1 thirdpart">
				            <label class="col-sm-3 control-label" for="asl-time_switch">Time Switch</label>
				          	<input type="checkbox" disabled="disabled"  value="1" id="asl-time_switch" name="data[time_switch]">
			           	</div>
			           	<!--
			           	<div class="form-group">
				            <label class="col-sm-3 control-label" for="asl-direction">Direction Service</label>
				          	<input type="checkbox" value="1" id="asl-direction" name="data[direction]">
			           	</div>
			           	-->
			           	<div class="form-group c-option no-2 thirdpart">
				            <label class="col-sm-3 control-label" for="asl-additional_info">Additional Info</label>
				          	<input type="checkbox" value="1" disabled="disabled"  id="asl-additional_info" name="data[additional_info]">
			           	</div>
			           	<div class="form-group c-option no-3 thirdpart">
				            <label class="col-sm-3 control-label" for="asl-advance_filter">Advance Filter</label>
				          	<input type="checkbox" value="1" disabled="disabled"   id="asl-advance_filter" name="data[advance_filter]">
			           	</div>
			           	<div class="form-group c-option no-4 thirdpart">
				            <label class="col-sm-3 control-label" for="asl-category_marker">Category marker</label>
				          	<input type="checkbox" value="1" disabled="disabled"   id="asl-category_marker" name="data[category_marker]">
				          	<p class="help-p">(Single Category Selection)</p>
			           	</div>
			           	<div class="form-group c-option no-5 thirdpart">
				            <label class="col-sm-3 control-label" for="asl-distance_slider">Distance Slider</label>
				          	<input type="checkbox" value="1" disabled="disabled"   id="asl-distance_slider" name="data[distance_slider]">
			           	</div>
			           	<div class="form-group c-option no-6 thirdpart">
				            <label class="col-sm-3 control-label" for="asl-full_width">Full Width</label>
				          	<input type="checkbox" value="1" disabled="disabled"  id="asl-full_width" name="data[full_width]">
			           	</div>
			           	<br clear="both">
			           	<div class="form-group page_layout">
				            <label class="col-sm-3 control-label" >Layout</label>
							<div id="radio">
							    <p style=" line-height: 28px;">Available in <a href="http://agilestorelocator.com" target="_blank">Full Version</a></p>
						  	</div>
			           	</div>
			           	<br clear="both">
			           	<div class="form-group lng-lat">
				            <label class="col-sm-3 control-label">Default Lat/Lng</label>
							<div class="col-sm-4">
								<input  type="text"  class="form-control validate[required]" name="data[default_lat]" id="asl-default_lat" placeholder="Lat">
							</div>
							<div class="col-sm-4">
							<input  type="text"   class="form-control validate[required]" name="data[default_lng]"  id="asl-default_lng" placeholder="Lng">
							</div>
							<p class="help-p col-sm-offset-3 col-sm-9">(Default coordinates for map to load)</p>
			           	</div>
			           	<br clear="both">
			           	<div class="row form-group no-of-shop">
				            <label class="col-sm-3 control-label">Header Title</label>
							<div class="col-sm-8">
								<input  type="text" disabled="disabled" class="form-control validate[required]" name="data[head_title]" id="asl-head_title" placeholder="Head title">
							</div>
			           	</div>
                        <br clear="both">

                        <div class="row form-group no-of-shop">
				            <label class="col-sm-3 control-label">Category Title</label>
							<div class="col-sm-8">
								<input  type="text" disabled="disabled"  class="form-control validate[required]" name="data[category_title]" id="asl-category_title" placeholder="Category title">
							</div>
			           	</div>
                        <br clear="both">

                        <div class="row form-group no-of-shop">
				            <label class="col-sm-3 control-label">No Item Text</label>
							<div class="col-sm-8">
								<input  type="text" disabled="disabled"  class="form-control validate[required]" name="data[no_item_text]" id="asl-no_item_text" placeholder="No Item Text">
							</div>
			           	</div>
                        <br clear="both">

                        <div class="row form-group no-of-shop">
				            <label class="col-sm-3 control-label">Google API KEY</label>
							<div class="col-sm-8">
								<input  type="text" class="form-control" name="data[api_key]" id="asl-api_key" placeholder="API KEY">
							</div>
							<p class="help-p col-sm-offset-3 col-sm-9">(Generate Key from  google console if required)</p>
			           	</div>
                        <br clear="both">
                        
                        <div class="form-group map_layout">
				            <label class="col-sm-3 control-label" >Map Layout</label>
							<div id="radio">
							    <p style=" line-height: 28px;">Available in <a href="http://agilestorelocator.com" target="_blank">Full Version</a></p>
						  	</div>
			           	</div>
                        
                        
                        <div class="form-group layout">
				            <label class="col-sm-3 control-label">Template</label>
							<div id="radio">
                                <p style=" line-height: 28px;">Available in <a href="http://agilestorelocator.com" target="_blank">Full Version</a></p>
						  	</div>
			           	</div>
                        
                        
                        <div class="template-box box_layout_0 hide">
				           	<div class="row form-group color_scheme">
					            <label class="col-sm-3 control-label">Color Scheme</label>
								<div id="radio" >
	                                <span>
	                                    <input type="radio" id="asl-color_scheme-0" value="0" name="data[color_scheme]">
	                                    <label class="color-box color-0" for="asl-color_scheme-0"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme-1" value="1" name="data[color_scheme]">
	                                    <label class="color-box color-1" for="asl-color_scheme-1"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme-2" value="2" name="data[color_scheme]">
	                                    <label class="color-box color-2" for="asl-color_scheme-2"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme-3" value="3" name="data[color_scheme]">
	                                    <label class="color-box color-3" for="asl-color_scheme-3"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme-4" value="4" name="data[color_scheme]">
	                                    <label class="color-box color-4" for="asl-color_scheme-4"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme-5" value="5" name="data[color_scheme]">
	                                    <label class="color-box color-5" for="asl-color_scheme-5"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme-6" value="6" name="data[color_scheme]">
	                                    <label class="color-box color-6" for="asl-color_scheme-6"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme-7" value="7" name="data[color_scheme]">
	                                    <label class="color-box color-7" for="asl-color_scheme-7"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme-8" value="8" name="data[color_scheme]">
	                                    <label class="color-box color-8" for="asl-color_scheme-8"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme-9" value="9" name="data[color_scheme]">
	                                    <label class="color-box color-9" for="asl-color_scheme-9"></label>
	                                </span>
	                            </div>
				           	</div>
				           	<div class="row form-group Font_color">
					            <label class="col-sm-3 control-label">Font Colors</label>
								<div id="radio">
	                                <span>
	                                    <input type="radio" id="asl-font_color_scheme-0" value="0" name="data[font_color_scheme]">
	                                    <label class="font-color-box color-0" for="asl-font_color_scheme-0"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-font_color_scheme-1" value="1" name="data[font_color_scheme]">
	                                    <label class="font-color-box color-1" for="asl-font_color_scheme-1"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-font_color_scheme-2" value="2" name="data[font_color_scheme]">
	                                    <label class="font-color-box color-2" for="asl-font_color_scheme-2"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-font_color_scheme-3" value="3" name="data[font_color_scheme]">
	                                    <label class="font-color-box color-3" for="asl-font_color_scheme-3"></label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-font_color_scheme-4" value="4" name="data[font_color_scheme]">
	                                    <label class="font-color-box color-4" for="asl-font_color_scheme-4"></label>
	                                </span>
	                            </div>
				           	</div>
	                        <div class="form-group infobox_layout">
					            <label class="col-sm-3 control-label" >Infobox Layout</label>
								<div id="radio">
								    <p style=" line-height: 28px;">Available in <a href="http://agilestorelocator.com" target="_blank">Full Version</a></p>
							  	</div>
				           	</div>
                        </div>
                        <div class="template-box box_layout_1 hide">
				           	<div class="row form-group color_scheme layout_2">
					            <label class="col-sm-3 control-label">Color Scheme</label>
								<div id="radio" >
	                                <span>
	                                    <input type="radio" id="asl-color_scheme_1-0" value="0" name="data[color_scheme_1]">
	                                    <label class="color-box color-0" for="asl-color_scheme_1-0">
	                                        <span class="co_1"></span>
	                                        <span class="co_2"></span>
	                                    </label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme_1-1" value="1" name="data[color_scheme_1]">
	                                    <label class="color-box color-1" for="asl-color_scheme_1-1">
	                                        <span class="co_1"></span>
	                                        <span class="co_2"></span>
	                                    </label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme_1-2" value="2" name="data[color_scheme_1]">
	                                    <label class="color-box color-2" for="asl-color_scheme_1-2">
	                                        <span class="co_1"></span>
	                                        <span class="co_2"></span>
	                                    </label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme_1-3" value="3" name="data[color_scheme_1]">
	                                    <label class="color-box color-3" for="asl-color_scheme_1-3">
	                                        <span class="co_1"></span>
	                                        <span class="co_2"></span>
	                                    </label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme_1-4" value="4" name="data[color_scheme_1]">
	                                    <label class="color-box color-4" for="asl-color_scheme_1-4">
	                                        <span class="co_1"></span>
	                                        <span class="co_2"></span>
	                                    </label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme_1-5" value="5" name="data[color_scheme_1]">
	                                    <label class="color-box color-5" for="asl-color_scheme_1-5">
	                                        <span class="co_1"></span>
	                                        <span class="co_2"></span>
	                                    </label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme_1-6" value="6" name="data[color_scheme_1]">
	                                    <label class="color-box color-6" for="asl-color_scheme_1-6">
	                                        <span class="co_1"></span>
	                                        <span class="co_2"></span>
	                                    </label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme_1-7" value="7" name="data[color_scheme_1]">
	                                    <label class="color-box color-7" for="asl-color_scheme_1-7">
	                                        <span class="co_1"></span>
	                                        <span class="co_2"></span>
	                                    </label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme_1-8" value="8" name="data[color_scheme_1]">
	                                    <label class="color-box color-8" for="asl-color_scheme_1-8">
	                                        <span class="co_1"></span>
	                                        <span class="co_2"></span>
	                                    </label>
	                                </span>
	                                <span>
	                                    <input type="radio" id="asl-color_scheme_1-9" value="9" name="data[color_scheme_1]">
	                                    <label class="color-box color-9" for="asl-color_scheme_1-9">
	                                        <span class="co_1"></span>
	                                        <span class="co_2"></span>
	                                    </label>
	                                </span>
	                            </div>
				           	</div>
	                    </div>
			           	<div class="form-group ralign">
				            <button type="button" class="btn btn-primary mrg-r-10" data-loading-text="Saving..." data-completed-text="Settings Updated" id="btn-asl-user_setting">Save Settings</button>
			           	</div>
					</div>
				</div>
			</div>
	</div>

	
	
	</form>

</div>

<!-- SCRIPTS -->
<script type="text/javascript">
	var ASL_Instance = {
		url: '<?php echo AGILESTORELOCATOR_URL_PATH ?>'
	},
	asl_configs =  <?php echo json_encode($all_configs); ?>;
	asl_engine.pages.user_setting(asl_configs);
</script>