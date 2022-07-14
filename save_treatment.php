<?php
    include 'db.php';
    include 'config.php';

    session_start();

    if(!isset($_SESSION["user_id"])) {
        header('Location: ' . URL . 'login.php');
    }
?>

<?php 

	//get data from querystring and escape variables for security
    $planId  = mysqli_real_escape_string($connection, $_GET['planId']);
	$treatTitle = mysqli_real_escape_string($connection, $_GET['treatTitle']);
	$treatInfo  = mysqli_real_escape_string($connection, $_GET['treatInfo']);
    $treatTime = mysqli_real_escape_string($connection, $_GET['treatTime']);
    $ex1 = mysqli_real_escape_string($connection, $_GET['ex1']);
    $ex2 = mysqli_real_escape_string($connection, $_GET['ex2']);
    $ex3 = mysqli_real_escape_string($connection, $_GET['ex3']);
    $treatStatus = 'new';

    
	$state  = $_GET['state'];
	$userId = $_GET['userId'];
    $planId = $_GET['planId'];
    $treatmentId = $_GET['treatmentId'];

	//SET: insert/update data in DB

	if ($state == "insert") {
		$query = "insert into tbl_rehab_treatments_221(plan_id,title,info,time,treatment_status) values ('$planId','$treatTitle','$treatInfo',,'$treatTime','$treatStatus', '$ex1' , '$ex2' , '$ex3')";
		// echo $query;
	}

	else {
		$query = "update tbl_rehab_treatments_221 set plan_id='$planId', title='$treatTitle', info='$treatInfo', time='$treatTime', treatment_status='$treatStatus', ex1='$ex1', ex2='$ex2', ex3='$ex3' where treatment_id='$treatmentId'";
		// echo $query;
	}

	$result = mysqli_query($connection, $query);

    if(!$result) {
        die("DB query failed.");
    }
    header('Location: ' . URL . 'patient_plan.php?userId='. $userId .'');
?>
<?php 
    //release returned data
    mysqli_free_result($result);
?>


<?php
//close DB connection
mysqli_close($connection);
?>