<?php  
include "connect.php";
$msg = '';
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $query = "SELECT * FROM users WHERE email = '$email'";
    $hash_code;
    $search = mysqli_query($conn, $query)
    or die("Error getting email from db");

    if ($search && mysqli_num_rows($search) > 0 ) {
        $result = mysqli_fetch_all($search, MYSQLI_ASSOC);

        foreach ($result as $det) {
            if ($det['email'] == $email) {
            $hash_code = $det['hash_code'];
                 
            }
        }
    $from = "noreply@spendless.com";
    $to = $email;
    $subject = "Recover Your SpendLess Password";
    $msg = "Click the link below to recover your password \n\n
    
    https://spendless-hng.000webhostapp.com/recoverpass.php?email=$email&hash=$hash_code
    
    ";
    $sent = mail($to, $subject, $msg, "From: $from");
    if ($sent) {
        $msg = "Follow the link sent to your email to recover your password";
    }
     
    } else {
        $msg = "There is no record of this email address";
    }
    

 


}

?>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Forgot Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
        <!--<link rel="stylesheet" href="./css/style.css">-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
        body {
            font-family: Nunito, sans-serif;
        }
        .forgot-form {
            margin-left: 5%;
            margin-top: 5%;
            align-items: center;
        }
        .email-input {
            width: 100%;
        }
        .button {
            width: 50%;
            margin-left: 25%;
            background-color: #FF7800;
            border: none;
            outline: 0;
        }
        </style>
</head>
<section>
    <div class="container">
            <div class="row">
              <div class="col-sm col-md-4">
              </div>
              <div class="col-sm col-md-4">
                    <div class="form-group" >
                            <form action="forgotpassword.php" method="POST"><br>
                                <label>Please enter your registered email address</label>
                                <input class ="email-input remove-glow border-black rounded form-control pl-3" type="email" placeholder="Email address" name="email" >
                                    <br>
                                <button class="btn btn-success button" type="submit" value="Send" name="submit">Send</button>
                            </form>
                        </div>
                        <p><?php echo $msg ?></p>
              </div>
              <div class="col-sm col-md-4">
              </div>
            </div>
          </div>
</section>
</html>