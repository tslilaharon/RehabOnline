<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if(!isset($_SESSION["user_id"])) { header('Location: ' . URL . 'err.php'); }

    //EDIT treatment in DB
    $query  = "UPDATE tbl_rehab_treatments SET title= '$title', info= '$info', timee= '$time' WHERE treatment_id= '$treatment_id'";
    $result = mysqli_query($connection, $query);
    if(!$result) { 
        die("DB query failed.");
        header('Location: ' . URL . 'err.php');
    }
    header('Location: ' . URL . 'patient_plan.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RehabOnline - Edit</title>

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
    <link rel="icon" href="images/logo.png">

    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body id="layout">
    <!-- header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <section class="container-fluid">
                <!-- logo -->
                <a class="navbar-brand" href="index.html">
                    <span>RehabOnline</span>
                </a>

                <!-- Toggle navbar-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">My Patients</a>
                        </li>
                        <!-- Therapist -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="images/therapist.png" class="rounded-circle" alt="therapist"
                                    title="therapist" />
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">Settings</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </section>
        </nav>
    </header>

    <!-- main -->
    <main id="list-wrapper">
        <section class="container container-fluid">

            <!-- breadcrumb -->
            <section class="breadcrumb-container" style="--bs-breadcrumb-divider: '\203A';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Eli Alice</a></li>
                    <li class="breadcrumb-item"><a href="list.html">Treatments Plans</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Treatment Plan</li>
                </ol>
            </section>

            <!-- title -->
            <section class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Edit Treatment Plan</h1>
            </section>

            <!-- form section -->
            <section class="container margin form">
                <section class="container">
                    <form id="formT" action="get_form.php" method="GET">
                        <!-- Treatment name input -->
                        <article class="form-outline mb-4">
                            <label class="form-label" for="form6Example3">Treatment name</label>
                            <input type="text" name="name" id="form6Example3" class="form-control" required />
                            <?php
                            echo "<input type='text' name='name' id='form6Example3' class='form-control' value='$title' required />";

                            ?>
                        </article>

                        <!-- Description input -->
                        <article class="form-outline mb-4">
                            <label class="form-label" for="form6Example7">Description</label>
                            <textarea class="form-control" name="descr" id="form6Example7" rows="4" required></textarea>
                            <?php
                                echo "<textarea class='form-control' name='descr' id='form6Example7' rows='4' required>$info</textarea>";
                            ?>
                        </article>

                        <!--Time and Exercises -->
                        <section class="row mb-4">

                            <!-- Time -->
                            <article class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="form6Example6">Time</label>
                                    <!-- <input type="number" name="time" id="form6Example6" class="form-control" required /> -->
                                    <?php 
                                        $time = $_GET['time'];
                                        echo "<input type='number' name='time' id='form6Example6' class='form-control' value='$time' required />";
                                    ?>
                                </div>
                            </article>

                            <!-- exercises -->
                            <!-- <article class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="ex-number">Number of exercises</label>
                                    <input type="number" name="ex_num" id="ex-number" class="form-control" min="2"
                                        max="10" value="2" required />
                                </div>
                            </article> -->

                        </section>

                        <!-- select Excercise -->
                        <!-- <section class="row mb-4 row-cols-lg-auto g-3 align-items-center" id="dropboxes">
                            <article class="col">
                                <div class="form-outline">
                                    <label class="visually-hidden" for="inlineFormSelectPref1">Excercise</label>
                                    <select id="inlineFormSelectPref1" class="select" name="select1">
                                        <option value="1">Reverse Lunges</option>
                                        <option value="2">Skater Jumps</option>
                                        <option value="3">Jumping Jacks</option>
                                        <option value="4">One Legged Stand</option>
                                        <option value="5">Push Ups</option>
                                        <option value="6">Squats</option>
                                        <option value="7">Situps</option>
                                        <option value="8">Pull Ups</option>
                                    </select>
                                </div>
                            </article>

                            <article class="col">
                                <div class="form-outline">
                                    <label class="visually-hidden" for="inlineFormSelectPref2">Excercise</label>
                                    <select id="inlineFormSelectPref2" class="select" name="select2">
                                        <option value="1">Reverse Lunges</option>
                                        <option value="2">Skater Jumps</option>
                                        <option value="3">Jumping Jacks</option>
                                        <option value="4">One Legged Stand</option>
                                        <option value="5">Push Ups</option>
                                        <option value="6">Squats</option>
                                        <option value="7">Situps</option>
                                        <option value="8">Pull Ups</option>
                                    </select>
                                </div>
                            </article>
                        </section> -->

                        <!-- btn input  -->
                        <input class="btn btn-outline-primary btn-block mb-4" type="submit" name="send" value="Edit Plan"
                            id="send">

                    </form>
                </section>
            </section>

        </section>
    </main>

    <!-- footer -->
    <footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-muted">&copy; 2022 RehabOnline</p>
        <a href="#"
            class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <img src="images/logo.png" class="rounded-circle" alt="logo" />
        </a>

        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
        </ul>
    </footer>

    <script src="js/form.js"></script>
</body>

</html>




<?php
    //close DB connection
    mysqli_close($connection);
?>
