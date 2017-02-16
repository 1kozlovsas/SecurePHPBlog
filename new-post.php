<?php
session_start();
$_SESSION['old_page'] = 'new-post.php';
include('requires/header.php');
//If code below is executing then user can see page, i.e. successful login.
//Make sure to clear the redirect var.
$_SESSION['old_page'] = ''; 
?>

 <script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=usxf6kylya7uvf4cv4b5757vp65gi864icjj7guf9ojn43mi"></script>
  <script>tinymce.init({
  selector: 'textarea',
  height: 500,
  plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  imagetools_cors_hosts: ['localhost', '192.168.199.151'],
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});</script>

 <textarea>Ayy lmao</textarea>

<?php
include('requires/footer.php');
?>