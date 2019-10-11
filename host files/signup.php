<?php
include 'connect.php';
//create variable for error

function sanitize($input){
    global $conn;
    $input = htmlentities(strip_tags(trim($input)));
    $input = mysqli_real_escape_string($conn, $input);
    return $input;
}

if (isset($_POST['submit'])) {
    $errors = [];

    extract($_POST);

    if (!empty($fname)){
        if (preg_match('/^[a-z ]{8,}$/i', $fname)){
            $fname = sanitize($fname);
        } else {
            $errors[] = "Full name must be a minimum of 8 characters";
        }
    } else {
        $errors[] = "Please enter your full name";
    }

    if (!empty($username)){
        if (preg_match('/[a-z]{4,}/i', $username)){
            $username = sanitize($username);
        } else {
            $errors[] = "Username must contain a minimum of 4 characters.";
        }
    } else {
        $errors[] = "Please enter your username";
    }

    if (!empty($password)){
        if (preg_match('/(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^a-zA-Z0-9]){6,40}/', $password)){
            $password = sanitize($password);
        } else{
            $errors[] = "Password must contain a minimum of 6 characters with at least one lower case, upper case and one digit.";
        }
    } else {
        $errors[] = "Enter your password";
    }

    if (!empty($confirmPassword)){
        if (preg_match('/(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^a-zA-Z0-9]){6,40}/', $confirmPassword)){
            $confirmPassword = sanitize($confirmPassword);
        } else{
            $errors[] = "Confirm password must also contain a minimum of 6 characters with at least one lower case, upper case and one digit.";
        }
    } else {
        $errors[] = "Confirm your password.";
    }

    if (isset($password) && isset($confirmPassword)) {
        if ($password === $confirmPassword) {
            $password = md5($password);
        } else {
            $errors[] = "Passwords entered mis-matched";
        }
    }

    if (!empty($email)) {
        $email_tmp = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($email_tmp) {
            $email = sanitize($email_tmp);
        } else {
            $errors[] = "Invalid email address";
        }
    } else {
        $errors[] = "Please enter your email";
    }

    if (!$errors) {
        $query = "SELECT * FROM user WHERE email = '$email'";

        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $errors[] = "Can't recreate an existing account. Log in";
        } else {
            $hash_code = md5(rand(1, 1000));
            $active = 'no';

            $query = "INSERT INTO user (username, password_hash, email) VALUES ('$username','$password', '$email')";

            $result = mysqli_query($conn, $query);

            if ($result) {
                //send verification email
                $from = "noreply@spendless-hng.com";
                $to = $email;
                $subject = 'Sign Up Verification';
                $message = "Thanks for signing up with SpendLess \n \n
                Please click on the link to verify your account: \n
                https://spendless-hng.000webhostapp.com/verification.php?email=$email&hash=$hash_code";
                //send_mail
                $sent = mail($to, $subject, $message, "From: $from");
                if($sent) {
                    header("Location: goverify.html");
                    exit();
                } else {
                    $errors[] = "Couldn't send verification link to your email";
                }
            } else {
                $errors[] = "Data entry failed!" . mysqli_error($conn);
            }


        }
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#333" />
    <link rel="manifest" href="/manifest.json" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="newcss.css">
    <link rel="stylesheet" href="./css/terms.css">

    <title>Sign Up</title>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #32465a;">
    <a class="navbar-brand" href="index.html"><img
                src="https://res.cloudinary.com/angelae/image/upload/v1569493481/Start-ng-Pre-internship/n2mmwn3pvnbjuaqjjkj3.png"
                alt="Logo"
                style="width: 63px; height: 63px; padding: 10px;"
        /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link py-md-3 px-4" href="content.html#about-us">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-md-3 px-4" href="content.html#why-spendless">Why SpendLess?</a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-md-3 px-4" href="content.html#how-it-works">How it Works</a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-md-3 px-4" href="content.html#support">Support</a>
            </li>
            <a href="login.php" class="nav-item py-md-3 px-4 btn btn-outline-warning">LOG IN</a>

        </ul>

    </div>
</nav>
<section class="modal-dark">
    <div class="modal-container">
        <header>
            <h4>
                Terms of service
                <span>x</span>
            </h4>
        </header>
        <main>
            <h6>Welcome to SpendLess</h6>
            <p>1. Accepting the Terms <br>

                1.1 In order to use the Services, you must first agree to the Terms. You may not use the Services if you do not accept the Terms. <br>

                1.2 You can accept the Terms by: <br>

                (A) clicking to accept or agree to the Terms, where this option is made available to you by Spendless in the user interface for any Service. <br> <br>

                2. Use of the Services by you <br>

                2.1 In order to access certain Services, you may be required to provide information about yourself (such as identification or contact details) as part of the registration process for the Service. You agree that any registration information you give to Spendless will always be accurate, correct and up to date. <br> <br>

                3. Your passwords and account security <br>
                3.1 Accordingly, you agree that you will be solely responsible to Google for all activities that occur under your account.

            </p>
        </main>
    </div>
</section>

<section class="signup">
    <div class="container h-100">

        <div cs="row h-100 justify-content-center align-items-center" class="signup-content">

            <form class="formSize" method="POST" action="signup.php" onsubmit="return Validate()" name="signupForm">
                <h4 id="error">error message here </h4>
                <div class="formHeader col-12">Welcome </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" name="fname" id="inputName" placeholder="Enter Name">
                        <div class="errorMessage" id="name_error"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="inputUsername">Username</label>
                        <input type="text" class="form-control" name="username" id="inputUsername" placeholder="Enter Username">
                        <div class="errorMessage" id="username_error" ></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Enter Email" >
                        <div class="errorMessage" id="email_error"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
                        <div class="errorMessage" id="password_error"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
                        <div id="confirmPassword_error"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required="required"/>
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-outline-warning btn-lg btn-block " name="submit">Sign Up</button>
                    </div>
                </div>

                <?php if (isset($errors)) {
                    var_dump($errors);
                } ?>
            </form>

        </div>
    </div>
</section>




<footer class="footer">
    <div class="footerText"> Team Ganymede - HNGi6 &copy; 2019.  <a href="#"><i class="fa fa-angle-double-up fa-2x"></i></a></div>


</footer>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="app.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="newjs.js"></script>
<script src="terms.js"></script>
</body>
</html>