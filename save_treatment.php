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
	$prodName = mysqli_real_escape_string($connection, $_GET['prodName']);
	$prodImg  = mysqli_real_escape_string($connection, $_GET['prodImg']);
	$catId  = mysqli_real_escape_string($connection, $_GET['catId']);
	$state  = $_GET['state'];
	$prodId = $_GET['prodId'];

	//SET: insert/update data in DB

	if ($state == "insert") {
		$query = "insert into tbl_prods(name,img_url,cat_id) values ('$prodName','$prodImg','$catId')"
		// echo $query;
	}

	else {
		$query = "update tbl_prods set name='$prodName', img_url='$prodImg', cat_id='$catId' where id='$prodId'";
		// echo $query;
	}

	$result = mysqli_query($connection, $query);

    if(!$result) {
        die("DB query failed.");
    }

?>

<!DOCTYPE html>

<html>
	<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RehabOnline - Save Treatment</title>

        <!-- cdn bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>

        <!-- cdn Chart.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- cdn font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500&display=swap" rel="stylesheet">

        <!-- icon -->
        <link rel="icon" href="includes/images/logo-c.png">

        <!-- css -->
        <link rel="stylesheet" href="includes/css/style.css">
    </head>

	<body>

	    <div class="container">

			<h1>Save Treatment Details</h1>

			<h2>Treatment was saved</h2>
            <?php 

            echo '<a href="patient_plan.php?useId='. $row["user_id"] .'" class="btn btn-outline-primary"> click to see all Treatments</a>';
			?>

			<?php 
				//release returned data
				mysqli_free_result($result);
			?>

	    </div>

	</body>
</html>

<?php
//close DB connection
mysqli_close($connection);
?>