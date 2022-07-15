<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if(!isset($_SESSION["user_id"])||($_SESSION["user_type"] != 't')) 
    { 
        if($_SESSION["user_type"] == 'p')
        {
            header('Location: ' . URL . 'patient_plan.php?userId='. $_SESSION["user_id"] .'');
        }
        else{
            header('Location: ' . URL . 'login.php');
        }
    }
 
    // //get Patients from DB
    $query 	= "SELECT * FROM tbl_rehab_users_221 WHERE user_type = 'p'";
    $result = mysqli_query($connection, $query);
    if(!$result) { 
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
        <title>RehabOnline - Home</title>

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
    
    <body id="home">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <!-- logo -->
                    <a class="navbar-brand" href="index.php">
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

        <main id="wrapper">
            <section class="container-fluid">

                <!-- title -->
                <section class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Home</h1>
                </section>

                <!-- Notifications -->
                <section class="row firstRow">
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-5">
                            <div class="card-body firstcard">
                                <h2>Hello <span>Hadar,</span></h2>
                                <p>Your patients' data is ready Unread 2 important notifications</p>
                                <button type="button" class="btn btn-outline-danger">
                                    Notifications <span class="badge bg-danger ms-2">2 </span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Chart -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <div
                                class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold"> Weekly activity of patients</h6>
                            </div>
                            <div class="card-body firstcard">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Patients table -->
                <section class="row" id="patientTable">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div
                                class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold"> Patients </h6>
                            </div>
                            <section class="card-body">
                                <div class="table-area">
                                    <table class="table align-middle mb-0 bg-white">
                                        <thead>
                                            <tr class="patients-td-h">
                                                <th>Name</th>
                                                <th>Id</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $img = $row["user_image"];
                                                    if(!$img) $img = "includes/images/default.png";
                                                    echo '<tr class="patients-td-b">';
                                                    echo    '<td>';
                                                    echo        '<article class="d-flex">';
                                                    echo            '<img src="' . $img . '" alt="user img" title="user img" class="rounded-circle" />';
                                                    echo            '<div class="info">';
                                                    echo                '<p class="fw-bold mb-1">' . $row["full_name"] . '</p>';
                                                    echo                '<p class="text-muted mb-0">' . $row["email"] . '</p>';
                                                    echo            '</div>';
                                                    echo        '</article>';
                                                    echo    '</td>';
                                                    echo    '<td>';
                                                    echo        '<p class="text-muted mb-0">'. $row["id_num"] .'</p>';
                                                    echo    '</td>';
                                                    echo    '<td>';
                                                    echo        '<a href="patient_plan.php?userId='. $row["user_id"] .'" class="btn btn-outline-primary"> View &rarr;</a>';
                                                    echo    '</td>';
                                                    echo '</tr>';
                                                }
                                        ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
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
                <li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </footer>

        <?php 
            //release returned data
            if($result) mysqli_free_result($result);
        ?>

        <script src="includes/js/chart.js"></script>
    </body>
</html>

<?php
    //close DB connection
    mysqli_close($connection);
?>
