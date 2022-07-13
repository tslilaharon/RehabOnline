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
	$userId = $_GET["useId"];
    
    $query = "SELECT * FROM tbl_rehab_treatments_221 AS t
    JOIN tbl_rehab_treatment_plan_221 AS p
    ON t.plan_id = p.plan_id
    JOIN tbl_rehab_users_221 AS u
    ON p.user_id = u.user_id
    WHERE u.user_id = $userId";


 	$result = mysqli_query($connection, $query);
	if($result) {
		$row = mysqli_fetch_assoc($result);//there is only 1 with id=X
	}
	else die("DB query failed.");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RehabOnline - Treatments</title>

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
    
    <body id="layout">
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
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
                                    if(!$img) $img = "images/default.png";
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
                    <li class="breadcrumb-item active" aria-current="page">Treatments Plans</li>
                </ol>
            </section>
            
            <!-- title -->
            <section class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Treatments Plans</h1>
            </section>

            <div class="container">
                <!-- Patient plans -->
                <section class="row">
                    <!-- Patient data-->
                    <section class="col-lg-4 col-md-10 border-right">
                        <div class="card shadow mb-4 border-right">
                            <div class="d-flex flex-column p-5 py-5">
                                <h4 class="mb-0"> Patient Details</h4>
                                <?php 
                                    $img = $row["user_image"];
                                    if(!$img) $img = "images/default.png";
                                    echo '<img id="userImg" class="rounded-circle listImg py-5" alt="user img" src="' . $img . '">';
                                    echo '<h5>' . $row["full_name"] .'</h5>';
                                    echo '<p><b>Email: </b>' . $row["email"] .'</p>';
                                    echo '<p><b>Phone: </b>' . $row["phone"] .'</p>';
                                    echo '<p><b>Address: </b>' . $row["address"] .'</p>';
                                    echo '<p><b>Gender: </b>' . $row["gender"] .'</p>';
                                    echo '<p><b>Gender: </b> Male</p>';
                                    echo '<p>Starting the rehabilitation process on 25/01/22</p>';
                                    echo '<p><b>About</b></p>';
                                    echo '<p>' . $row["about"] .'</p>';
                                ?>
                            </div>
                        </div>
                    </section>

                    <!-- Treatments Plans section -->
                    <section class="col-lg-8 col-md-10 border-right">
                        <div class="container card shadow mb-4">

                            <section class="container top-bar">
                                <article class="form-outline">
                                    <input type="search" id="search" class="form-control" 
                                        placeholder="&#xF002; Search" aria-label="Search">
                                </article>

                                <!-- CRUD -->
                                <article class="crud">
                                    <a id="delete-btn" class="btn btn-outline-primary">
                                        <i class="fa-solid fa-trash-can"></i>
                                        Delete
                                    </a>
                                    <?php 
                                        echo '<a id="edit-btn"  href="form_treatment.php?useId='. $row["user_id"] .'" class="btn btn-outline-primary"> <i class="fa-solid fa-pen"></i> Edit</a>'
                                    ?>
                                    <?php 
                                        echo '<a id="add-btn"  href="form_treatment.php?useId='. $row["user_id"] .'" class="btn btn-outline-primary"> <i class="fa-solid fa-circle-plus"></i> Add </a>';
                                    ?>
                                </article>

                            </section>

                            <hr>

                            <section class="accordion accordion-flush" id="accordionExample">
                                <?php 
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo '<article class="accordion-item">';
                                        echo    '<h2 class="accordion-header" id="headingOne">';
                                        echo        '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne' . $row["treatment_id"] .'" aria-expanded="false" aria-controls="collapseOne">' . $row["title"] . '</button>';
                                        echo    '</h2>';
                                        echo    '<div id="collapseOne' . $row["treatment_id"] .'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">';
                                        echo        '<div class="d-flex flex-column accordion-body">';
                                        echo            '<h3>' . $row["title"] .'</h3>';
                                        echo            '<div>';
                                        echo                '<span class="item-icon">';
                                        echo                    '<i class="fas fa-clock"></i>' . $row["time"];
                                        echo                ' minutes</span>';
                                        echo                '<span class="item-icon">';
                                        echo                    '<i class="fas fa-running"></i>' . $row["number_of_exs"];
                                        echo                ' exercises </span>';
                                        echo            '</div>';
                                        echo            '<p>' . $row["info"] .'</p>';
                                        echo            '<div class="align-self-end">';
                                        echo                '<a href="treatment.php?treatmentId='. $row["treatment_id"] .'" class="btn btn-outline-primary">More</a>';
                                        echo            '</div>';
                                        echo        '</div>';
                                        echo    '</div>';
                                        echo '</article>';
                                        echo '<br>';
                                    }
                                ?> 
                            </section>
                        </div>
                    </section>

                </section>
            </div>
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

    <?php if($result) mysqli_free_result($result);?>
    <?php if($resTreatments) mysqli_free_result($resTreatments);?>

    <script src="js/script.js"></script>
</body>
</html>

<?php
    //close DB connection
    mysqli_close($connection);
?>
