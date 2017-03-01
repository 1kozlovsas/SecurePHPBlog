<?php
if(!empty($_POST['token'])) {

    if (hash_equals($_SESSION['token'], $_POST['token'])) {

	unset($_SESSION['token']);         

    } else {

	//if invalid token is provided.

        die("CSRF DETECTED CSRF DETECTED");
    }

}
else{
	//May be a user refreshing, notify admin.
	error_log("NOTICE: POSSIBLE CSRF ATTEMPT WITH ".$username."'s ACCOUNT-POST VARIABLE TOKEN IS EMPTY. OCCURRED AT ".$_SESSION['old_page']);
}
//generating new nonce and binding to session var
$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));

$token = $_SESSION['token'];
?>