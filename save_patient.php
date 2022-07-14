<?php
    include 'db.php';
    include 'config.php';

    session_start();

    if(!isset($_SESSION["user_id"])) {
        header('Location: ' . URL . 'login.php');
    }
?>

<?php 
	$full_name = mysqli_real_escape_string($connection, $_GET['full_name']);
	$phone  = mysqli_real_escape_string($connection, $_GET['phone']);
	$address  = mysqli_real_escape_string($connection, $_GET['address']);
    
    $query = "update tbl_rehab_users_221 set full_name='$full_name', phone='$phone', address='$address'";

	$result = mysqli_query($connection, $query);

    if(!$result) {
        die("DB query failed.");
    }
    header('Location: ' . URL . 'patient_plan.php?userId='. $_GET["userId"]);

?>
<?php 
    //release returned data
    mysqli_free_result($result);
?>

<?php
//close DB connection
mysqli_close($connection);
?>