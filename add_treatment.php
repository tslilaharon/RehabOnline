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
    $planId = $_GET["planId"];

	$state  = "insert";

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
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaN v cOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" 
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
                    <h1>Add Treatment</h1>
                    <form action="save_treatment.php" method="get">

                            <div class="mb-3">
                                <label for="treatTitle" class="form-label">Treatment Title</label>
                                <input type="text" class="form-control" id="treatTitle" name="treatTitle">
                            </div>

                            <div class="mb-3">
                                <label for="treatInfo" class="form-label">Treatment Information</label>
                                <input type="text" class="form-control" id="treatInfo" name="treatInfo">
                            </div>
                            
                            <div class="mb-3">
                                <label for="treatTime" class="form-label">Treatment Time</label>
                                <input type="text" class="form-control" id="treatTime" name="treatTime">
                            </div>

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

                            <input type="hidden" name="state" value="<?php echo $state;?>">
                            <input type="hidden" name="userId" value="<?php echo $userId;?>">
                            <input type="hidden" name="planId" value="<?php echo $row["plan_id"];?>">


                            <button type="submit" class="btn btn-outline-primary btn-block mb-4 mb-3">Save</button>
                        </form>
                    </section>
                </section>
        </main>
        <script src="includes/js/fetchExe.js"></script>

	</body>

</html>
<?php
    //close DB connection
    mysqli_close($connection);
?>
