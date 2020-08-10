<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
</head>

<body>
<div>
<h2>Upload</h2>
<input type="text" id="vdo_file" value="sample_vdo/file_example_MP4_1920_18MG.mp4" /><br/>
<input type="text" id="vdo_title" value="Test Upload VDO via API" /><br/>
<input type="text" id="vdo_description" value="Using PHP from Vimeo API Official" /><br/>
<input type="button" id="upload" value="Upload VDO" />
<div><span id="upload_result"></span></div>
</div>
<div>
<h2>GET Status VDO <span class="vdo_id_display"></span></h2>
<input type="button" id="get_status" value="Get Status" />
<input type="hidden" class="vdo_id" value="" />
<div><span id="upload_status"></span></div>
</div>
<div id="download_enable">
<h2>Download VDO of <span class="vdo_id_display"></span></h2>
<input type="button" id="download" value="Download " />
<div><span id="file_url"></span></div>
</div>
<script>
$( document ).ready(function() {
    $("#download_enable").hide();
    $("#upload").click(function() {
        $.ajax('/upload_vimeo.php?upload=yes', {
            type: 'POST',  // http method
            data: { vdo_file: $("#vdo_file").val(), vdo_title: $("#vdo_title").val(), vdo_description: $("#vdo_description").val()},  // data to submit
            success: function (response) {
                $("#upload_result").html('VDO ID: ' + response);
                $(".vdo_id").val(response);
                $(".vdo_id_display").html(response);
            },
            error: function (jqXhr, textStatus, errorMessage) {
                $("#upload_result").html('Error: ' + errorMessage);
            }
        });
    });

    $("#get_status").click(function() {
        $.ajax('/upload_vimeo.php?status=yes', {
            type: 'POST',  // http method
            data: { vdo_id: $(".vdo_id").val()},  // data to submit
            success: function (response) {
                $("#upload_status").html('Upload Status: ' + response);
                if(response == "complete") {
                    $("#download_enable").show();
                }
            },
            error: function (jqXhr, textStatus, errorMessage) {
                $("#upload_status").html('Error: ' + errorMessage);
            }
        });
    });

    $("#download").click(function() {
        $.ajax('/upload_vimeo.php?download=yes', {
            type: 'POST',  // http method
            data: { vdo_id: $(".vdo_id").val()},  // data to submit
            success: function (response) {
                $("#file_url").html('File URL:<br/> ' + response);
            },
            error: function (jqXhr, textStatus, errorMessage) {
                $("#file_url").html('Error: ' + errorMessage);
            }
        });
    });
});
</script>
 
</body>

</html>