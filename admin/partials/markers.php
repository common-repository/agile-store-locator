<!-- Container -->
<div class="asl-p-cont">
  <h3>Manage Markers</h3>

  <div class="row">
    <div class="col-md-12 ralign">
      <button type="button"  onclick="asl_lock()" style="margin-bottom:20px"  class="btn btn-primary mrg-r-10">New Marker</button>
    </div>
  </div>
	<table id="tbl_markers" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th align="center"><input type="text" data-id="id"  placeholder="Search ID"  /></th>
          <th align="center"><input type="text" data-id="marker_name"  placeholder="Search Name"  /></th>
          <th align="center"><input type="text" data-id="is_active"  placeholder="Active"  /></th>
          <th align="center">&nbsp;</th>
          <th align="center">&nbsp;</th>
        </tr>
        <tr>
          <th align="center">Marker ID</th>
          <th align="center">Name</th>
          <th align="center">Active</th>
          <th align="center">Icon</th>
          <th align="center">Action&nbsp;</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
	<div class="dump-message asl-dumper"></div>


</div>


<!-- asl-cont end-->
</div>


<!-- SCRIPTS -->
<script type="text/javascript">
var ASL_Instance = {
	url: '<?php echo AGILESTORELOCATOR_URL_PATH ?>'
};

var ASL_upload = '<?php echo AGILESTORELOCATOR_PLUGIN_PATH ?>';
</script>
