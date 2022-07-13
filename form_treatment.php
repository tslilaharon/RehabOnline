<?php
    include 'db.php';
    include 'config.php';

    session_start();

    if(!isset($_SESSION["user_id"])) {
        header('Location: ' . URL . 'login.php');
    }
?>

<?php 
	//get data from DB

	$useId = $_GET["useId"];
    $query 	= "SELECT * FROM tbl_rehab_treatments_221 WHERE user_id=" . $useId;
	$result = mysqli_query($connection, $query);
	$state  = "insert";

	if($result) {
		$row 	= mysqli_fetch_assoc($result);//there is only 1 with id=X
		$state 	= "edit";
	}

	// else die("DB query failed.");//i dont want it to fail. i want it to cont.
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RehabOnline - Form Treatment</title>

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
			<form action="saveProd.php">
				<div class="mb-3">
					<label for="prodName1" class="form-label">Treatment name</label>
					<input type="text" class="form-control" id="prodName1" name="prodName" value="<?php echo $row["title"];?>">
				</div>

				<div class="mb-3">
					<label for="prodImg1" class="form-label">Treatment image</label>
					<input type="text" class="form-control" id="prodImg1" name="prodImg" value="<?php echo $row["number_of_exs"];?>">
				</div>

				<div class="mb-3">
					<label for="cat" class="form-label">EX name</label>

					<select class="form-select" id="cat" name="catId" data-selected="<?php echo $row["cat_id"];?>">

						<option value="1">Shirts for men</option>
						<option value="2">Shirts for women</option>
						<option value="3">Shirts for children</option>

					</select>

				</div>

				<input type="hidden" name="state" value="<?php echo $state;?>">
				<input type="hidden" name="prodId" value="<?php echo $prodId;?>">

				<button type="submit" class="btn btn-primary">Save</button>
			</form>

			<?php 
			//release returned data
			if($result) mysqli_free_result($result);
            ?>

	    </div>

	</body>

</html>
<?php
    //close DB connection
    mysqli_close($connection);
?>
