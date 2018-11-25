<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?= $page_title; ?></title>

  <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

  <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

  <div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
      <div>

        <h1 class="logo-name" style="color: #000;">IN+</h1>

      </div>
      <?= $page_content ?>
    </div>
  </div>

  <!-- Mainly scripts -->
  <script src="<?php echo base_url();?>assets/js/jquery-2.1.1.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">

    function login(){
      $(document).on('submit', '#login', function(e) {
      e.preventDefault();
      var form = $('#login')[0];
      var formData = new FormData(form);
       $('#submit').prop('disabled', true);
      $.ajax({
        url:  $("#login").attr("action"),
        dataType : 'json',
        type : 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success : function(response) {
          $('.text-danger').html('');
          $('.form-group').removeClass('has-error');
          if(response.status == false) {
            $.each(response.message,function(i,m){
              $('.'+i).html(m);
              $('.'+i).parent().addClass('has-error');
              if (i == 'login_error') {
                $('#submit').prop('disabled', false);
                $('#messages').html('<div class="alert alert-danger">'+m+'</div>').fadeIn();
                setTimeout(function() { 
                  $('#messages').fadeOut($("#login")[0].reset()); 
                }, 3000);

              }
            });

          }else{
            $('#messages').html('<div class="alert alert-success">'+response.message+'</div>').fadeIn();

            setTimeout(function() { $('#messages').fadeOut(); }, 3000);
            $("#login")[0].reset();
            window.location.href = '<?php echo base_url();?>basic_form/';
            
          }

        }

      });
       });
    }

  </script>
</body>

</html>
