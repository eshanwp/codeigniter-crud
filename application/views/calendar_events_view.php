<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <div id="calendar"></div>

                </div>
            </div>
        </div>
       
        <!-- viewModal -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">View Calendar Event</h4>
                    </div>
                    
                    <div class="modal-body" style="min-height: 250px">
                        <!-- Event Name -->
                        
                        <label for="p-in" class="col-md-4 label-heading">Event Name :</label>

                        <div class="col-md-8 ui-front">
                            <label id="event_name" style="font-weight:400;"></label>
                        </div><br><br>

                        <!-- Description -->
                        <label for="p-in" class="col-md-4 label-heading">Description :</label>

                        <div class="col-md-8 ui-front">
                            <label id="description" style="font-weight:400;"></label>
                        </div><br><br>

                        <!-- Event Options -->
                        <label for="p-in" class="col-md-4 label-heading">Event Options :</label>

                        <div class="col-md-8 ui-front">
                            <label id="event_options" style="font-weight:400;"></label>
                        </div><br><br>

                        <!-- Event Options -->
                        <label for="p-in" class="col-md-4 label-heading">Start Date :</label>

                        <div class="col-md-8 ui-front">
                            <label id="start_date" style="font-weight:400;"></label>
                        </div><br><br>

                        <!-- Event Options -->
                        <label for="p-in" class="col-md-4 label-heading">End Date :</label>

                        <div class="col-md-8 ui-front">
                            <label id="end_date" style="font-weight:400;"></label>
                        </div><br><br>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end viewModal -->
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
        ':'+((''+m).length<2 ? '0' : '') + m + 
        ' '+((h)<12 ? 'AM' : 'PM'); 
       
        var date_last_clicked = null;
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            eventLimit: true, 
            selectable: true,
            selectHelper: true,
            displayEventTime : false,
            timezone:'local',
            eventSources: [
            {
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: '<?php echo base_url() ?>calendar_events_view/get_events/',
                        dataType: 'json',
                        data: {
                            start: start.unix(),
                            end: end.unix()
                        },
                        success: function(msg) {
                            var events = msg.events;
                            callback(events);
                        }
                    });
                }
            }
            ],
            
            
            eventRender: function(event, element) {
                
                element.bind('click', function() {
                    $('#viewModal #event_name').text(event.title);
                    $('#viewModal #description').text(event.description);
                    $("#viewModal #event_options").text(event.options);
                    $('#viewModal #start_date').text((event.start).format('YYYY-MM-DD HH:mm A'));
                    $('#viewModal #end_date').text((event.end).format('YYYY-MM-DD HH:mm A'));
                    $('#viewModal').modal('show');
                    
                });
                
            },
        });



    });
    
   
</script>
