var asl_engine = {};

function asl_lock(){

	swal({
		title: "AGILE STORE LOCATOR LITE",
		text: "THANK YOU FOR USING AGILE STORE LOCATOR LITE, MANY OTHER FEATURES INCLUDING THIS ONE IS INCLUDED IN <a target=\"_blank\" href=\"http://agilestorelocator.com\">FULL VERSION</a>.",
		html: true });
}

(function( $,app_engine ) {
	'use strict';
		function codeAddress(_address,_callback) {

		var geocoder = new google.maps.Geocoder();
		geocoder.geocode( { 'address': _address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				_callback(results[0].geometry);
			} 
			else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
	};

	
	function isEmpty(obj) {

		if (obj == null) return true;
	    if(typeof(obj) == 'string' && obj == '')return true;
	    return Object.keys(obj).length === 0;
	};

	// Asynchronous load
    var map,
    map_object = {
        is_loaded: true,
        marker: null,
        changed :false,
		store_location: null,
		map_marker : null,
        intialize: function(_callback) {
            
        	
        	var API_KEY = '';
            if(asl_configs && asl_configs.api_key) {
            	API_KEY = '&key='+asl_configs.api_key;
            }

            var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places,drawing&'
                 +'callback=asl_map_intialized'+API_KEY;
                 //+'callback=asl_map_intialized';
                document.body.appendChild(script);
                this.cb = _callback;
        },
        render_a_map: function(_lat,_lng) {

        	var hdlr 	= this,
            map_div 	= document.getElementById('map_canvas'),
            _draggable 	= true;

            hdlr.store_location = (_lat && _lng)?[parseFloat(_lat),parseFloat(_lng)]:[-37.815,144.965];

            var latlng = new google.maps.LatLng(hdlr.store_location[0],hdlr.store_location[1]);

            if(!map_div)return false;

			var mapOptions = {
				zoom : 14,
                minZoom : 8,
                center:latlng,
                //maxZoom: 10,
                mapTypeId : google.maps.MapTypeId.ROADMAP,
                styles:[{"stylers":[{"saturation":-100},{"gamma":1}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"saturation":50},{"gamma":0},{"hue":"#50a5d1"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#333333"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"weight":0.5},{"color":"#333333"}]},{"featureType":"transit.station","elementType":"labels.icon","stylers":[{"gamma":1},{"saturation":50}]}]
			};
			
			hdlr.map_instance = map = new google.maps.Map(map_div, mapOptions);
			
			// && navigator.geolocation && _draggable
			if((!hdlr.store_location || isEmpty(hdlr.store_location[0]))) {
			
				/*navigator.geolocation.getCurrentPosition(function(position){
					
					hdlr.changed = true;
					hdlr.store_location = [position.coords.latitude,position.coords.longitude];
					var loc = new google.maps.LatLng(position.coords.latitude,  position.coords.longitude);
					hdlr.add_marker(loc);
					map.panTo(loc);
				});*/

				hdlr.add_marker(latlng);
			}
			else if(hdlr.store_location) {
				if(isNaN(hdlr.store_location[0]) || isNaN(hdlr.store_location[1]))return;
				//var loc = new google.maps.LatLng(hdlr.store_location[0], hdlr.store_location[1]);
				hdlr.add_marker(latlng);
				map.panTo(latlng);
			}
        },
        add_marker: function(_loc) {
			
			var hdlr   = this;	
			
			hdlr.map_marker = new google.maps.Marker({
				draggable:true,
				position:_loc,
				map:map
			});

			var marker_icon = new google.maps.MarkerImage(ASL_Instance.url+'admin/images/pin1.png');
			marker_icon.size = new google.maps.Size(24,39);
			marker_icon.anchor = new google.maps.Point(24,39);
			hdlr.map_marker.setIcon(marker_icon);
			hdlr.map_instance.panTo(_loc);
			
			google.maps.event.addListener(
			hdlr.map_marker,
			'dragend',
			function() {
				hdlr.store_location =  [hdlr.map_marker.position.lat(),hdlr.map_marker.position.lng()];
				hdlr.changed = true;
				var loc = new google.maps.LatLng(hdlr.map_marker.position.lat(), hdlr.map_marker.position.lng());
				//map.setPosition(loc);
				map.panTo(loc);

				app_engine.pages.store_changed(hdlr.store_location);
			});
			
		}
    };

	//add the uploader
	app_engine.uploader = function($form,_URL,_done/*,_submit_callback*/){

		function formatFileSize(bytes) {
			if (typeof bytes !== 'number') {
				return ''
			}
			if (bytes >= 1000000000) {
				return (bytes / 1000000000).toFixed(2) + ' GB'
			}
			if (bytes >= 1000000) {
				return (bytes / 1000000).toFixed(2) + ' MB'
			}
			return (bytes / 1000).toFixed(2) + ' KB'
		};

		var ul = $form.find('ul');
		$form[0].reset();

		
		$form.fileupload({
		        url: _URL,
		        dataType: 'json',
		        //multipart: false,
		        done: function(e,data){

		        	ul.empty();
		        	_done(e,data);

		        	$form.find('.progress-bar').css('width','0%');
		        	$form.find('.progress').hide();

		        	//reset form if success
		        	if(data.result.success) {
		        	}

		        },
		        add : function (e, data) {

					ul.empty();
					

					var tpl = $('<li class="working"><p></p><span></span></li>');
					tpl.find('p').text(data.files[0].name.substr(0,50)).append('<i>' + formatFileSize(data.files[0].size) + '</i>');
					data.context = tpl.appendTo(ul);

					var jqXHR = null;
					$form.find('.btn-start').unbind().bind('click', function () {
						
						/*if(_submit_callback){
							if(!_submit_callback())return false;
						}*/

						jqXHR = data.submit();
						
						$form.find('.progress').show()
					});

					
					$form.find('.file-name').val(data.files[0].name);
				},
		        progress : function (e, data) {
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$form.find('.progress-bar').css('width',progress+'%');
					$form.find('.sr-only').html(progress+'%');

					if (progress == 100) {
						data.context.removeClass('working');
					}
				},
				fail : function (e, data) {
					data.context.addClass('error');
					$form.find('.upload-status-box').html('Upload Failed! Please try again.').addClass('bg-warning alert')
				}
		        /*
		        formData: function(_form) {

		        	var formData = [{
		        		name: 'data[action]',
		        		value: 'asl_add_store'
		        	}]

		        	//	console.log(formData);
		        	return formData;
		        }*/
		    })
			.bind('fileuploadsubmit', function (e, data) {
			
		        data.formData = $form.serializeObject();
		    })
			.prop('disabled', !$.support.fileInput)
		    .parent().addClass($.support.fileInput ? undefined : 'disabled');
	};

	//http://harvesthq.github.io/chosen/options.html
	app_engine['pages'] = {
		store_changed:function(_position){

			$('#asl_txt_lat').val(_position[0]);
			$('#asl_txt_lng').val(_position[1]);
		},
		manage_categories: function(){

			var table = null,
			row_delete_id = null;

			//Prompt the delete
			$('#tbl_categories').on('click','.glyphicon-trash',function(){
				row_delete_id = $(this).data('id');
				$('#confirm-delete').modal('show');	
			});

			var _delete_category = function(_id) {

				ServerCall(ASL_REMOTE.URL+"?action=asl_delete_category",{category_id:_id},function(_response){

	        		if(_response.success) {
	        			displayMessage(_response.msg,$(".dump-message"),'alert alert-success static',true);
	        			table.fnDraw();
	        			return;
	        		}
	        		else if(_response.error) {
	        			displayMessage(_response.error,$(".dump-message"),'alert alert-danger static',true);
	        			return;	
	        		}
	        		else {
	        			displayMessage('Error Occured, Please try again.',$(".dump-message"),'alert alert-danger static',true);
	        		}
				},'json');
			};

			//delete the alert
			$('#btn-delete-store').bind('click',function(){

				$('#confirm-delete').modal('hide');	
				_delete_category(row_delete_id);
			});

			

			//prompt the category box
			$('#btn-asl-new-c').bind('click',function(){
				$('#asl-new-cat-box').modal('show');	
			});

			
			var asInitVals = {};				
			table = $('#tbl_categories').dataTable({
				"bProcessing": true,
		        "bFilter":false,
		        "bServerSide" : true,
		        //"scrollX": true,
		        /*"aoColumnDefs": [
		          { 'bSortable': false, 'aTargets': [ 1 ] }
		        ],*/
		        "bAutoWidth" : true,
		        "columnDefs": [
		            { "width": "75px", "targets": 0 },
		            { "width": "200px", "targets": 1 },
		            { "width": "100px", "targets": 2 },
		            { "width": "100px", "targets": 3 },
		            { "width": "150px", "targets": 4 },
		            { "width": "150px", "targets": 5 },
		            { 'bSortable': false, 'aTargets': [ 5 ] }
		        ],
		        "iDisplayLength": 10,
				"sAjaxSource": ASL_REMOTE.URL+"?action=asl_get_categories",
				"columns": [
					{ "data": "id" },
					{ "data": "category_name" },
					{ "data": "is_active" },
					{ "data": "icon" },
					{ "data": "created_on" },
					{ "data": "action" }
				],
				"fnServerParams" : function (aoData) {

					$("#tbl_stores_wrapper .dataTables_scrollHead thead input").each( function (i) {
						
						if ( this.value != "" ) {	
							aoData.push({
				                "name" : 'filter['+$(this).attr('data-id')+']',
				                "value" :this.value
				            });
						}
					});
		        },
				"order": [[0, 'desc']]
			});
				

			//TO ADD NEW Categories
			var url_to_upload = ASL_REMOTE.URL,
			$form = $('#frm-addcategory');

			app_engine.uploader($form,url_to_upload+'?action=asl_add_categories',function (e, data) {

				var data = data.result;

					if(!data.success) {
						
						$('#message_upload').html(data.message).removeClass('hide');
		           	}
		           	else {
 						
 						$('#message_upload').text(data.message);
 						//reset form
 						$('#asl-new-cat-box').modal('hide');
 						$('#frm-addcategory').find('input:text, input:file').val('');
 						$('#message_upload').empty().addClass('hide');
 						$('#progress_bar').hide();
 						//show table value
 						table.fnDraw();
		            }
		    });


		  	//show edit category model
		    $('#tbl_categories tbody').on('click','.edit_category',function(e){

		    	$('#updatecategory_image').show();
		    	$('#updatecategory_editimage').hide();
		    	$('#confirm-update').modal('show');	
		    	$('#update_category_id').text($(this).attr("data-id"));
		    	$('#update_category_id_input').val($(this).attr("data-id"));
		    	$('#message_update').text("");

		    	ServerCall(ASL_REMOTE.URL+"?action=asl_get_category_byid",{category_id:$(this).attr("data-id")},function(_response){

	        		if(_response.success) {

	        			$("#update_category_name").val(_response.list[0]['category_name']);
	        			$("#update_category_icon").attr("src", ASL_Instance.url+"public/icon/"+_response.list[0]['icon']);
	        		}
	        		else {

	        			$('#message_update').text(_response.error);return;
	        		}
				},'json');

				
			});

		    //show edit category upload image
			$('#change_image').click(function(){

				$("#update_category_icon").attr("data-id","")
				$('#updatecategory_image').hide();
				$('#message_update').text("");
				$('#updatecategory_editimage').show();
			});	

			//update category without icon
			$('#btn-asl-update-categories').click(function(){

				if($("#update_category_icon").attr("data-id") == "same" ) {

					ServerCall(ASL_REMOTE.URL+"?action=asl_update_category",
						{data:{category_id:$("#update_category_id").text(),action:"same",category_name:$("#update_category_name").val()}},
						function(_response){

	        		if(_response.success) {

	        			$('#message_update').text(_response.msg);

	        			table.fnDraw();
	        			
	        			return;
	        		}
	        		else if(_response.error) {
	        			$('#message_update').text(_response.msg);
	        			return;	
	        		}
				},'json');

				}

			});	

			//update category with icon

			var url_to_upload = ASL_REMOTE.URL,
			$form 			  = $('#frm-updatecategory');
			
          	$form.append('<input type="hidden" name="data[action]" value="notsame" /> ');

			app_engine.uploader($form,url_to_upload+'?action=asl_update_category',function (e, data) {

				var data = data.result;

				if(data.success) {
					
					$('#message_update').text(data.msg);
					$('#confirm-update').modal('hide');
						$('#frm-updatecategory').find('input:text, input:file').val('');
						$('#progress_bar_').hide();
					table.fnDraw();
	           	}
	           	else
						$('#message_update').text(data.error);
		    });

			//show delete category model
			$('#tbl_categories tbody').on('click','.delete_category',function(e){

				$('#confirm-delete').modal('show');	
		    	$('#delete_category_id').text($(this).attr("data-id"));
			});

			//delete category
			$('#btn-delete-category').click(function(){

				ServerCall(ASL_REMOTE.URL+"?action=asl_delete_category",{category_id:$("#delete_category_id").text()},function(_response){

	        		if(_response.success) {

	        			$('#message_upload').text(_response.msg);	        			
	        			table.fnDraw();
	        			$('#confirm-delete').modal('hide');
	        			return;
	        		}
	        		else if(_response.error) {
	        			$('#message_upload').text(_response.msg);
	        			return;	
	        		}
				},'json');

			});

		
			$("thead input").keyup( function (e) {
				
				if(e.keyCode == 13) {
					table.fnDraw();
				}
			});
		},
		
		manage_stores: function(){

			var table = null,
			row_delete_id = null,
			row_duplicate_id = null;


			//Prompt the delete alert
			$('#tbl_stores').on('click','.glyphicon-trash',function(){
				
				row_delete_id = $(this).data('id');
				$('#confirm-delete').modal('show');	
			});


			//Prompt the DUPLICATE alert
			$('#tbl_stores').on('click','.glyphicon-duplicate',function(){
				
				asl_lock();
			});

			var delete_store = function(_id) {

				ServerCall(ASL_REMOTE.URL+"?action=asl_delete_store",{store_id:_id},function(_response){

	        		if(_response.success) {
	        			displayMessage(_response.msg,$(".dump-message"),'alert alert-success static',true);
	        			table.fnDraw();
	        			return;
	        		}
	        		else if(_response.error) {
	        			displayMessage(_response.error,$(".dump-message"),'alert alert-danger static',true);
	        			return;	
	        		}
	        		else {
	        			displayMessage('Error Occured, Please try again.',$(".dump-message"),'alert alert-danger static',true);
	        		}
				},'json');
			};

			/*DUPLICATE STORES*/
			var duplicate_store = function(_id) {

				ServerCall(ASL_REMOTE.URL+"?action=asl_duplicate_store",{store_id:_id},function(_response){

	        		if(_response.success) {
	        			displayMessage(_response.msg,$(".dump-message"),'alert alert-success static',true);
	        			table.fnDraw();
	        			return;
	        		}
	        		else if(_response.error) {
	        			displayMessage(_response.error,$(".dump-message"),'alert alert-danger static',true);
	        			return;	
	        		}
	        		else {
	        			displayMessage('Error Occured, Please try again.',$(".dump-message"),'alert alert-danger static',true);
	        		}
				},'json');
			};


			//delete the alert
			$('#btn-delete-store').bind('click',function(){

				$('#confirm-delete').modal('hide');	
				delete_store(row_delete_id);
			});


			//duplicate the alert
			$('#btn-duplicate-store').bind('click',function(){

				$('#confirm-duplicate').modal('hide');	
				duplicate_store(row_duplicate_id);
			});


			var asInitVals = {};				
			table = $('#tbl_stores').dataTable({
				"bProcessing": true,
		        "bFilter":false,
		        "bServerSide" : true,
		        "scrollX": true,
		        /*"aoColumnDefs": [
		          { 'bSortable': false, 'aTargets': [ 1 ] }
		        ],*/
		        "bAutoWidth" : true,
		        "columnDefs": [
		            { "width": "75px", "targets": 0 },
		            { "width": "200px", "targets": 1 },
		            { "width": "300px", "targets": 2 },
		            { "width": "300px", "targets": 3 },
		            { "width": "150px", "targets": 4 },
		            { "width": "150px", "targets": 5 },
		            { "width": "150px", "targets": 6 },
		            { "width": "150px", "targets": 7 },
		            { "width": "150px", "targets": 8 },
		            { "width": "150px", "targets": 9 },
		            { "width": "50px", "targets": 10 },
		            { "width": "350px", "targets": 11 },
		            { "width": "50px", "targets": 12 },
		            { "width": "50px", "targets": 13 },
		            { "width": "50px", "targets": 14 },
		            { "width": "50px", "targets": 15 },
		            { "width": "200px", "targets": 16 },
		            { "width": "150px", "targets": 17 },
		            { "width": "250px", "targets": 18 },
		            { 'bSortable': false, 'aTargets': [ 11,16,18 ] }
		        ],
		        "iDisplayLength": 10,
				"sAjaxSource": ASL_REMOTE.URL+"?action=asl_get_store_list",
				"columns": [
					{ "data": "id" },
					{ "data": "title" },
					{ "data": "description" },
					{ "data": "street" },
					{ "data": "state" },
					{ "data": "city" },
					{ "data": "phone" },
					{ "data": "email" },
					{ "data": "website" },
					{ "data": "postal_code" },
					{ "data": "is_disabled" },
					{ "data": "categories" },
					{ "data": "marker_id" },
					{ "data": "logo_id" },
					{ "data": "start_time" },
					{ "data": "end_time" },
					{ "data": "days" },
					{ "data": "created_on" },
					{ "data": "action" }
				],
				"fnServerParams" : function (aoData) {

					$("#tbl_stores_wrapper .dataTables_scrollHead thead input").each( function (i) {

						if ( this.value != "" ) {	
							aoData.push({
				                "name" : 'filter['+$(this).attr('data-id')+']',
				                "value" :this.value

				            });
						}
					});

		        },
				"order": [[0, 'desc']]

			});

			//oTable.fnSort( [ [10,'desc'] ] );

			$("thead input").keyup( function (e) {
				
				if(e.keyCode == 13) {
					table.fnDraw();
				}
			});

			$("#Search_Data").click( function () {
				
					table.fnDraw();
				
			});
		},
		customize_map: function(){

		

        	//Trafic Layer
		    $('.asl-p-cont .map-option-bottom #asl-trafic_layer').bind('click',function(e){

		    	asl_lock();

		    });

		    //Transit Layer
		    $('.asl-p-cont .map-option-bottom #asl-transit_layer').bind('click',function(e){

		    	asl_lock();
		    });

		    //Bike Layer
		    $('.asl-p-cont .map-option-bottom #asl-bike_layer').bind('click',function(e){
		    	
		    	asl_lock();

		    });

		    //Marker Animate
		    $('.asl-p-cont .map-option-bottom #asl-marker_animations').bind('click',function(e){

		    	asl_lock();
		    });


		    //Save the Map Customization
		    $('#asl-save-map').bind('click',function(e){

		    	asl_lock();
		    });

		},
		
		edit_store: function(_store){

			this.add_store(true,_store);
		},
		add_store: function(_is_edit,_store) {

			var $form = $('#frm-addstore'),
				hdlr  = this;



			$('#time_per_day').bind('change',function(e){
				asl_lock();
			});

			var current_time = new Date();
		    current_time.setHours(7);
		    current_time.setMinutes(0);
		    
		    var start_time = current_time.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
		    current_time.setHours(current_time.getHours()+ 12);
		    
		    var end_time = current_time.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});

		    
		    /*Time Picker for Duration*/
			$('.start_time').timepicker({
				defaultTime: (_store)?null:start_time,
				appendWidgetTo: '.asl-p-cont'
			});

			$('.end_time').timepicker({
				defaultTime: (_store)?null:end_time,
				appendWidgetTo: '.asl-p-cont'
			});
			

			if(_store) {

				if(_store.days)
					jQuery('.asl-p-cont #asl-open_days').val(_store.days.split(','))
			}
			else
				$('.asl-p-cont #asl-open_days').val([0,1,2,3,4]);

			/*Dropdown Style*/
			if(_store && _store.logo_id)
				$('#ddl-asl-logos').val(String(_store.logo_id));

			$('#ddl-asl-logos').ddslick({
			    //data: ddData,
			    imagePosition:"right",
			    selectText: "Select Logo",
			    truncateDescription: true
			    //defaultSelectedIndex:(_store)?String(_store.logo_id):null
			});


			//init the maps
			$(function(){


				if(!(window['google'] && google.maps)) {
			    	map_object.intialize();
			    }
			    else
			    	asl_map_intialized();
			});

		    window['asl_map_intialized'] = function(){
		    	if(_store)
		        	map_object.render_a_map(_store.lat,_store.lng);
		       	else
		       		map_object.render_a_map();
		    };

		    //the category ddl
			$('#ddl_categories').chosen({
				width:"100%"
				/*
				no_results_text:'Oops, nothing found!',
				allow_single_deselect:true,
				disable_search_threshold:10*/
			});

			/*Form Submit*/
			$form.validationEngine({
				binded: true,
				scroll: false
			});

			//To get Lat/lng
			$('#txt_city,#txt_state,#txt_postal_code').bind('blur',function(e){

				if(!isEmpty($form[0].elements["data[city]"].value) && !isEmpty($form[0].elements["data[state]"].value) && !isEmpty($form[0].elements["data[postal_code]"].value))
				{
					var address = [$form[0].elements["data[street]"].value,$form[0].elements["data[city]"].value,$form[0].elements["data[postal_code]"].value,$form[0].elements["data[state]"].value].join(',');

					codeAddress(address,function(_geometry){

						var s_location =  [_geometry.location.lat(),_geometry.location.lng()];
						var loc = new google.maps.LatLng(s_location[0],s_location[1]);
						map_object.map_marker.setPosition(_geometry.location);
						map.panTo(_geometry.location);
						app_engine.pages.store_changed(s_location);

					});
				}
			});

			//Add store button
			$('#btn-asl-add').bind('click',function(e){
				
				if(!$form.validationEngine('validate'))return;

				var $btn = $(this),
				formData = $form.serializeObject();
				
				formData['action'] = (_is_edit)?'asl_edit_store':'asl_add_store';
				formData['category'] = $('#ddl_categories').val();

				var _open_days = $('.asl-p-cont #asl-open_days').val();


				_open_days = (_open_days)?_open_days.join(','):'';
				formData['data[days]'] = _open_days;
				

				if(_is_edit){formData['updateid'] = $('#update_id').val();}

				formData['data[logo_id]']   = $('#ddl-asl-logos').data('ddslick').selectedData.value;
				
				$btn.bootButton('loading');
				ServerCall(ASL_REMOTE.URL,formData,function(_response){

					$btn.bootButton('reset');
	        		if(_response.success) {
	        			
	        			$form[0].reset();
	        			$btn.bootButton('completed');
		    			
	        			if(_is_edit) {
		        			_response.msg += " Redirect...";
		        			window.location.replace(ASL_REMOTE.URL.replace('-ajax','')+"?page=manage-agile-store");
	    				}
	    				else
	    					$('.days_table').addClass('hide');

	    				displayMessage(_response.msg,$(".dump-message"),'alert alert-success static',true);
	        			return;
	        		}
	        		else if(_response.error) {
	        			displayMessage(_response.error,$(".dump-message"),'alert alert-danger static',true);
	        			return;	
	        		}
	        		else {
	        			displayMessage('Error Occured, Please try again.',$(".dump-message"),'alert alert-danger static',true);
	        		}
				},'json');
			});


			//UPLOAD LOGO FILE IMAGE
			var url_to_upload = ASL_REMOTE.URL,
				$form_upload  = $('#frm-upload-logo');

			$('#addimagemodel').on('hidden.bs.modal', function (e) {
				$('#message_upload').addClass('hide');
			});

			app_engine.uploader($form_upload,url_to_upload+'?action=asl_upload_logo',function (_e, _data) {
		        	
				var data = _data.result;

				if(!data.success) {
					$('#message_upload').html(data.message).removeClass('hide');
	           	}
	           	else {
						
					var _HTML = '';
					for(var k in data.list) 
						 _HTML += '<option data-imagesrc="'+ASL_Instance.url+'public/Logo/'+data.list[k].path+'" data-description="&nbsp;" value="'+data.list[k].id+'">'+data.list[k].name+'</option>';
					

					$('#ddl-asl-logos').empty().ddslick('destroy');
					$('#ddl-asl-logos').html(_HTML).ddslick({
					    //data: ddData,
					    imagePosition:"right",
					    selectText: "Select Logo",
					    truncateDescription: true,
					    defaultSelectedIndex:(_store)?String(_store.logo_id):null
					});
					
					$('#addimagemodel').modal('hide');	
					$form_upload.find('.progress_bar_').hide();
					$form_upload.find('input:text, input:file').val('');
					$('#message_upload').empty(); 	
	            }
		    });
	

			$('#ddl-asl-markers').ddslick({
			    //data: ddData,
			    imagePosition:"right",
			    selectText: "Select Marker",
			    truncateDescription: true
			//    defaultSelectedIndex: (_store)?String(_store.marker_id):null
			});

		

		},//user setting
		user_setting: function(_configs) {

				var $form = $('#frm-usersetting');

				var _keys = Object.keys(_configs);

				for(var i in _keys) {

					var $elem = $form.find('#asl-'+_keys[i]);
					$elem.val(_configs[_keys[i]]);
				}

				
				
				$('#btn-asl-user_setting').bind('click',function(e){

					if(!$form.validationEngine('validate'))return;

					var all_data = {
						
					};

					var data = $form.serializeObject();

					all_data = $.extend(all_data,data);
					
					ServerCall(ASL_REMOTE.URL+'?action=asl_save_setting',all_data,function(_response) {
					
						if(_response.success) {
							displayMessage(_response.msg,$(".dump-message"),'alert alert-success static',true);
							return;
						}
						else if(_response.error) {
							
							displayMessage(_response.msg,$(".dump-message"),'alert alert-danger static',true);
							return;
						}
						else {
							displayMessage('Error Occurred.',$(".dump-message"),'alert alert-danger static',true);
							return;
							
						}
					},'json');
				});
		}
	};

	//<p class="message alert alert-danger static" style="display: block;">Legal Location not found<button data-dismiss="alert" class="close" type="button"> ×</button><span class="block-arrow bottom"><span></span></span></p>
	//if jquery is defined
	if($)
		$('.asl-p-cont').append('<div class="loading site hide">Working ...</div><div class="asl-dumper dump-message"></div>');

})( jQuery,asl_engine );