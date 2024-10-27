<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://agilelogix.com
 * @since      1.0.0
 *
 * @package    AgileStoreLocator
 * @subpackage AgileStoreLocator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    AgileStoreLocator
 * @subpackage AgileStoreLocator/admin
 * @author     Your Name <support@agilelogix.com>
 */
class AgileStoreLocator_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $AgileStoreLocator    The ID of this plugin.
	 */
	private $AgileStoreLocator;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $AgileStoreLocator       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $AgileStoreLocator, $version ) {

		$this->AgileStoreLocator = $AgileStoreLocator;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in AgileStoreLocator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The AgileStoreLocator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->AgileStoreLocator, AGILESTORELOCATOR_URL_PATH . 'public/css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'asl_chosen_plugin', AGILESTORELOCATOR_URL_PATH . 'public/css/chosen.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'asl_admin', AGILESTORELOCATOR_URL_PATH . 'admin/css/style.css', array(), $this->version, 'all' );
        
		wp_enqueue_style( 'asl_datatable1', AGILESTORELOCATOR_URL_PATH . 'public/datatable/media/css/demo_page.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'asl_datatable2', AGILESTORELOCATOR_URL_PATH . 'public/datatable/media/css/jquery.dataTables.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in AgileStoreLocator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The AgileStoreLocator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		//wp_enqueue_script( $this->AgileStoreLocator, AGILESTORELOCATOR_URL_PATH . 'public/js/jquery-1.11.3.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->AgileStoreLocator.'-lib', AGILESTORELOCATOR_URL_PATH . 'public/js/libs.min.js', array('jquery'), $this->version, false );
		wp_enqueue_script( $this->AgileStoreLocator.'-choosen', AGILESTORELOCATOR_URL_PATH . 'public/js/chosen.proto.min.js', array('jquery'), $this->version, false );
		wp_enqueue_script( $this->AgileStoreLocator.'-datatable', AGILESTORELOCATOR_URL_PATH . 'public/datatable/media/js/jquery.dataTables.min.js', array('jquery'), $this->version, false );
		wp_enqueue_script( 'bootstrap', AGILESTORELOCATOR_URL_PATH . 'public/js/bootstrap.min.js', array('jquery'), $this->version, false );
		wp_enqueue_script( $this->AgileStoreLocator.'-upload', AGILESTORELOCATOR_URL_PATH . 'admin/js/jquery.fileupload.min.js', array('jquery'), $this->version, false );
		wp_enqueue_script( $this->AgileStoreLocator.'-jscript', AGILESTORELOCATOR_URL_PATH . 'admin/js/jscript.js', array('jquery'), $this->version, false );
		
		wp_localize_script( $this->AgileStoreLocator.'-jscript', 'ASL_REMOTE', array( 'URL' => admin_url( 'admin-ajax.php' ),'1.1', true ));

	}

	public function upload_logo() {

		$response = new \stdclass();
		$response->success = false;


		$uniqid = uniqid();
		$target_dir  = AGILESTORELOCATOR_PLUGIN_PATH."public/Logo/";
	 	$target_file = $uniqid.'_'. strtolower($_FILES["files"]["name"]);
	 	$target_name = isset($_POST['data']['category_name'])?$_POST['data']['category_name']:('Logo '.time());
		
			
		$imageFileType = explode('.', $_FILES["files"]["name"]);
		$imageFileType = $imageFileType[count($imageFileType) - 1];


	
		//if file not found
		/*
		if (file_exists($target_name)) {
		    $response->message = "Sorry, file already exists.";
		}
		*/

		//to big size
		if ($_FILES["files"]["size"] >  5000000) {
		    $response->message = "Sorry, your file is too large.";
		}
		// not a valid format
		else if(!in_array($imageFileType, array('jpg','png','jpeg','gif','JPG'))) {
		    $response->message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		}
		// upload 
		else if(move_uploaded_file($_FILES["files"]["tmp_name"], $target_dir.$target_file)) {

			global $wpdb;
			$wpdb->insert(AGILESTORELOCATOR_PREFIX.'storelogos', 
			 	array('path'=>$target_file,'name'=>$target_name),
			 	array('%s','%s'));

      		$response->list = $wpdb->get_results( "SELECT * FROM ".AGILESTORELOCATOR_PREFIX."storelogos ORDER BY id DESC");
      	 	$response->message = "The file has been uploaded.";
      	 	$response->success = true;
		}
		//error
		else {

			$response->message = 'Some Error Occured';
		}

		echo json_encode($response);
	    die;
	}


	/*POST METHODS*/
	public function add_new_store() {

		global $wpdb;

		$response  = new \stdclass();
		$response->success = false;

		$form_data = $_REQUEST['data'];
		

		//insert into stores table
		if($wpdb->insert( AGILESTORELOCATOR_PREFIX.'stores', $form_data))
		{
			$response->success = true;
			$store_id = $wpdb->insert_id;


				/*Save Categories*/
			if(is_array($_REQUEST['category']))
				foreach ($_REQUEST['category'] as $category) {	

				$wpdb->insert(AGILESTORELOCATOR_PREFIX.'stores_categories', 
				 	array('store_id'=>$store_id,'category_id'=>$category),
				 	array('%s','%s'));			
			}

			$response->msg = 'Store added successfully.';
		}
		else
		{
			$response->error = 'Error occurred while saving Store';//$form_data
			$response->msg   =  $wpdb->last_error;
		}
		
		echo json_encode($response);die;	
	}

	//update Store
	public function update_store() {

		global $wpdb;

		$response  = new \stdclass();
		$response->success = false;

		$form_data = $_REQUEST['data'];
		$update_id = $_REQUEST['updateid'];

		//update into stores table
							
		$wpdb->update(AGILESTORELOCATOR_PREFIX."stores",
			array(
				'title'			=> $form_data['title'],
				'description'	=> $form_data['description'],
				'phone'			=> $form_data['phone'],
				'fax'			=> $form_data['fax'],
				'email'			=> $form_data['email'],
				'street'		=> $form_data['street'],
				'postal_code'	=> $form_data['postal_code'],
				'city'			=> $form_data['city'],
				'state'			=> $form_data['state'],
				'lat'			=> $form_data['lat'],
				'lng'			=> $form_data['lng'],
				'website'		=> $form_data['url'],
				'country'		=> $form_data['country'],
				'is_disabled'	=> $form_data['is_disabled'],
				'description_2'	=> $form_data['description_2'],
				'logo_id'		=> $form_data['logo_id'],
				'start_time'	=> $form_data['start_time'],
				'end_time'		=> $form_data['end_time'],
				'days'			=> $form_data['days'],
				'marker_id'		=> 1,
				'logo_id'		=> $form_data['logo_id'],
				'updated_on' 	=> date('Y-m-d H:i:s')
			),
			array('id' => $update_id)
		);

		$sql = "DELETE FROM ".AGILESTORELOCATOR_PREFIX."stores_categories WHERE store_id = ".$update_id;
		$wpdb->query($sql);

			if(is_array($_REQUEST['category']))
			foreach ($_REQUEST['category'] as $category) {	

			$wpdb->insert(AGILESTORELOCATOR_PREFIX.'stores_categories', 
			 	array('store_id'=>$update_id,'category_id'=>$category),
			 	array('%s','%s'));	
		}


		//ADD THE TIMINGS
		$timing_result = $wpdb->get_results("SELECT count(*) as c FROM ".AGILESTORELOCATOR_PREFIX."stores_timing WHERE store_id = $update_id");

		//INSERT OR UPDATE
		if($timing_result[0]->c == 0) {
			
			$datatime = $_REQUEST['datatime'];
			$datatime['store_id'] = $update_id;
			$wpdb->insert( AGILESTORELOCATOR_PREFIX.'stores_timing', $datatime);
		}

		else {

			$datatime = $_REQUEST['datatime'];
			$wpdb->update( AGILESTORELOCATOR_PREFIX.'stores_timing', $datatime,array('store_id' => $update_id));
		}


		$response->success = true;


		$response->msg = 'Store update successfully.';

			
		
			
				
		echo json_encode($response);die;
	}

	// to  delete the store
	public function delete_store() {

		global $wpdb;

		$response  = new \stdclass();
		$response->success = false;

		$store_id = $_REQUEST['store_id'];

		$sql = "DELETE FROM ".AGILESTORELOCATOR_PREFIX."stores WHERE id = ".$store_id;

		if($wpdb->query($sql))
		{

			$response->success = true;
			$response->msg = 'Store deleted successfully.';
		}
		else
		{
			$response->error = 'Error occurred while saving record';//$form_data
			$response->msg   = $wpdb->show_errors();
		}
		
		echo json_encode($response);die;
	}


	/////////////////////////////////ALL Category Methods
	/*Categories methods*/
	public function add_category() {

		global $wpdb;

		$response = new \stdclass();
			$response->success = false;

			$target_dir  = AGILESTORELOCATOR_PLUGIN_PATH."public/icon/";
			$namefile 	 = substr(strtolower($_FILES["files"]["name"]), 0, strpos(strtolower($_FILES["files"]["name"]), '.'));
			

			$imageFileType = pathinfo($_FILES["files"]["name"],PATHINFO_EXTENSION);
		 	$target_name   = uniqid();
			
			//add extension
			$target_name .= '.'.$imageFileType;

			///CREATE DIRECTORY IF NOT EXISTS
			if(!file_exists($target_dir)) {

				mkdir( $target_dir, 0775, true );
			}
			

			/*//if file not found
			if (file_exists($target_name)) {
			    $response->message = "Sorry, file already exists.";
			}
			//to big size
			else */
			if ($_FILES["files"]["size"] >  5000000) {
			    $response->message = "Sorry, your file is too large.";
			}
			// not a valid format
			else if(!in_array($imageFileType, array('jpg','png','jpeg','JPG','gif'))) {
			    $response->message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			}
			// upload 
			else if(move_uploaded_file($_FILES["files"]["tmp_name"], $target_dir.$target_name)) {
				
				$form_data = $_REQUEST['data'];

				if($wpdb->insert(AGILESTORELOCATOR_PREFIX.'categories', 
			 	array(	'category_name' => $form_data['category_name'],			 		
						'is_active'		=> 1,
						'icon'			=> $target_name
			 		),
			 	array('%s','%d','%s'))
				)
				{
					$response->message = "Category Add successfully";
	  	 			$response->success = true;
				}
				else
				{
					$response->message = 'Error occurred while saving record';//$form_data
					
				}
	      	 	
			}
			//error
			else {

				$response->message = 'Some error occured';
			}

			echo json_encode($response);
		    die;
	}

	//delete category
	public function delete_category() {

		global $wpdb;

		$response  = new \stdclass();
		$response->success = false;

		$store_id = $_REQUEST['category_id'];

		$sql = "DELETE FROM ".AGILESTORELOCATOR_PREFIX."categories WHERE id = ".$store_id;

		$categoriesesult = $wpdb->get_results("SELECT * FROM ".AGILESTORELOCATOR_PREFIX."categories WHERE id = ".$store_id );
		if(count($categoriesesult) != 0){
			if($wpdb->query($sql))
			{

				
					$inputFileName = AGILESTORELOCATOR_PLUGIN_PATH.'public/icon/'.$categoriesesult[0]->icon;
					
					if(file_exists($inputFileName)) {	
								
						unlink($inputFileName);
						$response->success = true;
						$response->msg = 'Category deleted successfully.';
					}							
			}
			else
			{
				$response->error = 'Error occurred while deleting record';//$form_data
				$response->msg   = $wpdb->show_errors();
			}
		}
		else
		{
			$response->error = 'Error occurred while deleting record';
		}
		
		echo json_encode($response);die;
	}

	//update category with icon
	public function update_category() {

		global $wpdb;

		$response  = new \stdclass();
		$response->success = false;

		$data = $_REQUEST['data'];
		
		
		// with icon
		if($data['action'] == "notsame") {

			$target_dir  = AGILESTORELOCATOR_PLUGIN_PATH."public/icon/";

			$namefile 	 = substr(strtolower($_FILES["files"]["name"]), 0, strpos(strtolower($_FILES["files"]["name"]), '.'));
			

			$imageFileType = pathinfo($_FILES["files"]["name"],PATHINFO_EXTENSION);
		 	$target_name   = uniqid();
			
			
			//add extension
			$target_name .= '.'.$imageFileType;

		 	
			$res = $wpdb->get_results( "SELECT * FROM ".AGILESTORELOCATOR_PREFIX."categories WHERE id = ".$data['category_id']);

			

		 	if ($_FILES["files"]["size"] >  5000000) {
			    $response->msg = "Sorry, your file is too large.";
			    
			    
			}
			// not a valid format
			else if(!in_array($imageFileType, array('jpg','png','gif','jpeg','JPG'))) {
			    $response->msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    
			}
			// upload 
			else if(move_uploaded_file($_FILES["files"]["tmp_name"], $target_dir.$target_name)) {
				//delete previous file

				
				
					$wpdb->update(AGILESTORELOCATOR_PREFIX."categories",array( 'category_name'=> $data['category_name'], 'icon'=> $target_name),array('id' => $data['category_id']),array( '%s' ), array( '%d' ));		
					$response->msg = 'Update successfully.';
					$response->success = true;
					if (file_exists($target_dir.$res[0]->icon)) {	
						unlink($target_dir.$res[0]->icon);
					}
			}
			//error
			else {

				$response->msg = 'Some error occured';
				
			}

		}
		//without icon
		else {

			$wpdb->update(AGILESTORELOCATOR_PREFIX."categories",array( 'category_name'=> $data['category_name']),array('id' => $data['category_id']),array( '%s' ), array( '%d' ));		
			$response->msg = 'Update successfully.';
			$response->success = true;	

		}
		
		echo json_encode($response);die;
	}


	//get category by id
	public function get_category_by_id() {

		global $wpdb;

		$response  = new \stdclass();
		$response->success = false;

		$store_id = $_REQUEST['category_id'];
		

		$response->list = $wpdb->get_results( "SELECT * FROM ".AGILESTORELOCATOR_PREFIX."categories WHERE id = ".$store_id);

		if(count($response->list)!=0){

			$response->success = true;

		}
		else{
			$response->error = 'Error occurred while geting record';//$form_data

		}
		echo json_encode($response);die;
	}


	/*GET the Categories*/
	public function get_categories() {

		global $wpdb;
		$start = isset( $_REQUEST['iDisplayStart'])?$_REQUEST['iDisplayStart']:0;		
		$params  = isset($_REQUEST)?$_REQUEST:null; 	

		$acolumns = array(
			'id','category_name','is_active','icon','created_on'
		);

		$columnsFull = $acolumns;

		$clause = array();

		if(isset($_REQUEST['filter'])) {

			foreach($_REQUEST['filter'] as $key => $value) {

				if($value != '') {

					if($key == 'is_active')
					{
						$value = ($value == 'yes')?1:0;
					}

					$clause[] = "$key like%'{$value}'%";
				}
			}	
		} 
		
		
		//iDisplayStart::Limit per page
		$sLimit = "";
		if ( isset( $_REQUEST['iDisplayStart'] ) && $_REQUEST['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".intval( $_REQUEST['iDisplayStart'] ).", ".
				intval( $_REQUEST['iDisplayLength'] );
		}

		/*
		 * Ordering
		 */
		$sOrder = "";
		if ( isset( $_REQUEST['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";

			for ( $i=0 ; $i < intval( $_REQUEST['iSortingCols'] ) ; $i++ )
			{
				if (isset($_REQUEST['iSortCol_'.$i]))
				{
					$sOrder .= "`".$acolumns[ intval( $_REQUEST['iSortCol_'.$i] )  ]."` ".$_REQUEST['sSortDir_0'];
					break;
				}
			}
			

			//$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}
		

		$sWhere = implode(' AND ',$clause);
		
		if($sWhere != '')$sWhere = ' WHERE '.$sWhere;
		
		$fields = implode(',', $columnsFull);
		
		###get the fields###
		$sql = 	"SELECT $fields FROM ".AGILESTORELOCATOR_PREFIX."categories";

		$sqlCount = "SELECT count(*) 'count' FROM ".AGILESTORELOCATOR_PREFIX."categories";

		/*
		 * SQL queries
		 * Get data to display
		 */
		$sQuery = "{$sql} {$sWhere} {$sOrder} {$sLimit}";
		$data_output = $wpdb->get_results($sQuery);
		
		/* Data set length after filtering */
		$sQuery = "{$sqlCount} {$sWhere}";
		$r = $wpdb->get_results($sQuery);
		$iFilteredTotal = $r[0]->count;
		
		$iTotal = $iFilteredTotal;

	    /*
		 * Output
		 */
		$sEcho = isset($_REQUEST['sEcho'])?intval($_REQUEST['sEcho']):1;
		$output = array(
			"sEcho" => intval($_REQUEST['sEcho']),
			//"test" => $test,
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		
		foreach($data_output as $aRow)
	    {
	    	$row = $aRow;

	    	if($row->is_active == 1) {

	        	 $row->is_active = 'Yes';
	        }	       
	    	else {

	    		$row->is_active = 'No';	
	    	}

	    	$row->icon = "<img  src='".AGILESTORELOCATOR_URL_PATH."public/icon/".$row->icon."' alt=''  style='width:20px'/>";	

	    	$row->action = '<div class="edit-options"><span data-id="'.$row->id.'" title="Edit" class="glyphicon glyphicon-edit edit_category"></span> &nbsp; | &nbsp;<span title="Delete" data-id="'.$row->id.'" class="glyphicon glyphicon-trash delete_category"></span></div>';
	        $output['aaData'][] = $row;
	    }

		echo json_encode($output);die;
	}



	/*GET List*/
	public function get_store_list() {
		
		global $wpdb;
		$start = isset( $_REQUEST['iDisplayStart'])?$_REQUEST['iDisplayStart']:0;		
		$params  = isset($_REQUEST)?$_REQUEST:null; 	

		$acolumns = array(
			AGILESTORELOCATOR_PREFIX.'stores.id ','title','description','street','state','city','phone','email','website','postal_code','is_disabled','days',AGILESTORELOCATOR_PREFIX.'stores.created_on'/*,'country_id'*/
		);

		$columnsFull = array(
			AGILESTORELOCATOR_PREFIX.'stores.id as id','title','description','street','state','city','phone','email','website','postal_code','is_disabled','days',AGILESTORELOCATOR_PREFIX.'stores.created_on'/*,AGILESTORELOCATOR_PREFIX.'countries.country_name'*/
		);

		

		$clause = array();

		if(isset($_REQUEST['filter'])) {

			foreach($_REQUEST['filter'] as $key => $value) {

				if($value != '') {

					if($key == 'is_disabled')
					{
						$value = ($value == 'yes')?1:0;
					}
					elseif($key == 'marker_id' || $key == 'logo_id')
					{
						
						$clause[] = AGILESTORELOCATOR_PREFIX."stores.{$key} = '{$value}'";
						continue;
					}

						
					$clause[] = AGILESTORELOCATOR_PREFIX."stores.{$key} LIKE '%{$value}%'";
				}
			}	
		} 
		
		

		//iDisplayStart::Limit per page
		$sLimit = "";
		if ( isset( $_REQUEST['iDisplayStart'] ) && $_REQUEST['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".intval( $_REQUEST['iDisplayStart'] ).", ".
				intval( $_REQUEST['iDisplayLength'] );
		}

		/*
		 * Ordering
		 */
		$sOrder = "";
		if ( isset( $_REQUEST['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";

			for ( $i=0 ; $i < intval( $_REQUEST['iSortingCols'] ) ; $i++ )
			{
				if (isset($_REQUEST['iSortCol_'.$i]))
				{
					$sOrder .= $acolumns[ intval( $_REQUEST['iSortCol_'.$i] )  ]." ".$_REQUEST['sSortDir_0'];
					break;
				}
			}
			

			//$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}
		

		$sWhere = implode(' AND ',$clause);
		
		if($sWhere != '')$sWhere = ' WHERE '.$sWhere;
		
		$fields = implode(',', $columnsFull);
		


		$fields .= ',start_time,end_time,marker_id,logo_id,group_concat(category_id) as categories';

		###get the fields###
		$sql = 	"SELECT $fields
				 FROM ".AGILESTORELOCATOR_PREFIX."stores 
				LEFT JOIN ".AGILESTORELOCATOR_PREFIX."stores_categories 
				ON ".AGILESTORELOCATOR_PREFIX."stores.id = ".AGILESTORELOCATOR_PREFIX."stores_categories.store_id";


		$sqlCount = "SELECT count(*) 'count' FROM ".AGILESTORELOCATOR_PREFIX."stores";

		/*
		 * SQL queries
		 * Get data to display
		 */
		$sQuery = "{$sql} {$sWhere} GROUP BY ".AGILESTORELOCATOR_PREFIX."stores.id {$sOrder} {$sLimit}";
		
		$data_output = $wpdb->get_results($sQuery);
		//$data_output = $wpdb->get_results( $sql);
			
		/* Data set length after filtering */
		$sQuery = "{$sqlCount} {$sWhere}";
		$r = $wpdb->get_results($sQuery);
		$iFilteredTotal = $r[0]->count;
		
		$iTotal = $iFilteredTotal;


	    /*
		 * Output
		 */
		$sEcho = isset($_REQUEST['sEcho'])?intval($_REQUEST['sEcho']):1;
		$output = array(
			"sEcho" => intval($_REQUEST['sEcho']),
			//"test" => $test,
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);

		$days_in_words = array('0'=>'Sun','1'=>'Mon','2'=>'Tues','3'=>'Wed','4'=>'Thur','5'=>'Fri','6'=>'Sat');
		foreach($data_output as $aRow)
	    {
	    	$row = $aRow;

	    	$edit_url = 'admin.php?page=edit-agile-store&store_id='.$row->id;

	    	$row->action = '<div class="edit-options"><a class="glyphicon glyphicon-duplicate" title="Duplicate" data-id="'.$row->id.'"></a>&nbsp; | &nbsp;<a href="'.$edit_url.'"><span title="Edit" class="glyphicon glyphicon-edit"></span></a> &nbsp; | &nbsp;<span title="Delete" data-id="'.$row->id.'" class="glyphicon glyphicon-trash"></span></div>';
	        if($row->is_disabled == 1){

	        	 $row->is_disabled = 'Yes';

	        }	       
	    	else{
	    		$row->is_disabled = 'No';	
	    	}

	    	//Days
	    	if($row->days) {
	    		$days 	  = explode(',',$row->days);
	    		$days_are = array();
	    		
	    		foreach($days as $d) {

	    			$days_are[] = $days_in_words[$d];
	    		}

	    		$row->days = $days_are;
	    	}

	        $output['aaData'][] = $row;

	        //get the categories
	     	if($aRow->categories) {

	     		$categories_ = $wpdb->get_results("SELECT category_name FROM ".AGILESTORELOCATOR_PREFIX."categories WHERE id IN ($aRow->categories)");

	     		$cnames = array();
	     		foreach($categories_ as $cat_)
	     			$cnames[] = $cat_->category_name;

	     		$aRow->categories = implode(', ', $cnames);
	     	}   
	    }

		echo json_encode($output);die;
	}



	//save setting
	public function save_setting() {

		global $wpdb;

		$response  = new \stdclass();
		$response->success = false;

		$data_ = $_POST['data'];
		$keys  =  array_keys($data_);

		foreach($keys as $key) {
			$wpdb->update(AGILESTORELOCATOR_PREFIX."configs",
				array('value' => $data_[$key]),
				array('key' => $key)
			);
		}

		$response->msg 	   = "Setting has been Updated Successfully.";
      	$response->success = true;

		echo json_encode($response);die;
	}

	
	/*Page Callee*/
	public function admin_plugin_settings() {

		include AGILESTORELOCATOR_PLUGIN_PATH.'admin/partials/add_store.php';
	}

	public function edit_store() {

		global $wpdb;

		$countries = $wpdb->get_results("SELECT id,country FROM ".AGILESTORELOCATOR_PREFIX."countries");
		$logos     = $wpdb->get_results( "SELECT * FROM ".AGILESTORELOCATOR_PREFIX."storelogos ORDER BY name");
		$markers   = $wpdb->get_results( "SELECT * FROM ".AGILESTORELOCATOR_PREFIX."markers");
        $category  = $wpdb->get_results( "SELECT * FROM ".AGILESTORELOCATOR_PREFIX."categories ");

		
		$store_id = isset($_REQUEST['store_id'])?$_REQUEST['store_id']:null;

		if(!$store_id) {
			die('Invalid Store Id.');
		}

		$store  = $wpdb->get_results("SELECT * FROM ".AGILESTORELOCATOR_PREFIX."stores WHERE id = $store_id");		
		$timing = $wpdb->get_results("SELECT * FROM ".AGILESTORELOCATOR_PREFIX."stores_timing WHERE store_id = $store_id");

		if($timing) {
			$timing = (array)$timing[0];
		}

		else {

			$timing['start_time_0'] = $timing['start_time_1'] = $timing['start_time_2'] = $timing['start_time_3'] = $timing['start_time_4'] = $timing['start_time_5'] = $timing['start_time_6'] = '';
			$timing['end_time_0'] = $timing['end_time_1'] = $timing['end_time_2'] = $timing['end_time_3'] = $timing['end_time_4'] = $timing['end_time_5'] = $timing['end_time_6'] = '';
		}


		$storecategory = $wpdb->get_results("SELECT * FROM ".AGILESTORELOCATOR_PREFIX."stores_categories WHERE store_id = $store_id");

		if(!$store || !$store[0]) {
			die('Invalid Store Id');
		}
		
		$store = $store[0];

		$storelogo = $wpdb->get_results("SELECT * FROM ".AGILESTORELOCATOR_PREFIX."storelogos WHERE id = ".$store->logo_id);
		

		//api key
		$sql = "SELECT `key`,`value` FROM ".AGILESTORELOCATOR_PREFIX."configs WHERE `key` = 'api_key'";
		$all_configs_result = $wpdb->get_results($sql);

		$all_configs = array('api_key' => $all_configs_result[0]->value);

		include AGILESTORELOCATOR_PLUGIN_PATH.'admin/partials/edit_store.php';		
	}

	public function admin_add_new_store() {
		
		global $wpdb;

		$sql = "SELECT `key`,`value` FROM ".AGILESTORELOCATOR_PREFIX."configs WHERE `key` = 'api_key'";
		$all_configs_result = $wpdb->get_results($sql);

		$all_configs = array('api_key' => $all_configs_result[0]->value);

        $logos     = $wpdb->get_results( "SELECT * FROM ".AGILESTORELOCATOR_PREFIX."storelogos ORDER BY name");
        $markers   = $wpdb->get_results( "SELECT * FROM ".AGILESTORELOCATOR_PREFIX."markers");
        $category = $wpdb->get_results( "SELECT * FROM ".AGILESTORELOCATOR_PREFIX."categories");
		$countries = $wpdb->get_results("SELECT * FROM ".AGILESTORELOCATOR_PREFIX."countries");

		include AGILESTORELOCATOR_PLUGIN_PATH.'admin/partials/add_store.php';    
	}

	public function admin_delete_all_stores() {
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$response = new \stdclass();
		$response->success = false;
		
		global $wpdb;
		$prefix = AGILESTORELOCATOR_PREFIX;
        
        $wpdb->query("TRUNCATE TABLE `{$prefix}stores_categories`");
        $wpdb->query("TRUNCATE TABLE `{$prefix}stores`");
     	
     	$response->success  = true;
     	$response->msg 	    = 'All stores deleted';

     	echo json_encode($response);die;
	}

	public function admin_manage_categories() {
		include AGILESTORELOCATOR_PLUGIN_PATH.'admin/partials/categories.php';
	}

	public function admin_store_markers() {
		include AGILESTORELOCATOR_PLUGIN_PATH.'admin/partials/markers.php';
	}
	

	public function admin_manage_store() {
		include AGILESTORELOCATOR_PLUGIN_PATH.'admin/partials/manage_store.php';
	}

	public function admin_import_stores() {
		include AGILESTORELOCATOR_PLUGIN_PATH.'admin/partials/import_store.php';
	}


	public function admin_customize_map() {

		global $wpdb;

		$sql = "SELECT `key`,`value` FROM ".AGILESTORELOCATOR_PREFIX."configs WHERE `key` = 'api_key'";
		$all_configs_result = $wpdb->get_results($sql);

		$all_configs = array('api_key' => $all_configs_result[0]->value);


		$map_customize  = $wpdb->get_results("SELECT content FROM ".AGILESTORELOCATOR_PREFIX."settings WHERE type = 'map' AND id = 1");
		$map_customize  = ($map_customize && $map_customize[0]->content)?$map_customize[0]->content:'[]';


		//add_action( 'init', 'my_theme_add_editor_styles' );
		include AGILESTORELOCATOR_PLUGIN_PATH.'admin/partials/customize_map.php';
	}

	

	public function admin_user_settings() {
	   
	   	global $wpdb;
	   	
		$sql = "SELECT `key`,`value` FROM ".AGILESTORELOCATOR_PREFIX."configs";
		$all_configs_result = $wpdb->get_results($sql);
		
		$all_configs = array();
		foreach($all_configs_result as $config)
		{
			$all_configs[$config->key] = $config->value;	
		}

		include AGILESTORELOCATOR_PLUGIN_PATH.'admin/partials/user_setting.php';
	}
}

