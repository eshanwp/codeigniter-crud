<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<form method="post" class="form-horizontal" action="<?php echo base_url();?>dynamic_form/ajax_save/" id="basic_form">
						<div class="after-add-more">
							<div class="col-sm-12 input-group control-group">
								<div class="col-sm-3" style="margin-right: 20px;">
									<div class="form-group" >
										<label>First Name <span style="color: red;">*</span></label>

										<label  class="text-danger" for="first_name" id="first_name_0-error"></label>

										<input type="text" class="form-control" name="first_name[]"  placeholder="First Name">

									</div>
								</div>
								<div class="col-sm-3" style="margin-right: 20px;">
									<div class="form-group">
										<label>Last Name <span style="color: red;">*</span></label>

										<label  class="text-danger last_name-error" for="last_name" id="last_name_0-error"></label>

										<input type="text" class="form-control" name="last_name[]"  placeholder="Last Name" >

									</div>
								</div>
								<div class="col-sm-3" style="margin-right: 20px;">
									<div class="form-group">
										<label>Upload File <span style="color: red;">* </span></label>

										<label  class="text-danger inputfile-error" for="inputfile" id="inputfile_0-error"></label>

										<input type="file" class="form-control" name="inputfile[]" accept=".jpg" >

									</div>
								</div>
								<div class="col-sm-2">
									<div class="input-group-btn"> 

										<button class="btn btn-success add-more" type="button" style="margin: 21px;"><i class="glyphicon glyphicon-plus"></i> Add</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<br><div id="messages"></div>
							<br><div id="error"></div>
						</div>
						<div class="col-sm-12" style="margin-top: 20px;">
							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-3">
									<button class="btn btn-primary" type="submit"  id="submit" onclick="basic_form()">Save changes</button>
									<button class="btn btn-danger" type="reset">Cancel</button>
									
								</div>
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


</div>
</div>
<script type="text/javascript">

	

</script>

<script type="text/javascript">

	$(document).ready(function() {
		
		var x = 0;		
		$(".add-more").click(function(){ 
			x++;
			
			var html = '<div class="col-sm-12 input-group control-group">'+
			'<div class="col-sm-3" style="margin-right: 20px;">'+
			'<div class="form-group">'+

			//Strat First Name
			'<label>First Name <span style="color: red;">* &nbsp;</span></label>'+

			'<label  class="text-danger" for="first_name" id="first_name_'+x+'-error"></label>'+

			'<input type="text" class="form-control" name="first_name[]"  placeholder="First Name">'+

			'</div>'+
			'</div>'+
			//End First Name

			//Strat Last Name
			'<div class="col-sm-3" style="margin-right: 20px;">'+
			'<div class="form-group">'+
			'<label>Last Name <span style="color: red;">*&nbsp; </span></label>'+

			'<label  class="text-danger" for="last_name" id="last_name_'+x+'-error"></label>'+

			'<input type="text" class="form-control" name="last_name[]"  placeholder="Last Name">'+

			'</div>'+
			'</div>'+
			//End Last Name

			//Strat Upload File
			'<div class="col-sm-3 " style="margin-right: 20px;">'+
			'<div class="form-group">'+
			'<label>Upload File <span style="color: red;">* </span></label>'+
			'<label  class="text-danger inputfile-error" for="inputfile" id="inputfile_'+x+'-error"></label>'+
			'<input type="file" class="form-control" name="inputfile[]" accept=".jpg" >'+
			'</div>'+
			'</div>'+
			//End Upload File

			'<div class="col-sm-2">'+
			'<div class="input-group-btn">'+
			'<button class="btn btn-danger remove" type="button" style="margin: 21px;"><i class="glyphicon glyphicon-remove"></i> Remove</button>'+
			'</div>'+
			'</div>'+
			'</div>';
			$('.after-add-more').append(html);  
		});

		$("body").on("click",".remove",function(){ 
			$(this).parents(".control-group").remove();
		});

	});
	

	function basic_form(){
		$(document).on('submit', '#basic_form', function(e) {
            e.preventDefault();
			var form = $('#basic_form')[0];
			var formData = new FormData(form);

			$.ajax({
				url:  $("#basic_form").attr("action"),
				dataType : 'json',
				type : 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success : function(response) {
					$('.text-danger').html('');
					$('.text-danger').html('');
					$('.form-group').removeClass('has-error');
					$('#error').removeClass('has-error');
					console.clear();
					console.log(response);
					if(response.status == false) {
						$.each(response.form_validation,function(i,m){

							var i = i.replace('[]', '');//for checkbox
							$('#'+i+'-error').html(m);
							$('#'+i+'-error').parent().addClass('has-error');

						});
						if (response.error) {
							$('#error').html('<div class="alert alert-danger"><b>'+response.error+'<b></div>').fadeIn();
							setTimeout(function() { 
								$('#error').fadeOut();
							}, 3000);
						}
						
						
					}else{
						$('#messages').html('<div class="alert alert-success"><b>'+response.message+'<b></div>').fadeIn();

						setTimeout(function() { 
							$('#messages').fadeOut(); 
							window.location.href = '<?php echo base_url();?>dynamic_form/';
						}, 3000);
						$("#basic_form")[0].reset();
						
					}
				}

			});
		});
	}
</script>