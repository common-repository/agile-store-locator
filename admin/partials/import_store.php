<!-- Container -->
<div class="asl-p-cont">
<div class="dump-message asl-dumper"></div>
<div class="row" id="message_complete">
</div>
	<h3>Import Stores</h3>
	<div class="well">
		<div class="row">
			<div class="col-md-4">
				<input type="checkbox" class="form-control col-xs-1" checked="checked" id="asl-create-category">
				<label class="form-label col-xs-11 font-11">Create Category If NOT Exist During Import</label>
			</div>
			<div class="col-md-1">
				<button type="button" class="btn btn-success" onclick="asl_lock()" data-toggle="modal" data-target="#import_store_file_emodel">Upload</button>
			</div>
			<div class="col-md-1">
				<button type="button" class="btn btn-success"  onclick="asl_lock()" id="export_store_file_">Export All</button>
			</div>
			<div class="col-md-1">
				<button type="button" class="btn btn-danger" onclick="asl_lock()" data-loading-text="Deleting..." id="asl-delete-stores">Delete All</button>
			</div>
			<div class="col-md-1">
				<a target="_blank" class="btn" href="javascript:void(0)">Template.xlsx</a>
			</div>
		</div>
	</div>

	<table id="tbl_stores" class="table table-bordered">
      <thead>
      	<tr>        
          <th align="center">File Name</th>
          <th align="center">Date</th>
          <th align="center">View</th>
          <th align="center">Import</th>
          <th align="center">Delete</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>


</div>

<!-- SCRIPTS -->
<script type="text/javascript">
	var ASL_Instance = {
		url: '<?php echo AGILESTORELOCATOR_URL_PATH ?>'
	};
</script>