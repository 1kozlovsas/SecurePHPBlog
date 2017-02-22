<?php
session_start();
include ('requires/header.php');
?>
<?php		
$dbname = "";
$user = "";
$password = "";
$username = $_SESSION['username'];
$connect = 'host=localhost dbname='.$dbname.' user='.$user.' password='.$password; 
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
$stmt = $connect->prepare("DELETE FROM users WHERE username = ?");
$stmt2 = $connect->prepare("DELETE FROM posts WHERE username = ?");

$stmt->bind_param("s", $);
$stmt2->bind_param("s", $);

$stmt->execute();
$stmt2->execute();

?>


<?php
$stmt->close();
$stmt2->close();
$connect->close();
include ('requires/footer.php');
?>