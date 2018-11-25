<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="-1" />

  <title><?= $page_title; ?></title>

  <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">

  <!-- Full Calendar -->
  <link href="<?php echo base_url();?>assets/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>

  <link href="<?php echo base_url();?>assets/css/plugins/slick/slick.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/plugins/slick/slick-theme.css" rel="stylesheet">

  <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

  <link href="<?php echo base_url();?>assets/css/plugins/cropper/cropper.min.css" rel="stylesheet">

  <!-- dataTables -->
  <link href="<?php echo base_url();?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

  <!-- datapicker -->
  <link href="<?php echo base_url();?>assets/css/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
  

  <!-- Select2 -->
  <link href="<?php echo base_url();?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">

  <!-- fileuploader -->
  <link href="<?php echo base_url();?>assets/css/plugins/fileuploader/jquery.fileuploader.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/plugins/fileuploader/jquery.fileuploader-theme-thumbnails.css" rel="stylesheet">



  <link href="<?php echo base_url();?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

  <script src="<?php echo base_url();?>assets/js/plugins/fullcalendar/moment.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery-2.1.1.js"></script>
  <!-- Full Calendar -->
  <script src="<?php echo base_url();?>assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
  
  <!-- fileuploader -->
  <script src="<?php echo base_url();?>assets/js/plugins/fileuploader/jquery.fileuploader.min.js"></script>
  
  
  <style type="text/css">
  .ibox-content {
    overflow: hidden;
  }
  .checkbox-inline+.checkbox-inline, .radio-inline+.radio-inline {
    margin-top: 0;
    margin-left: 0px;
  }
  .fc-day-grid-event .fc-time{
    display: none;
  }
  .fc-day-grid-event > .fc-content {
    white-space: nowrap;
    font-weight: bold;
    font-size: 12px;
    overflow: hidden;
  }
  td.fc-day.fc-past {
    background-color: #EEEEEE;
  }
  .fileuploader-popup {
    position: static ;
  }
  .fileuploader-popup-preview .tools li h5{
    overflow: visible;
  }
  .fileuploader-popup-preview .tools li{
    padding: 0 10px;
  }
  .fileuploader-theme-thumbnails .fileuploader-thumbnails-input, .fileuploader-theme-thumbnails .fileuploader-items-list .fileuploader-item {
    width: 12%;
    
  }
</style>
</head>

<body>

  <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
          <li class="nav-header">

            <div class="dropdown profile-element"> 
              <span>
                <img alt="image" class="img-circle" src="<?php echo base_url();?>assets/img/profile_small.jpg" width="50"/>
              </span>
              <a data-toggle="dropdown" class="dropdown-toggle" >
                <span class="clear"> 
                  <?php 
                  $session_data = $this->session->userdata('logged_in');
                  ?>
                  <span class="block m-t-xs"> 
                    <strong class="font-bold"><?= $session_data['user_name'];?></strong>
                  </span> 
                </span> 
              </a>
            </div>
            <div class="logo-element">
              IN+
            </div>
          </li>
          <?php
          $this->load->view('template/menu_template'); 
          ?>
        </ul>
      </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
      <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
          </div>
          <ul class="nav navbar-top-links navbar-right">              
            <li>
              <a href="<?php echo base_url();?>logout/">
                <i class="fa fa-sign-out"></i> Log out
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <!-- title -->
      <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
          <h2><?= $page_title; ?></h2>
          <ol class="breadcrumb">
            <li>
              <a href="<?php echo base_url().$page_url;?>/"><?= $main_breadcrumb; ?></a>
            </li>

            <li class="active">
              <strong><?= $sub_breadcrumb; ?></strong>
            </li>
          </ol>
        </div>
        <div class="col-lg-2">

        </div>
      </div>
      <!-- content -->
      <?= $page_content ?>

      <!-- Mainly scripts -->
      <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url();?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
      <script src="<?php echo base_url();?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

      <!-- Custom and plugin javascript -->
      <script src="<?php echo base_url();?>assets/js/inspinia.js"></script>
      <script src="<?php echo base_url();?>assets/js/plugins/pace/pace.min.js"></script>

      <!-- jQuery UI custom -->
      <script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>

      <!-- Input Mask-->
      <script src="<?php echo base_url();?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>

      <!-- Data picker -->
      <script src="<?php echo base_url();?>assets/js/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>

      <script src="<?php echo base_url();?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

      
      <!-- Select2 -->
      <script src="<?php echo base_url();?>assets/js/plugins/select2/select2.full.min.js"></script>

      <!-- dataTables -->
      <script src="<?php echo base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>

      <!-- iCheck -->
      <script src="<?php echo base_url();?>assets/js/plugins/iCheck/icheck.min.js"></script>

      <!-- Image cropper -->
      <script src="<?php echo base_url();?>assets/js/plugins/cropper/cropper.min.js"></script>

      <!-- slick carousel-->
      <script src="<?php echo base_url();?>assets/js/plugins/slick/slick.min.js"></script>

      <script>

        $(document).ready(function() {

          $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
          });
          
          
          // seo url
          function seo_url(){
            $( "#seo_txt" ).keyup( function () {
              input_data = $( "#seo_txt" ).val();
              var post_data = {
                  'url_str': input_data,'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
              };

              $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>seo_url",
                data: post_data,
                success: function (data) {
                    if (data.length >= 0) {
                      $( "#seo_url" ).val(data);
                    }
                  }
                });
              });

              $( '#seo_url' ).keypress( function ( e ) {
                var regex = new RegExp( "^[a-z0-9-]+$" );
                var str = String.fromCharCode( !e.charCode ? e.which : e.charCode );
                if ( regex.test( str ) ) {
                  return true;
                }

                e.preventDefault();
                  return false;
                });
              }

              seo_url();
            });

          </script>
        </body>

        </html>


