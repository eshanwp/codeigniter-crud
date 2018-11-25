<?php
include('class.fileuploader.php');
if (isset($gallery_data->gallery_titel)) {
    $filePath = 'uploads/gallery/'.$gallery_data->gallery_titel.'/';
    $appendedFiles = array();
    $uploadsFiles = array_diff(scandir($filePath), array('.', '..'));
    $input = preg_quote($gallery_data->gallery_titel, '~');
    $uploadsFiles = preg_grep('~' . $input . '~', $uploadsFiles);
    foreach($uploadsFiles as $file) {
      if(is_dir($file))
        continue;

    $appendedFiles[] = array(
        "name" => $file,
        "type" => FileUploader::mime_content_type($filePath. $file),
        "size" => filesize($filePath. $file),
        "file" => base_url().$filePath . $file,
        "data" => array(
          "url" => base_url().$filePath. $file
      )
    );
}
$appendedFiles = json_encode($appendedFiles);
}

?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form method="post" class="form-horizontal" action="<?php echo base_url();?>gallery/update/" id="gallery">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Gallery Name <span style="color: red;">*</span></label>

                                <label id="gallery_name-error" class="text-danger" for="gallery_name"></label>
                                <label id="gallery_titel-error" class="text-danger" for="gallery_titel"></label>

                                <input type="text" class="form-control" name="gallery_name" id="seo_txt" placeholder="Gallery Name" value="<?= isset($gallery_data->gallery_name) ? $gallery_data->gallery_name: ''; ?>">
                                <input type="hidden" class="form-control" name="gallery_titel" id="seo_url" value="<?= isset($gallery_data->gallery_titel) ? $gallery_data->gallery_titel: ''; ?>">
                                <input type="hidden" class="form-control" name="gallery_id"  value="<?= isset($gallery_data->gallery_id) ? $gallery_data->gallery_id: ''; ?>">

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Upload File(s) <span style="color: red;">*</span></label>

                                <label id="img_upload-error" class="text-danger" for="img_upload"></label><br>

                                <input type="file" class="form-control" name="img_upload[]" multiple accept=".jpg,.png" data-fileuploader-files='<?= isset($appendedFiles) ? $appendedFiles: ''; ?>' id="img_upload">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit" id="submit"  onclick="gallery()">Save</button>
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
    function gallery(){
        $(document).on('submit', '#gallery', function(e) {
            e.preventDefault();
            var form = $('#gallery')[0];
            var formData = new FormData(form);
            $('#submit').prop('disabled', true);
            $.ajax({
                url:  $("#gallery").attr("action"),
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
                        $('#submit').prop('disabled', false);
                        var i = i.replace('[]', '');//for checkbox
                        $('#'+i+'-error').html(m);
                        $('#'+i+'-error').parent().addClass('has-error');

                    });


                    }else{
                        $('#messages').html('<div class="alert alert-success"><b>'+response.message+'<b></div>').fadeIn();

                        setTimeout(function() { 
                            $('#messages').fadeOut(); 
                            location.reload();
                        }, 3000);
                        $("#gallery")[0].reset();

                        
                    }

                }
            });
        });
    }
    $(document).ready(function(){
        var base_url = "<?php echo base_url();?>";
        var file_url,new_file_url;
        $('#img_upload').fileuploader({

            extensions: ['jpg', 'png'],
            changeInput: ' ',
            theme: 'thumbnails',
            enableApi: true,
            addMore: true,
            
            thumbnails: {
                box: '<div class="fileuploader-items">' +
                '<ul class="fileuploader-items-list">' +
                '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner">+</div></li>' +
                '</ul>' +
                '</div>',
                item: '<li class="fileuploader-item">' +
                '<div class="fileuploader-item-inner">' +
                '<div class="thumbnail-holder">${image}</div>' +
                '<div class="actions-holder">' +
                '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="remove"></i></a>' +
                '<span class="fileuploader-action-popup"></span>' +
                '</div>' +
                '<div class="progress-holder">${progressBar}</div>' +
                '</div>' +
                '</li>',
                item2: '<li class="fileuploader-item">' +
                '<div class="fileuploader-item-inner">' +
                '<div class="thumbnail-holder">${image}</div>' +
                '<div class="actions-holder">' +
                '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="remove"></i></a>' +
                '<span class="fileuploader-action-popup"></span>' +
                '</div>' +
                '</div>' +
                '</li>',
                startImageRenderer: true,
                canvasImage: false,
                _selectors: {
                    list: '.fileuploader-items-list',
                    item: '.fileuploader-item',
                    start: '.fileuploader-action-start',
                    retry: '.fileuploader-action-retry',
                    remove: '.fileuploader-action-remove'
                },
                onItemShow: function(item, listEl) {
                    var plusInput = listEl.find('.fileuploader-thumbnails-input');

                    plusInput.insertAfter(item.html);

                    if (item.format == 'image') {
                        item.html.find('.fileuploader-item-icon').hide();
                    }
                }
            },
            afterRender: function(listEl, parentEl, newInputEl, inputEl) {
                var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                api = $.fileuploader.getInstance(inputEl.get(0));

                plusInput.on('click', function() {
                    api.open();
                });
            },

            onRemove: function(item) {
                file_url = item.file;
                file_name = item.name;
                new_file_url = file_url.replace(base_url, '');
                $.ajax({
                    url: "<?php echo base_url(); ?>/gallery/remove_img",
                    type: 'post',
                    cache: false,
                    data: {file_to_remove:new_file_url,file_name:file_name},
                    success: function() {
                        $('#messages').html('<div class="alert alert-danger"><b>Image Successfully Deleted.<b></div>').fadeIn();

                        setTimeout(function() { 
                            $('#messages').fadeOut(); 
                            location.reload();
                        }, 3000);

                    }
                });
            },
            captions: {
                errors: {
                  filesType: 'Only ${extensions} files are allowed',

              }
          }
      });
    }); 
</script>