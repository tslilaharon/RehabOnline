<?php
    include 'db.php';
    include 'config.php';

    if (!(empty($_POST["loginMail"])&&(empty($_POST["loginPass"])))) {
        $query  = "SELECT * FROM tbl_rehab_users_221 WHERE email = '" 
            . $_POST["loginMail"] 
            . "' and password = '"
            . $_POST["loginPass"]
            ."'";

        $result = mysqli_query($connection , $query);
        $row    = mysqli_fetch_array($result);
        $message = "";

        if(is_array($row)) {
            session_start();
            $_SESSION["user_id"] = $row['user_id'];
            $_SESSION["user_image"] = $row['user_image'];
            $_SESSION["user_type"] = $row['user_type'];

            if ($_SESSION["user_type"] == 't') {
                header('Location: ' . URL . 'index.php');
            } else if ($_SESSION["user_type"] == 'p'){
                header('Location: ' . URL . 'patient_plan.php?userId='. $row["user_id"] .'');
            }
        } else {
            $message = "Invalid email or password !";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RehabOnline - Log In</title>

        <!-- cdn bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>

        <!-- cdn font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous" referrerpolicy="no-referrer">

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

        <!-- header -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <!-- logo -->
                    <a class="navbar-brand" href="index.php">
                        <span>RehabOnline</span>
                    </a>
                </div>
            </nav>
        </header>

        <!-- main -->
        <main id="list-wrapper">
            <section class="container container-fluid">

                <!-- title -->
                <section class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Log In</h1>
                </section>

                <!-- form section -->
                <div class="row">
                    <div class="form-signin col d-flex flex-column position-static">
                        <p class="h2 mb-3">Welcome!</p>
                        <p class="h5 mb-4">log in to your account</p>

                        <form  class="logForm" action="#" method="post" id="frm" autocomplete="off">
                            <article class="form-floating">
                                <input type="email" name="loginMail" class="form-control" id="loginMail"
                                    placeholder="name@example.com" autocomplete="off" required>
                                <label for="loginMail">Email</label>
                            </article>

                            <article class="form-floating">
                                <input type="password" name="loginPass" class="form-control" id="loginPass" placeholder="Password"
                                    autocomplete="off" required>
                                <label for="loginPass">Password</label>
                            </article>

                            <!-- btn submit  -->
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-4">
                                <button type="submit" class="btn btn-outline-primary">Log In</button>
                            </div>

                            <div class="error-message">
                                <?php if(isset($message)) { echo '<small class="text-muted">' . $message . '</small>'; } ?>
                            </div>

                        </form>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img src="includes/images/medical.png" alt="medical"/>
                    </div>
                </div>

            </section>
        </main>

        <!-- footer -->
        <footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">&copy; 2022 RehabOnline</p>
            <a href="index.php"
                class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img src="includes/images/logo-c.png" class="rounded-circle" alt="logo" />
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </footer>
        
    </body>
</html>

<?php
    //close DB connection
    mysqli_close($connection);
?>
