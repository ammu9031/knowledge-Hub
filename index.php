
<?php ob_start(); ?>
<?php session_start(); ?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<title>Knowledge Hub</title>

<style>
*{box-sizing:border-box}

html,body{
    margin:0;
    padding:0;
    font-family:Arial,sans-serif;
    color:#333;
    background:#a285bc;
}

body{overflow-x:hidden}

/* Navbar */
.navbar{
    background:#a285bc!important;
    padding:14px 50px;
    border:0
}

.navbar-brand{
    color:#fff!important;
    font-size:27px;
    font-weight:bold
}

.nav-buttons{
    display:flex;
    gap:12px
}

.nav-btn{
    padding:9px 23px;
    border-radius:6px;
    text-decoration:none!important;
    font-size:15px;
    font-weight:600;
    cursor:pointer
}

.signin-btn{
    color:#51406f!important;
    background:#fff;
    border:1px solid #fff
}

.signin-btn:hover{background:silver;}

.signup-btn{
    color:#51406f!important;
    background:#fff;
    border:1px solid #fff
}

.signup-btn:hover{background:silver;}

/* Hero */
.hero{
    min-height:680px;
    background:url('img/im1.jpeg') center/cover no-repeat;
    position:relative;
    display:flex;
    align-items:center;
    justify-content:center
}

.overlay{
    position:absolute;
    inset:0;
    background:rgba(255,255,255,.08)
}

.hero-content{
    position:relative;
    z-index:2;
    width:90%;
    max-width:900px;
    padding:35px 40px;
    text-align:center;
    border-radius:18px;
    background:rgba(255,255,255,.25);
    backdrop-filter:blur(5px);
    -webkit-backdrop-filter:blur(5px);
    border:1px solid rgba(255,255,255,.45)
}

.welcome{
    display:inline-block;
    padding:7px 18px;
    margin-bottom:12px;
    background:rgba(255,255,255,.88);
    border-radius:20px;
    color:#51406f;
    font-size:21px;
    font-weight:600
}

.hero-content h1{
    margin:0 0 18px;
    font-size:60px;
    line-height:1.1;
    font-weight:700;
    color:#352a49;
    text-shadow:0 1px 2px #fff
}

.hero-description{
    max-width:700px;
    margin:auto;
    padding:13px 20px;
    background:rgba(255,255,255,.88);
    border-radius:8px;
    color:#39343f;
    font-size:17px;
    line-height:1.6
}

.features{margin-top:35px}

.feature-box{
    background:rgba(255,255,255,.9);
    border:1px solid #e1d9eb;
    border-radius:10px;
    padding:20px 18px;
    min-height:140px
}

.feature-box h4{
    color:#51406f;
    font-size:19px;
    margin-bottom:10px;
    font-weight:600
}

.feature-box p{
    color:#55505b;
    margin:0;
    font-size:14px;
    line-height:1.6
}

/* Modal */
.modal-content{
    border:0;
    border-radius:10px;
    overflow:hidden
}

.modal-header{
    background:#a285bc;

    color:#fff;
    border:0
}

.modal-header .close{
    color:#fff;
    opacity:1
}

.modal-body{
    padding:25px
}

.form-control{
    height:44px;
    border:1px solid #d8d0e3;
    border-radius:6px
}

.form-control:focus{
    border-color:#8068a5;
    box-shadow:0 0 0 .15rem rgba(128,104,165,.15)
}

.my-btn{
    background:#8068a5;
    color:#fff;
    border:0;
    padding:11px 15px;
    border-radius:6px;
    font-weight:600
}

.my-btn:hover{
    background:#70598f;
    color:#fff
}

/* Footer */
footer{
    background:#a285bc;

    color:white;
    padding:40px 0 18px
}

footer .footer-title{
    font-size:22px;
    font-weight:600;
    margin-bottom:12px
}

footer h5{
    font-size:20px;
    margin-bottom:14px
}

footer p{
    color:#d8d3df;
    font-size:20px;
    margin-bottom:8px
}

.footer-left{text-align:left}
.footer-middle{text-align:center}
.footer-right{text-align:right}

.footer-line{
    border:0;
    border-top:1px solid rgba(255,255,255,.18);
    margin:25px 0 16px
}

.copyright{
    text-align:center;
    color:#cfc8d8;
    font-size:13px;
    margin:0
}

/* Mobile */
@media(max-width:767px){
    .navbar{padding:12px 18px}
    .navbar-brand{font-size:22px}
    .nav-buttons{
        margin-top:12px;
        justify-content:center;
        width:100%
    }

    .hero{
        min-height:780px;
        padding:50px 0
    }

    .hero-content{
        width:92%;
        padding:28px 18px
    }

    .hero-content h1{font-size:42px}
    .welcome{font-size:19px}
    .hero-description{font-size:15px}

    .feature-box{margin-bottom:15px}

    footer{padding:35px 20px 20px}

    .footer-left,
    .footer-middle,
    .footer-right{
        text-align:center;
        margin-bottom:22px
    }
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg">
<a class="navbar-brand" href="index.php">📚Knowledge Hub</a>

<div class="ml-auto nav-buttons">
<a class="nav-btn signin-btn" data-toggle="modal" data-target="#exampleModal123">Sign In</a>
<a class="nav-btn signup-btn" data-toggle="modal" data-target="#exampleModal">Sign Up</a>
</div>
</nav>

<section class="hero">
<div class="overlay"></div>

<div class="hero-content">

<div class="welcome">Welcome To</div>

<h1>Knowledge Hub</h1>

<p class="hero-description">
A smart learning platform that connects you to books,
resources and knowledge anytime, anywhere.
</p>

<div class="container features">
<div class="row">

<div class="col-md-4">
<div class="feature-box">
<h4>📚 Wide Collection</h4>
<p>Useful books and learning resources for your studies.</p>
</div>
</div>

<div class="col-md-4">
<div class="feature-box">
<h4>🔐 Secure Platform</h4>
<p>Your information stays protected while using the platform.</p>
</div>
</div>

<div class="col-md-4">
<div class="feature-box">
<h4>🕒 Anytime Access</h4>
<p>Access your digital library whenever you need it.</p>
</div>
</div>

</div>
</div>

</div>
</section>

<!-- Sign Up -->
<div class="modal fade" id="exampleModal" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<h4 class="modal-title">Sign Up</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">
<form action="index.php" method="post">

<div class="form-row">

<div class="form-group col-md-6">
<label>Email</label>
<input type="email" name="e" class="form-control" required>
</div>

<div class="form-group col-md-6">
<label>Password</label>
<input type="password" name="p" class="form-control" required>
</div>

</div>

<div class="form-group">
<label>Address</label>
<input type="text" name="a" class="form-control" required>
</div>

<div class="form-group">
<label>Username</label>
<input type="text" name="u" class="form-control" required>
</div>

<div class="form-group">
<label>Mobile Number</label>
<input type="text" name="m" maxlength="10" class="form-control" required>
</div>

<input type="submit" name="x" value="Sign Up" class="my-btn btn-block">

</form>
</div>
</div>
</div>
</div>

<!-- Sign In -->
<div class="modal fade" id="exampleModal123" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h4 class="modal-title">Sign In</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">
<form action="index.php" method="post">

<div class="form-group">
<label>Username</label>
<input type="text" name="u" class="form-control" placeholder="Enter Username" required>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" name="p" class="form-control" placeholder="Enter Password" required>
</div>

<input type="submit" name="y" value="Sign In" class="my-btn btn-block">

</form>
</div>
</div>
</div>
</div>

<?php

$conn=new mysqli("127.0.0.1","root","","project_batch");

if($conn->connect_error)
    die("Database connection failed: ".$conn->connect_error);

if(isset($_POST["x"])){

    $stmt=$conn->prepare(
        "INSERT INTO user_info(email,pass,address,uname,mobile)
         VALUES(?,?,?,?,?)"
    );

    $stmt->bind_param(
        "sssss",
        $_POST["e"],
        $_POST["p"],
        $_POST["a"],
        $_POST["u"],
        $_POST["m"]
    );

    if($stmt->execute()){
        echo "<script>alert('You are registered successfully !!!!');</script>";
    }else{
        echo "<script>alert('Registration failed. Please try again.');</script>";
    }

    $stmt->close();
}

if(isset($_POST["y"])){

    $stmt=$conn->prepare(
        "SELECT user_id,uname,pass FROM user_info
         WHERE uname=? AND pass=? LIMIT 1"
    );

    $stmt->bind_param("ss",$_POST["u"],$_POST["p"]);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows==1){

        $stmt->bind_result($user_id,$username,$password);
        $stmt->fetch();

        $_SESSION["user_id"]=(int)$user_id;
        $_SESSION["username"]=$username;
        $_SESSION["password"]=$password;

        $stmt->close();

        header("Location: profile.php");
        exit;

    }else{

        $stmt->close();

        echo "<script>alert('Invalid Login Details!!!');</script>";
    }
}

$conn->close();

?>

<footer>
<div class="container">

<div class="row">

<div class="col-md-4 footer-left">
<div class="footer-title">📚 Knowledge Hub</div>
<p>Your Digital Library for Smart Learning.</p>
</div>

<div class="col-md-4 footer-middle">
<h5>Learn More</h5>
<p>About us</p>
<p>Facilities</p>
<p>Library Rules</p>
</div>

<div class="col-md-4 footer-right">
<h5>Support</h5>
<p>Help Center</p>
<p>Feedback</p>
<p>User Guide</p>
</div>

</div>

<hr class="footer-line">

<p class="copyright">
© 2026 Knowledge Hub | All Rights Reserved
</p>

</div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
```
