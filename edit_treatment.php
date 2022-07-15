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
    $treatmentId = $_GET['treatmentId'];
    $treatStatus = 'new';

    $query = "SELECT * FROM tbl_rehab_treatments_221 WHERE treatment_id=$treatmentId";

	$result = mysqli_query($connection, $query);
	if($result) {
		$row 	= mysqli_fetch_assoc($result);//there is only 1 with id=X
		$state 	= "edit";
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
                        <h1>Save Treatment</h1>
                    <form action="save_treatment.php" method="get">

                            <div class="mb-3">
                                <label for="treatTitle" class="form-label">Treatment Title</label>
                                <input type="text" class="form-control" id="treatTitle" name="treatTitle" value="<?php echo $row['title'];?>">
                            </div>

                            <div class="mb-3">
                                <label for="treatInfo" class="form-label">Treatment Information</label>
                                <input type="text" class="form-control" id="treatInfo" name="treatInfo" value="<?php echo $row['info'];?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="treatTime" class="form-label">Treatment Time</label>
                                <input type="text" class="form-control" id="treatTime" name="treatTime" value="<?php echo $row['time'];?>">
                            </div>

                            <div class="mb-3">
                                <label for="treatNumber_of_exs" class="form-label">The number of exercises</label>
                                <input type="text" class="form-control" id="treatNumber_of_exs" name="treatNumber_of_exs" value="<?php echo $row["number_of_exs"];?>">
                            </div>

                            <!-- <div class="mb-3">
                                <label for="ex1" class="form-label">Ex1</label>
                                <input type="text" class="form-control" id="ex1" name="ex1" value="<?php echo $row["ex1"];?>">
                            </div>

                            <div class="mb-3">
                                <label for="ex2" class="form-label">Ex2</label>
                                <input type="text" class="form-control" id="ex2" name="ex2" value="<?php echo $row["ex2"];?>">
                            </div>

                            <div class="mb-3">
                                <label for="ex3" class="form-label">Ex3</label>
                                <input type="text" class="form-control" id="ex3" name="ex3" value="<?php echo $row["ex3"];?>">
                            </div> -->

                            <!-- <section class="row mb-4 row-cols-lg-auto g-3 align-items-center" id="dropboxes">
                            <article class="col">
                                <div class="form-outline">
                                    <label class="visually-hidden" for="ex1">Excercise 1</label>
                                    <select id="ex1" class="select" name="ex1">
                                        <option value="Reverse Lunges">Reverse Lunges</option>
                                        <option value="Skater Jumps">Skater Jumps</option>
                                        <option value="Jumping Jacks">Jumping Jacks</option>
                                        <option value="One Legged Stand">One Legged Stand</option>
                                        <option value="Push Ups">Push Ups</option>
                                        <option value="Squats">Squats</option>
                                        <option value="Situps">Situps</option>
                                        <option value="Pull Ups">Pull Ups</option>
                                    </select>
                                </div>
                            </article> -->

                            <section class="row mb-4 row-cols-lg-auto g-3 align-items-center" id="dropboxes">
                            <article class="col">
                                <div class="form-outline">
                                    <label class="visually-hidden" for="ex1">Excercise 1</label>
                                    <select id="ex1" class="select" name="ex1">
                                        
                                    </select>
                                </div>
                            </article>

                            <article class="col">
                                <div class="form-outline">
                                    <label class="visually-hidden" for="ex2">Excercise 2</label>
                                    <select id="ex2" class="select" name="ex2">
                                        
                                    </select>
                                </div>
                            </article>

                            <article class="col">
                                <div class="form-outline">
                                    <label class="visually-hidden" for="ex3">Excercise 3</label>
                                    <select id="ex3" class="select" name="ex3">
                                        
                                    </select>
                                </div>

                            </article>
                            </section>
                            <!-- 
                            <div class="mb-3">
                                <label for="exercises" class="form-label">Select exercises</label>
                                <select id="exercises" name="ExId"></select>
                            </div>
                            <div class="mb-3">
                                <label for="exercises" class="form-label">Select exercises</label>
                                <select id="exercises" name="ExId" onchange="getExercise(this.value)" disabled>
                                    <option value="">Select exercise</option>
                                </select>
                            </div> -->

                            <input type="hidden" name="state" value="<?php echo $state;?>">
                            <input type="hidden" name="userId" value="<?php echo $userId;?>">
                            <input type="hidden" name="planId" value="<?php echo $row["plan_id"];?>">
                            <input type="hidden" name="treatmentId" value="<?php echo $row["treatment_id"];?>">


                            <button type="submit" class="btn btn-outline-primary btn-block mb-4 mb-3">Save</button>
                        </form>
                    </section>
                </section>
            </main>


			<?php 
			//release returned data
			if($result) mysqli_free_result($result);
            ?>

	    </div>
        <script src="includes/js/fetchExe.js"></script>
	</body>

</html>
<?php
    //close DB connection
    mysqli_close($connection);
?>
