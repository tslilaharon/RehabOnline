<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if(!isset($_SESSION["user_id"])) { header('Location: ' . URL . 'err.php'); }

    //DELETE treatment from DB
    $treatmentId = $_GET['treatmentId'];
    $query  = "DELETE FROM tbl_rehab_treatments_221 WHERE treatment_id= '$treatmentId'";
    $result = mysqli_query($connection, $query);
    if(!$result) { 
        die("DB query failed.");
        header('Location: ' . URL . 'err.php');
    }
    header('Location: ' . URL . 'patient_plan.php?userId='. $_GET["userId"]);
?>

<?php
    //close DB connection
    mysqli_close($connection);
?>
