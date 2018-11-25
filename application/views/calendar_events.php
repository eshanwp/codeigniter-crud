<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <div id="calendar"></div>

                </div>
            </div>
        </div>
        <!--  addModal-->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Calendar Event</h4>
                    </div>
                    <form method="post" class="form-horizontal" action="<?php echo base_url();?>calendar_events/add_event/" id="add_event">

                        <div class="modal-body">
                            <!-- Event Name -->
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Event Name <span style="color: red;">*</span></label>
                                
                                <div class="col-md-8 ui-front">
                                    <input type="text" class="form-control" name="event_name" id="event_name" placeholder="Event Name">
                                    <label id="event_name-error" class="text-danger" for="event_name"></label>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Description <span style="color: red;">*</span></label>
                                
                                <div class="col-md-8 ui-front">
                                    <textarea class="form-control" name="description" id="description" placeholder="Description" style="resize: none;" rows ="6"></textarea>
                                    <label id="description-error" class="text-danger" for="description"></label>
                                </div>
                            </div>

                            <!-- Event Options -->
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Event Options <span style="color: red;">*</span></label>
                                
                                <div class="col-md-8 ui-front">
                                    <select name="event_options" class="form-control" id="event_options">
                                        <option value="">Choose</option>
                                        <option style="color:#800080;" value="#800080-Option 1">&#9724; Option 1</option>
                                        <option style="color:#FF0000;" value="#FF0000-Option 2">&#9724; Option 2</option>
                                        <option style="color:#1ab394;" value="#1ab394-Option 3">&#9724; Option 3</option>   
                                        <option style="color:#FF8C00;" value="#FF8C00-Option 4">&#9724; Option 4</option>
                                        <option style="color:#FFD700;" value="#FFD700-Option 5">&#9724; Option 5</option>
                                        <option style="color:#008000;" value="#008000-Option 6">&#9724; Option 6</option>
                                        <option style="color:#0000ff;" value="#0000ff-Option 7">&#9724; Option 7</option>

                                    </select>
                                    <label id="event_options-error" class="text-danger" for="event_options"></label>
                                </div>
                            </div>
                            <!-- Start Date -->
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Start Date <span style="color: red;">*</span></label>
                                
                                <div class="col-md-8 ui-front">

                                    <div class="input-group date">
                                        <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Start Date" data-mask="9999-99-99 99:99">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <label id="start_date-error" class="text-danger" for="start_date"></label>
                                </div>
                            </div>
                            <!-- End Date -->
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">End Date <span style="color: red;">*</span></label>
                                
                                <div class="col-md-8 ui-front">

                                    <div class="input-group date">
                                        <input type="text" class="form-control" name="end_date" id="end_date" placeholder="End Date" data-mask="9999-99-99 99:99">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <label id="end_date-error" class="text-danger" for="end_date"></label>
                                </div>
                            </div>
                            <!-- Event Status -->
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Event Status <span style="color: red;">*</span></label>
                                
                                <div class="col-md-8 ui-front">
                                    <label class="radio-inline i-checks"> 
                                        <input type="radio" value="1" name="event_status" checked> <b>Active</b> 
                                    </label>
                                    <label class="radio-inline i-checks"> 
                                        <input type="radio" value="0" name="event_status"> <b>Deactive</b> 
                                    </label>
                                    <label id="event_status-error" class="text-danger" for="event_status"></label>
                                </div>
                            </div>
                            <br><div id="messages"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button"  id="submit" onclick="add_event()">Add Event</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end addModal -->

        <!-- editModal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Update Calendar Event</h4>
                    </div>
                    <form method="post" class="form-horizontal" action="<?php echo base_url();?>calendar_events/update_event/" id="update_event">

                        <div class="modal-body">
                            <!-- Event Name -->
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Event Name <span style="color: red;">*</span></label>
                                
                                <div class="col-md-8 ui-front">
                                    <input type="text" class="form-control" name="event_name" id="event_name" placeholder="Event Name">
                                    <label id="event_name-error" class="text-danger" for="event_name"></label>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Description <span style="color: red;">*</span></label>
                                
                                <div class="col-md-8 ui-front">
                                    <textarea class="form-control" name="description" id="description" placeholder="Description" style="resize: none;" rows ="6"></textarea>
                                    <label id="description-error" class="text-danger" for="description"></label>
                                </div>
                            </div>

                            <!-- Event Options -->
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Event Options <span style="color: red;">*</span></label>
                                
                                <div class="col-md-8 ui-front">
                                    <select name="event_options" class="form-control" id="event_options">
                                        <option value="">Choose</option>
                                        <option style="color:#800080;" value="#800080-Option 1">&#9724; Option 1</option>
                                        <option style="color:#FF0000;" value="#FF0000-Option 2">&#9724; Option 2</option>
                                        <option style="color:#1ab394;" value="#1ab394-Option 3">&#9724; Option 3</option>   
                                        <option style="color:#FF8C00;" value="#FF8C00-Option 4">&#9724; Option 4</option>
                                        <option style="color:#FFD700;" value="#FFD700-Option 5">&#9724; Option 5</option>
                                        <option style="color:#008000;" value="#008000-Option 6">&#9724; Option 6</option>
                                        <option style="color:#0000ff;" value="#0000ff-Option 7">&#9724; Option 7</option>

                                    </select>
                                    <label id="event_options-error" class="text-danger" for="event_options"></label>
                                </div>
                            </div>
                            <!-- Start Date -->
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Start Date <span style="color: red;">*</span></label>
                                
                                <div class="col-md-8 ui-front">

                                    <div class="input-group date">
                                        <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Start Date" data-mask="9999-99-99 99:99">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <label id="start_date-error" class="text-danger" for="start_date"></label>
                                </div>
                            </div>
                            <!-- End Date -->
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">End Date <span style="color: red;">*</span></label>
                                
                                <div class="col-md-8 ui-front">

                                    <div class="input-group date">
                                       <input type="text" class="form-control" name="end_date" id="end_date" placeholder="End Date" data-mask="9999-99-99 99:99">
                                       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                   </div>
                                   <label id="end_date-error" class="text-danger" for="end_date"></label>
                               </div>
                               <input type="hidden" name="id" class="form-control" id="id">
                            </div>
                            <!-- Event Status -->
                            <div class="form-group">
                                <label for="p-in" class="col-md-4 label-heading">Event Status <span style="color: red;">*</span></label>
                                
                                <div class="col-md-8 ui-front">
                                    <label class="radio-inline i-checks"> 
                                        <input type="radio" value="1" name="event_status" id="event_status1"> <b>Active</b> 
                                    </label>
                                    <label class="radio-inline i-checks"> 
                                        <input type="radio" value="0" name="event_status" id="event_status2"> <b>Deactive</b> 
                                    </label>
                                    <label id="event_status-error" class="text-danger" for="event_status"></label>
                                </div>
                            </div>
                            <br><div id="messages"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button" id="submit"  onclick="update_event()">Update Event</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end editModal -->

       
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var h = d.getHours();
        var m = d.getMinutes();
        var today = d.getFullYear() + '-' + 
        ((''+month).length<2 ? '0' : '') + month + '-' +
        ((''+day).length<2 ? '0' : '') + day + 
        ' '+((''+h).length<2 ? '0' : '') + h + 
        ':'+((''+m).length<2 ? '0' : '') + m; 
        
        
        $('.input-group.date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',

        });

        var date_last_clicked = null;
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            displayEventTime : false,
            timezone:'local',
            startDate : '2017-02-04',

            
            events: '<?php echo base_url() ?>calendar_events/get_events/',
            
            select: function(start, end) {
                if(start.isBefore(moment())) {

                }else{
                    $('#add_event .text-danger').html('');
                    $('#add_event .form-group').removeClass('has-error');
                    $("#add_event")[0].reset();
                    $('#start_date').attr("placeholder",today);
                    $('#end_date').attr("placeholder", today);
                    $('#addModal').modal('show');

                }    
            },
            eventRender: function(event, element) {
                
                element.bind('click', function() {
                    $('#editModal .text-danger').html('');
                    $('#editModal .form-group').removeClass('has-error');
                    $('#update_event #submit').prop('disabled', false);
                    $('#editModal #id').val(event.id);
                    $('#editModal #event_name').val(event.title);
                    $('#editModal #description').val(event.description);
                    $("#editModal #event_options").val(event.event_options);
                    $('#editModal #start_date').val((event.start).format('YYYY-MM-DD HH:mm'));
                    $('#editModal #end_date').val((event.end).format('YYYY-MM-DD HH:mm'));
                    if (event.status == 1) {
                        $('#editModal #event_status1').iCheck('check');
                    } else {
                        $('#editModal #event_status2').iCheck('check');
                    }

                    $('#editModal').modal('show');
                    
                });
                
            },
        });



    });
    function add_event(){

        var form = $('#add_event')[0];
        var formData = new FormData(form);
        $('#add_event #submit').prop('disabled', true);
        $.ajax({
            url:  $("#add_event").attr("action"),
            dataType : 'json',
            type : 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success : function(response) {
                $('#add_event .text-danger').html('');
                $('#add_event .form-group').removeClass('has-error');
                console.clear();
                console.log(response);
                if(response.status == false) {
                    $.each(response.message,function(i,m){
                            $('#add_event #submit').prop('disabled', false);
                            var i = i.replace('[]', '');//for checkbox
                            $('#add_event #'+i+'-error').html(m);
                            $('#add_event #'+i+'-error').parent().parent().addClass('has-error');

                        });


                }else{
                    $('#add_event #messages').html('<div class="alert alert-success"><b>'+response.message+'</b></div>').fadeIn();

                    setTimeout(function() { 
                        $('#add_event #messages').fadeOut(); 
                        $('#add_event #addModal').modal('toggle');
                        $('#add_event #calendar').fullCalendar( 'refetchEvents' );
                    }, 3000);
                    $("#add_event")[0].reset();


                }

            }

        });
    }
    function update_event(){
        var form = $('#update_event')[0];
        var formData = new FormData(form);
        $('#update_event #submit').prop('disabled', true);
        $.ajax({
            url:  $("#update_event").attr("action"),
            dataType : 'json',
            type : 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success : function(response) {
                $('#update_event .text-danger').html('');
                $('#update_event .form-group').removeClass('has-error');
                console.clear();
                console.log(response);
                if(response.status == false) {
                    $.each(response.message,function(i,m){
                            $('#update_event #submit').prop('disabled', false);
                            var i = i.replace('[]', '');//for checkbox
                            $('#update_event #'+i+'-error').html(m);
                            $('#update_event #'+i+'-error').parent().parent().addClass('has-error');

                        });


                }else{
                    $('#update_event #messages').html('<div class="alert alert-success"><b>'+response.message+'</b></div>').fadeIn();

                    setTimeout(function() { 
                        $('#update_event #messages').fadeOut(); 
                        $("#update_event")[0].reset();
                        $('#editModal').modal('toggle');
                        $('#calendar').fullCalendar( 'refetchEvents' );

                    }, 3000);
                   


                }

            }

        });
    }
</script>
