<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if(!isset($_SESSION["user_id"])) { header('Location: ' . URL . 'err.php'); }

    //DELETE treatment from DB
    $query  = "DELETE FROM tbl_rehab_treatments WHERE treatment_id= '$treatment_id'";
    $result = mysqli_query($connection, $query);
    if(!$result) { 
        die("DB query failed.");
        header('Location: ' . URL . 'err.php');
    }
    header('Location: ' . URL . 'patient_plan.php');
?>

<?php
    //close DB connection
    mysqli_close($connection);
?>
