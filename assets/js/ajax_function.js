var base_url = 'http://localhost:1234/my_test/admin/';
function login(){
      var form = $('#login')[0];
      var formData = new FormData(form);

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
            window.location.href = base_url+'test/';
            
          }

        }

      });
    }