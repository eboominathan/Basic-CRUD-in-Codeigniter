<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet"> 
        <style type="text/css">
            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }
            #body{
                margin: 0 15px 0 15px;
            }
            #container{
                margin: 10px;
                border: 1px solid #D0D0D0;
                -webkit-box-shadow: 0 0 8px #D0D0D0;
            }
            .error {
                color: #E13300;
            }
            .info {
                color: gold;
            }
            .success {
                color: darkgreen;
            }
        </style>
        <script src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
    </head>
    <body>
        <div class="message_box">
            <?php
            if (isset($success) && strlen($success)) {
                echo '<div class="success">';
                echo '<p>' . $success . '</p>';
                echo '</div>';
            }

            if (isset($errors) && strlen($errors)) {
                echo '<div class="error">';
                echo '<p>' . $errors . '</p>';
                echo '</div>';
            }

            if (validation_errors()) {
                echo validation_errors('<div class="error">', '</div>');
            }
            ?>
        </div>
        <div>
            <?php
            echo form_open_multipart($this->uri->uri_string(), array('id' => 'upload-file-form'));
            ?>
            <fieldset>
                <legend>Upload Multiple File(s)</legend>
                <section>
                    <label>Browse a file</label>
                    <label>
                        <input type="file" name="upload_file1" class="btn btn-default" id="upload_file1" readonly="true"/>
                    </label>
                    <div id="moreImageUpload"></div>
                    <div style="clear:both;"></div>
                    <div id="moreImageUploadLink" style="display:none;margin-left: 10px;">
                        <a href="javascript:void(0);" class="btn btn-success"id="attachMore">Attach another file</a>
                    </div>
                </section>
            </fieldset>
            <footer>
                <input type="submit" name="file_upload" class="btn btn-primary" value="Upload"/>
            </footer>
           <form>
        </div>        
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function() {

        $("input[id^='upload_file']").each(function() {

            var id = parseInt(this.id.replace("upload_file", ""));
            
            $("#upload_file" + id).change(function() {
                if ($("#upload_file" + id).val() !== "") {
                    $("#moreImageUploadLink").show();
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var upload_number = 2;
        $('#attachMore').click(function() {
            //add more file
            var moreUploadTag = '';
            moreUploadTag += '<div class="element"><label for="upload_file"' + upload_number + '>Upload File ' + upload_number + '</label>';
            moreUploadTag += '<input type="file" id="upload_file' + upload_number + '" name="upload_file' + upload_number + '"/>';
            moreUploadTag += '&nbsp;<a href="javascript:del_file(' + upload_number + ')" style="cursor:pointer;" onclick="return confirm(\"Are you really want to delete ?\")">Delete ' + upload_number + '</a></div>';
            $('<dl id="delete_file' + upload_number + '">' + moreUploadTag + '</dl>').fadeIn('slow').appendTo('#moreImageUpload');
            upload_number++;
        });
    });
</script>
<script type="text/javascript">
    function del_file(eleId) {
        var ele = document.getElementById("delete_file" + eleId);
        ele.parentNode.removeChild(ele);
    }
</script>