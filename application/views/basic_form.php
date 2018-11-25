<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<form method="post" class="form-horizontal" action="<?php echo base_url();?>basic_form/ajax_save/" id="basic_form">
						<div class="col-sm-5">
							<div class="form-group">
								<label>First Name <span style="color: red;">*</span></label>

								<label id="first_name-error" class="text-danger" for="first_name"></label>

								<input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?= set_value('first_name'); ?>" >

							</div>
						</div>
						<div class="col-sm-5 col-sm-offset-1">
							<div class="form-group">
								<label>Last Name <span style="color: red;">*</span></label>

								<label id="last_name-error" class="text-danger" for="last_name"></label>

								<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?= set_value('last_name'); ?>" >

							</div>
						</div>

						<div class="col-sm-5">
							<div class="form-group">
								<label>NIC Number <span style="color: red;">*</span></label>

								<label id="nic_number-error" class="text-danger" for="nic_number"></label>

								<input type="text" class="form-control" name="nic_number" id="nic_number" placeholder="NIC Number" value="<?= set_value('nic_number'); ?>" >

							</div>
						</div>

						<div class="col-sm-5 col-sm-offset-1">
							<div class="form-group">
								<label>Date Of Birth <span style="color: red;">*</span></label>

								<label id="date_of_birth-error" class="text-danger" for="date_of_birth"></label>

								<div class="input-group date">
									<input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="<?= set_value('date_of_birth'); ?>" >
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>

							</div>
							
						</div>

						<div class="col-sm-5">
							<div class="form-group">
								<label>Contact No <span style="color: red;">*</span></label>

								<label id="contact_no-error" class="text-danger" for="contact_no"></label>

								<input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Contact No" value="<?= set_value('contact_no'); ?>" >

							</div>
						</div>
						<div class="col-sm-5 col-sm-offset-1">
							<div class="form-group">
								<label>Email Address <span style="color: red;">*</span></label>

								<label id="email-error" class="text-danger" for="email"></label>

								<input type="text" class="form-control" name="email" id="email" placeholder="Email Address" value="<?= set_value('email'); ?>" >

							</div>
						</div>
						<div class="col-sm-8">
							<div class="form-group">
								<br><label>Gender <span style="color: red;">*</span></label>
								<label id="gender-error" class="text-danger" for="gender"></label><br>
								<label class="radio-inline i-checks"> 
									<input type="radio" value="Male" name="gender"> <b>Male</b> 
								</label>
								<label class="radio-inline i-checks"> 
									<input type="radio" value="Female" name="gender"> <b>Female</b> 
								</label>

							</div>
						</div>
						<div class="col-sm-5">
							<div class="form-group">
								<label>Experience <span style="color: red;">*</span></label>

								<label id="experience-error" class="text-danger" for="experience"></label>
								<?php 
								$options = array('0' =>'No','1' =>'1 Year','2' =>'2 Years','3'=> '3 Years');
								?>
								<select class="form-control" id="experience" name="experience">
									<option></option>
									<?php 
									foreach($options as $key => $value){ 
										?>
										<option value="<?php echo $key;?>" <?php echo set_select('apply_for', $key); ?> ><?php echo $value; ?></option>
										<?php 
									}
									?>
									
								</select>

							</div>
						</div>

						<div class="col-sm-8">
							<div class="form-group">
								<label>Qualifications <span style="color: red;">*</span></label>
								<label id="qualifications-error" class="text-danger" for="qualifications"></label><br>
								<label class="checkbox-inline i-checks"> 
									<input type="checkbox" value="Ordinary Level" name="qualifications[]"> <b>Ordinary Level</b> 
								</label>
								<label class="checkbox-inline i-checks"> 
									<input type="checkbox" value="Advanced Level" name="qualifications[]"> <b>Advanced Level</b> 
								</label>
								<label class="checkbox-inline i-checks"> 
									<input type="checkbox" value="Diploma" name="qualifications[]"> <b>Diploma</b> 
								</label><br><br>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Upload File <span style="color: red;">*</span></label>

								<label id="inputfile-error" class="text-danger" for="inputfile"></label><br>

								<input type="file" name="inputfile[]" multiple accept=".jpg" id="inputfile">

								

							</div>
						</div>
						

						<div class="col-sm-12">
							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-3">
									<button class="btn btn-primary" type="submit" id="submit"  onclick="basic_form()">Save changes</button>
									<button class="btn btn-danger" type="reset">Cancel</button>
									
								</div>
							</div>

						</div>
						<div class="col-sm-6">
							<br><div id="messages"></div>
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

	function basic_form(){
		$(document).on('submit', '#basic_form', function(e) {
            e.preventDefault();
			var form = $('#basic_form')[0];
			var formData = new FormData(form);
			 $('#submit').prop('disabled', true);
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
					$('.form-group').removeClass('has-error');
					console.clear();
					console.log(response);
					if(response.status == false) {
						$.each(response.message,function(i,m){
							$('#submit').prop('disabled', false);
							var i = i.replace('[]', '');//for checkbox
							$('#'+i+'-error').html(m);
							$('#'+i+'-error').parent().addClass('has-error');

						});

						
					}else{
						$('#messages').html('<div class="alert alert-success"><b>'+response.message+'</b></div>').fadeIn();

						setTimeout(function() { 
							$('#messages').fadeOut(); 
							window.location.href = '<?php echo base_url();?>basic_form/';
						}, 3000);
						$("#basic_form")[0].reset();
						
						
					}

				}

			});
		});
	}

</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.input-group.date').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			format: "yyyy-mm-dd",
			orientation: "bottom left",
			autoclose: true,
			todayHighlight: true
		});
		$("#experience").select2({
            placeholder: "Select Year of Experience"
        });
	});

	
</script>