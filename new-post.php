<?php
session_start();
$_SESSION['old_page'] = 'new-post.php';
include('requires/header.php');
//If code below is executing then user can see page, i.e. successful login.
//Make sure to clear the redirect var.
$_SESSION['old_page'] = ''; 
?>

<!-- Include Editor style. -->
<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.4.2/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.4.2/css/froala_style.min.css' rel='stylesheet' type='text/css' />

<!-- Include JS file. -->
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.4.2/js/froala_editor.min.js'></script>

<div id="froala-editor">
  <p>Click the Code View button to see the editor content's HTML.</p>
  <img src="/assets/editor/docs/photo14.jpg" class="fr-fil" alt="book" width="150"/>
</div>

<script>
  $(function() {
    $('div#froala-editor').froalaEditor();
  });
</script>

<?php
include('requires/footer.php');
?>