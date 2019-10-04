<?php

if(isset($_POST['email']) && isset($_POST['message'])){
   
$fp = fopen('feedbackform.txt', "a");
$savestring = $_POST['email'] . "\n" . $_POST['message'] .  "\n";
fwrite($fp, $savestring);
fclose($fp);
echo "<script type= 'text/javascript'>window.alert('Your message has been sent sucessfully!')</script>";
//echo "<script type='text/javascript'>document.location = 'index.html'</script>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BudgetIt-Feedback</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="./css/style.css">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1129efb8ac.js"></script>      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
    <style>
         .col-8{
            padding-left: 5%;
            padding-top: 10%;
            color: #41424E;
        }
        .col-4{
            background-color:#41424E;
            color:#CDCDCD; 
            line-height: 5em;
            margin:0 auto;
            padding-bottom: 10%;
        }
        .side-bar-links {
            color: #CDCDCD;
            
        }
        .side-bar-links:hover{
            text-decoration: none;
            color: #FF7800;
            
        }
        .side-bar-list{
            padding-left: 5%;   
        }
        .col-4 li {
            border-bottom: 1px solid #CDCDCD;    
        }
        #net-income{
            padding-left: 5px;
        }
        
        .expenditure{
            padding-bottom: 5%;
        }
        
        .continue:hover{ 
            background-color: #41424E!important;
            outline: 0;
        }
        .continue:active{
            outline: 0;
            border: none !important;
            box-shadow: none !important;
        }
        #user-image{
            width:150px;
            height: 150px;
        }
    
    </style>
</head>
<body>
 <nav class="flex">
        <figure>
            <img
					src="https://res.cloudinary.com/angelae/image/upload/v1569493481/Start-ng-Pre-internship/n2mmwn3pvnbjuaqjjkj3.png"
					alt="Logo"
					style="width: 63px; height: 63px; padding: 10px;"
				/>
        </figure>
        <div class="big-nav hidden">
            <ul>
                <a href="" class="toplinks"><li>Why BudgetIt?</li></a>
                <a href="" class="toplinks"><li>Solutions</li></a>
                <a href="" class="toplinks"><li>Resources</li></a>
                <a href="" class="toplinks"><li>How it works</li></a>
                <a href="" class="toplinks"><li>Support</li></a>
            </ul>
            <div>
                <a href="logout.php" >LOG OUT</a>
            </div>
        </div>
        <i class="fa fa-bars"></i>
        <div class="small-nav hidden">
            <a href="" class="toplinks">Why Budget It?</a>
            <a href="" class="toplinks">Solutions</a>
            <a href="" class="toplinks">Resources</a>
            <a href="" class="toplinks">How it Works</a>
            <a href="" class="toplinks">Support</a>
            <a href="">LOG OUT</a>
        </div>
    </nav>
    
    <section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4"><br>
                <div style="align-content: center;">
                </div>
                <div style="padding: 3%; font-size: 20px;">
                    <ul class="side-bar-list">
                        <li><i class='fas fa-home'></i> &nbsp;<a href="./index.html" class ="side-bar-links">Home</a></li>
                        <li><i class='fa fa-user'></i>&nbsp;&nbsp;&nbsp;<a href="" class ="side-bar-links">Account</a></li>
                        <li><i class='fa fa-line-chart'></i>&nbsp;&nbsp;&nbsp;<a href="userpage.php" class ="side-bar-links">Dashboard</a></li>
                        <li><i class='fa fa-line-chart'></i>&nbsp;&nbsp;&nbsp;<a href="budgt_chart.php" class ="side-bar-links">Budget Chart</a></li>
                        <li><i class='fa fa-gear'></i>&nbsp;&nbsp;&nbsp;<a href="" class ="side-bar-links">Settings</a></li>
                        <li><i class='fa fa-users'></i>&nbsp;&nbsp;&nbsp;<a href="" class ="side-bar-links">Refer</a></li>
                        <li><i class='fa fa-comments'></i>&nbsp;&nbsp;&nbsp;<a href="feedback.php" class ="side-bar-links">Feedback</a></li>
                        <li><i class='fa fa-sign-out'></i>&nbsp;&nbsp;&nbsp;<a href="logout.php" class ="side-bar-links">Logout</a></li>
                    </ul>
                </div>
            </div>
        <div class="col-8">
            <div>
                <h2></h2>
                <h4>We would like to hear from you</h4> 
                </div>
            <br>
            <br>
            <div>
            <form action="" id="feedback_form" method="post">
                <div class="form-group">
                    <label class="h5">Email:</label>
                    <input type="email" name="email" class="remove-glow border-black rounded form-control col-md-3 pl-3" required>
                </div>
                <h5>Subject:</h5>
                
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                <input type="radio" name="options" id="option1" id="feedback-btn" autocomplete="off" checked>Feedback</label>
                <label class="btn btn-secondary">
                <input type="radio" name="options" id="option2" id="complaint-btn" autocomplete="off"> Complaint</label>
                </div>
                <br>
                <br>       
                <div class="form-group">
                <label class="h5">Message:</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" id="message" name="message" rows="3" required></textarea>
                </div>
                <div id="dynamic_field">
                </div> 
                <!-- <h6 class="mt-4">Add More</h6> -->
                <input type="submit" id="submit" value="Send Message" name="submit" class="mt-4 form-control btn btn-primary">
            </form></div>
        </div>
    </div>
    
    
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>