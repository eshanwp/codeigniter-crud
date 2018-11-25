<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox-content">
				<div class="table-responsive">  
					<br />  
					<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="10%">No</th>
								<th width="60%">Gallery Titel</th>
								<th width="5%">Update</th>
								<th width="5%">Delete</th>
								

							</tr>
						</thead>


					</table>
				</div>  
				<div class="col-sm-6">
                    <br><div id="messages"></div>
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
			url:  '<?php echo site_url('gallery/gallery_list')?>',
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
				
			});
		}


	});
	function delete_data(gallery_id)
	{
		if(confirm('Are you sure delete this data?')){
			$.ajax({
				url : "<?php echo base_url().'gallery/delete_gallery/' ;?>"+gallery_id,
				type: "POST",
				dataType: "JSON",
				success: function(data){
					$('#messages').html('<div class="alert alert-danger"><b>Gallery Successfully Deleted.</b></div>').fadeIn();

					setTimeout(function() { 
						$('#messages').fadeOut(); 
						location.reload();
					}, 3000);
				},
				error: function (jqXHR, textStatus, errorThrown){
					
					$('#messages').html('<div class="alert alert-danger"><b>Gallery Deleting Error.</b></div>').fadeIn();

					setTimeout(function() { 
						$('#messages').fadeOut(); 
						location.reload();
					}, 3000);
				}
			});

		}
	}

</script>
