<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox-content">
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
<script type="text/javascript">

	$(document).ready(function() {
		$.ajax({
			url:  '<?php echo site_url('basic_table_json/ajax_list')?>',
			dataType : 'json',
			type : 'POST',
			cache: false,
			success : function(response) {
				callback(response);
			}

		});

		function callback(jsondata){
			var columns = [];
			$('#table').dataTable({
				"data": jsondata.data,
				"columns": jsondata.columns
			});
		}


});

</script>
