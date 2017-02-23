<?php
session_start();
$_SESSION['old_page'] = 'edit-post.php';
include('requires/header.php');
//If code below is executing then user can see page, i.e. successful login.
//Make sure to clear the redirect var.
$_SESSION['old_page'] = ''; 
$_SESSION['username'] = $LS->getUser("username"); 
//echo __DIR__."/images/".$LS->getUser("username")."/";
?>

 <script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=usxf6kylya7uvf4cv4b5757vp65gi864icjj7guf9ojn43mi"></script>
  <script>tinymce.init({
  selector: 'textarea',
  height: 300,
  plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  imagetools_cors_hosts: ['localhost', '192.168.199.151', 'http://alex.xfocus.ca/'],
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ],
  // enable title field in the Image dialog
  image_title: true, 
  // enable automatic uploads of images represented by blob or data URIs
  automatic_uploads: true,
  // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
  images_upload_url: 'post-acceptor.php',
  // here we add custom filepicker only to Image dialog
  file_picker_types: 'image', 
  // and here's our custom image picker
  file_picker_callback: function(cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    
    // Note: In modern browsers input[type="file"] is functional without 
    // even adding it to the DOM, but that might not be the case in some older
    // or quirky browsers like IE, so you might want to add it to the DOM
    // just in case, and visually hide it. And do not forget do remove it
    // once you do not need it anymore.

    input.onchange = function() {
      var file = this.files[0];
      
      // Note: Now we need to register the blob in TinyMCEs image blob
      // registry. In the next release this part hopefully won't be
      // necessary, as we are looking to handle it internally.
      var id = 'blobid' + (new Date()).getTime();
      var blobCache = tinymce.activeEditor.editorUpload.blobCache;
      var blobInfo = blobCache.create(id, file);
      blobCache.add(blobInfo);
      
      // call the callback and populate the Title field with the file name
      cb(blobInfo.blobUri(), { title: file.name });
    };
    
    input.click();
  }
});</script>
<?php
        include ('requires/database-preamble.php');
        $res = pg_query_params($db, 'SELECT body FROM posts where id = $1', [$_GET["id"]]);
        $line = pg_fetch_row($res)
?>
 <textarea><?php echo $line[0]  ?></textarea>
<form id="submitform" method="POST" action="submit-post.php">
<input id="hiddenId" type="hidden" name="post-html">
<input id="buttonA" type="button" class="btn-lg btn-block btn-success" value="Submit" onclick="handleclick(event);"/>
</form>
<script>function handleclick(event) {
   document.getElementById('hiddenId').value = tinyMCE.activeEditor.getContent();
   document.getElementById('submitform').submit();
}</script>
<?php
include('requires/footer.php');
?>