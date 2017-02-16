<?php
session_start();
$_SESSION['old_page'] = 'new-post.php';
include('requires/header.php');
//If code below is executing then user can see page, i.e. successful login.
//Make sure to clear the redirect var.
$_SESSION['old_page'] = ''; 
?>

 <script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

 <textarea>Easy! You should check out MoxieManager!</textarea>

<?php
include('requires/footer.php');
?>