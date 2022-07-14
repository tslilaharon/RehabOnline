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
	$userId = $_GET["userId"];

    $query = "SELECT * FROM tbl_rehab_users_221 WHERE user_id = $userId";

	$result = mysqli_query($connection, $query);
	if($result) {
		$row 	= mysqli_fetch_assoc($result);//there is only 1 with id=X
	}
    else{
        header('Location: ' . URL . 'patient_plan.php?userId='. $userId .'');
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RehabOnline - Edit Patient</title>

        <!-- cdn bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>

        <!-- cdn font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500&display=swap" rel="stylesheet">
       
        <!-- jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" 
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       
        <!-- icon -->
        <link rel="icon" href="includes/images/logo-c.png">

        <!-- css -->
        <link rel="stylesheet" href="includes/css/style.css">
    </head>

	<body>
        <main id="list-wrapper">
            <!-- form section -->
            <section class="container margin form">
                <section class="container">
                        <h1>Edit Patient Details</h1>
                    <form action="save_patient.php">

                            <div class="mb-3">
                                <label for="full_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $row["full_name"];?>">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row["phone"];?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                
                                <div id="dataServices" class="mb-3">

                                </div\>
                                <!-- <input type="text" class="form-control" id="address" name="address" value="<?php echo $row["address"];?>"> -->
                            </div>

                            <input type="hidden" name="userId" value="<?php echo $userId;?>">

                            <button type="submit" class="btn btn-outline-primary btn-block mb-4">Save</button>
                        </form>
                    </section>
                </section>
            </main>


			<?php 
			//release returned data
			if($result) mysqli_free_result($result);
            ?>

	    </div>
        <script src="includes/js/getjson.js"></script>
	</body>

</html>
<?php
    //close DB connection
    mysqli_close($connection);
?>
