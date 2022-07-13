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
	$treatmentId = $_GET["treatmentId"];

    $query = "SELECT * FROM tbl_rehab_exercises_221 AS e
    JOIN tbl_rehab_treatments_221 AS t
    ON e.treatment_id = t.treatment_id
    JOIN tbl_rehab_treatment_plan_221 AS p
    ON t.plan_id = p.plan_id
    JOIN tbl_rehab_users_221 AS u
    ON p.user_id = u.user_id
    WHERE t.treatment_id = $treatmentId";

    $result = mysqli_query($connection, $query);
    if($result) {
        $row = mysqli_fetch_assoc($result);//there is only 1 with id=X
    }
    else {
        die("DB query failed.");
        header('Location: ' . URL . 'err.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RehabOnline - Treatment</title>

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
    
    <body id="treatment">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <!-- logo -->
                    <a class="navbar-brand" href="home.php">
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
                                <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#patientTable">My Patients</a>
                            </li>
                            <!-- Therapist -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php
                                        $img = $_SESSION["user_image"];
                                        if(!$img) $img = "includes/images/default.png";
                                        echo '<img class="rounded-circle" alt="therapist"
                                        title="therapist" src="'. $img .'">';
                                    ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="#">Settings</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        </header>

        <!-- main -->
        <main id="list-wrapper">

            <section class="container container-fluid">

                <!-- breadcrumb -->
                <section class="breadcrumb-container" style="--bs-breadcrumb-divider: '\203A';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <?php 
                        echo '<li class="breadcrumb-item"><a  href="#">'. $row["full_name"] .'</a></li>';
                        ?>
                        <?php 
                        echo '<li class="breadcrumb-item"><a  href="patient_plan.php?useId='. $row["user_id"] .'">Treatments Plan</a></li>';
                        ?>
                        <?php 
                        echo '<li class="breadcrumb-item active"><a>'. $row["title"] .'</a></li>';
                        ?>
                    </ol>
                </section>

                <!-- Description -->
                <section class="description">
                    <?php 
                        echo '<h1 class="h3 mb-0 text-gray-800">' . $row["title"] .'</h1>';
                        echo '<div>';
                        echo '  <span class="item-icon">';
                        echo '      <i class="fas fa-clock"></i>'. $row["time"] .' minutes';
                        echo '  </span>';
                        echo '  <span class="item-icon">';
                        echo '      <i class="fas fa-running"></i>'. $row["number_of_exs"] .' exercises';
                        echo '  </span>';
                        echo ' </div>';
                        echo '<p>'. $row["info"] .'</p>';
                    ?>
                </section>

                <!-- exercises plan -->
                <section class="col-md-12 border-right">
                    <div class="card shadow plan">

                        <!-- Search & cells size -->
                        <section
                            class="card-header top-bar bg-white py-3 d-flex flex-row align-items-center justify-content-between">

                            <article class="m-0 form-outline">
                                <input type="search" id="search" class="form-control" placeholder="&#xF002; Search"
                                    aria-label="Search">
                            </article>

                            <article>
                                <ul class="pagination">
                                    <li class="page-item">
                                        <button class="btn page-link">
                                            <i class="fa-solid fa-table-cells-large"></i>
                                        </button>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link selected" href="#" aria-label="Next">
                                            <i class="fa-solid fa-list"></i>
                                        </a>
                                    </li>
                                </ul>
                            </article>
                        </section>

                        <!-- Exercises data  -->
                        <section class="card-body">
                            <div class="table-area">
                                <table class="table align-middle mb-0 bg-white">
                                    <tbody>
                                    <?php 
                                        while($row = mysqli_fetch_assoc($result)) {
                                            // $img = $row["user_image"];
                                            $img = null;
                                            if(!$img) $img = "images/t1.png";
                                            echo '<tr>';
                                            echo    '<td>';
                                            echo        '<article class="d-flex align-items-center">';
                                            echo            '<img src="' . $img . '" alt="Treatment img" title="Treatment img" class="treatmentImg" />';
                                            echo            '<div class="ms-3">';
                                            echo                '<p class="fw-bold mb-1">' . $row["sets"] . '</p>';
                                            echo                '<p class="text-muted mb-0">' . $row["sets"] . '</p>';
                                            echo            '</div>';
                                            echo        '</article>';
                                            echo    '</td>';
                                            echo    '<td>';
                                            echo        '<a href="patient_plan.php?exId='. $row["ex_id"] .'" class="btn"> <i class="fa-solid fa-ellipsis-vertical"></i></a>';
                                            echo    '</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </section>
            </section>
        </main>

        <!-- footer -->
        <footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">&copy; 2022 RehabOnline</p>
            <a href="/"
                class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img src="includes/images/logo-c.png" class="rounded-circle" alt="logo" />
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </footer>

        <?php if($resTreatment) mysqli_free_result($resTreatment);?>
        <?php if($resExercises) mysqli_free_result($resExercises);?>

        <script src="includes/js/script.js"></script>
    </body>
</html>

<?php
    //close DB connection
    mysqli_close($connection);
?>