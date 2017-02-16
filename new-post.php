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
  selector: "textarea",  // change this value according to your HTML
  toolbar: "image",
  plugins: "image imagetools",
  imagetools_cors_hosts: ['mydomain.com', 'otherdomain.com']
});</script>

 <textarea>Ayy lmao</textarea>

<?php
include('requires/footer.php');
?>