<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox-content">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title" >Custom Filter : </h3>
					</div>
					<div class="panel-body">
						<form id="form-filter" class="form-horizontal">
							<div class="form-group">
								<label for="country" class="col-sm-2 control-label">Country</label>
								<div class="col-sm-4">
									<?php echo $form_country; ?>
								</div>
							</div>
							<div class="form-group">
								<label for="FirstName" class="col-sm-2 control-label">First Name</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="FirstName" name="FirstName">
								</div>
							</div>
							<div class="form-group">
								<label for="LastName" class="col-sm-2 control-label">Last Name</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="LastName" name="LastName">
								</div>
							</div>
							
							<div class="form-group">
								<label for="LastName" class="col-sm-2 control-label"></label>
								<div class="col-sm-4">
									<button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
									<button type="button" id="btn-reset" class="btn btn-default" onclick="all_data()">Reset</button>
								</div>
							</div>
						</form>
					</div>
				</div>  
				<div class="table-responsive">  
					<br />  
					<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
						


					</table>
				</div>  
			</div>
		</div>
	</div>
</div>


</div>
</div>
<script>
	function callback(jsondata){
		if ( $.fn.DataTable.isDataTable('#table') ) {
			$('#table').DataTable().destroy();
		}

		$('#table tbody').empty();
		var columns = [];
		table = $('#table').dataTable({
			"data": jsondata.data,
			"columns": jsondata.columns
		});
		
	}
	function all_data() {
		$("#country option").attr("selected", false);
		$.ajax({
			url:  '<?php echo site_url('basic_table_json_filter/ajax_list')?>',
			dataType : 'json',
			type : 'POST',
			cache: false,
			success : function(response) {
				callback(response);
			}

		});
	}
	$(document).ready(function() {
		all_data();
	});
	$( "#btn-filter" ).click(function(event)
	{
		event.preventDefault();
		var country= $("#country").val();
		var FirstName= $("#FirstName").val();
		var LastName= $("#LastName").val();
		$.ajax({
			url:  '<?php echo site_url('basic_table_json_filter/ajax_list')?>',
			dataType : 'json',
			data:{country:country,FirstName:FirstName,LastName:LastName},
			type : 'POST',
			cache: false,
			success : function(response) {
				callback(response);
			}

		});

	});
	
</script>
