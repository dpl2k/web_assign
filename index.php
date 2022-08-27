<?php session_start();
function makeUrl($string)
{
    $string = trim($string);
    $string = str_replace(' ', '-', $string);
    $string = strtolower($string);
    return $string;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="http://localhost:7070/web_assign/" />
    <title>English with quiz</title>
    <meta name="author" content="web_group">
    <meta name="description" content="English quiz system for people who want to improve their English skill">
    <meta name="keywords" content="english quiz, english exam, improve your english skill, test your engilsh level ">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- meta for address -->
    <meta name="geo.region" content="VN" />
    <meta name="geo.placename" content="District 10" />
    <meta name="geo.position" content="10.773309;106.659604" />
    <meta name="ICBM" content="10.773309, 106.659604" />
    <!-- meta end -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link href="myStyle.css" rel="stylesheet" type="text/css" media="all">
    <link rel="icon" href="image/logo.svg" sizes="96x96" />
</head>

<body>
    <?php
    if (isset($_SESSION["loggedin"])) {
        if ($_SESSION['role'] == 'admin') {
            header("location: admin/");
            exit;
        } elseif ($_SESSION['role'] == 'teacher') {
            header("location: teacher/");
            exit;
        } elseif ($_SESSION['role'] == 'student') {
            header("location: student/");
            exit;
        }
    }
    ?>
    <div class="head">
        <img id="logo" src="image/logo.svg" alt="Logo" />
        <h1 class="myh1">Ho Chi Minh City University of Technology <br>
            <p>VIETNAM NATIONAL UNIVERSITY - HO CHI MINH</p>
        </h1>
        <br>
    </div>

    <div class="w3-bar w3-indigo w3-card">
        <a style="text-decoration: none;" href="#about" class="w3-bar-item w3-button w3-padding-16 w3-hover-teal">
            <i class="fa fa-fw fa-home"></i> Home
        </a>

        <a style="text-decoration: none;" href="#contact" class="w3-bar-item w3-button w3-padding-16 w3-hover-teal">
            <i class="fa fa-fw fa-book"></i> Contact
        </a>

        <a style="text-decoration: none;" class="w3-bar-item w3-button w3-padding-16 w3-hover-teal w3-right" onclick="document.getElementById('id01').style.display='block'" href="index/login.html" style="width:auto;">
            <i class="fa fa-fw fa-sign-in"></i> Login
        </a>

        <a style="text-decoration: none;" class="w3-bar-item w3-button w3-padding-16 w3-hover-teal w3-right" onclick="document.getElementById('id02').style.display='block'" href="index/register.html" style="width:auto;">
            <i class="fa fa-fw fa-user-plus"></i> Sign up
        </a>
    </div>
    <div id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li class="item1 active"></li>
            <li class="item2"></li>
            <li class="item3"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="image/bk1.jpg" style="width:100%">
            </div>

            <div class="carousel-item">
                <img src="image/bk3.jpg" style="width:100%; height: 700px;">
            </div>

            <div class="carousel-item">
                <img src="image/bk4.jpg" style="width:100%;height: 700px;">
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#myCarousel">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    <?php
    if (array_key_exists('page', $_GET)) {
        switch ($_GET['page']) {
            case 'home':
                include 'home.php';
                break;
            case 'login':
                include 'login.php';
                break;
            case 'register':
                include 'register.php';
                break;
            default:
                include 'notfound.php';
                break;
        }
    } else {
        include 'home.php';
    }
    ?>
    <!-- The Contact Section -->
    <footer class="w3-padding-32 w3-center w3-pale-blue">
        <div class="w3-container w3-content w3-padding-32 w3-xlarge" style="max-width:800px" id="contact">
            <h2 class="w3-wide w3-left">CONTACT</h2>
            <h2 class="w3-wide w3-right">FOLLOW US</h2>
            <div class="w3-row w3-padding-32">
                <div class="w3-col m6 w3-large w3-margin-bottom w3-left-align">
                    <a href="https://goo.gl/maps/szpVbcu425fgrxJw7" style="color:darkred">
                        <i class="fa fa-map-marker" style="width:30px; color:darkred;"></i> Ho Chi Minh City, Vietnam
                    </a>
                    <br>
                    <i class="fa fa-phone" style="width:30px; color:darkgreen;"></i> Tel: +84 28 7300 4183<br>
                    <i class="fa fa-envelope" style="width:30px; color:darkblue;"> </i> Email: admission@oisp.edu.vn<br>
                </div>
                <div class="w3-col m6 w3-xlarge w3-margin-bottom w3-right-align">
                    <a class="fa fa-facebook-official" style="color:darkblue;" href="https://www.facebook.com/truongdhbachkhoa/">
                    </a>
                    <a class="fa fa-instagram" style="color:rgb(170, 145, 34);" href="https://www.instagram.com/truongdaihocbachkhoa.1957/?fbclid=IwAR23WtLTFk3UbcukkHukY-8B8EwSqxTb8Dfx8D5pKUGB8gCKTLhs2Y7MHQo">
                    </a>
                    <a class="fa fa-youtube-play" style="color:red;" href="https://www.youtube.com/channel/UCl4zLzbk82yGnpRDNTaYKow/featured">
                    </a>
                    <a class="fa fa-pinterest-p" style="color:darkmagenta;"></a>
                    <a class="fa fa-twitter" style="color:blue;"></a>
                    <p class="w3-large">For more information please visit
                        <a href="https://oisp.hcmut.edu.vn/en/" style="color:darkgreen;" target="_blank">this
                        </a>
                        website
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <a id="backtotop" onclick="topFunction()" title="Go to top"><i class="fa fa-fw fa-chevron-up"></i></a>
    <script src="myScript.js"></script>
</body>

</html>