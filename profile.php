
<?php ob_start(); ?>
<?php session_start(); ?>

<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>Knowledge Hub</title>

</head>

<body>

<?php

$conn = new mysqli("127.0.0.1", "root", "", "project_batch");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}


/* USER ID */

$user_id = isset($_SESSION["user_id"])
    ? (int)$_SESSION["user_id"]
    : 0;


/* OLD SESSION FALLBACK */

if ($user_id <= 0 && !empty($_SESSION["username"])) {

    $sessionUsername = $_SESSION["username"];
    $sessionPassword = $_SESSION["password"] ?? "";

    if ($sessionPassword !== "") {

        $stmtUser = $conn->prepare(
            "SELECT user_id
             FROM user_info
             WHERE uname=? AND pass=?
             LIMIT 1"
        );

        if ($stmtUser) {
            $stmtUser->bind_param(
                "ss",
                $sessionUsername,
                $sessionPassword
            );
        }

    } else {

        $stmtUser = $conn->prepare(
            "SELECT user_id
             FROM user_info
             WHERE uname=?
             LIMIT 1"
        );

        if ($stmtUser) {
            $stmtUser->bind_param(
                "s",
                $sessionUsername
            );
        }
    }

    if (isset($stmtUser) && $stmtUser) {

        $stmtUser->execute();

        $stmtUser->bind_result($found_user_id);

        if ($stmtUser->fetch()) {

            $user_id = (int)$found_user_id;

            $_SESSION["user_id"] = $user_id;
        }

        $stmtUser->close();
    }
}


/* PROFILE DATA */

$profile = null;

if ($user_id > 0) {

    $stmtProfile = $conn->prepare(
        "SELECT user_id, email, pass, address, uname, mobile
         FROM user_info
         WHERE user_id=?
         LIMIT 1"
    );

    if ($stmtProfile) {

        $stmtProfile->bind_param(
            "i",
            $user_id
        );

        $stmtProfile->execute();

        $stmtProfile->bind_result(
            $db_user_id,
            $db_email,
            $db_pass,
            $db_address,
            $db_uname,
            $db_mobile
        );

        if ($stmtProfile->fetch()) {

            $profile = [

                "user_id" => $db_user_id,

                "email" => $db_email,

                "pass" => $db_pass,

                "address" => $db_address,

                "uname" => $db_uname,

                "mobile" => $db_mobile

            ];
        }

        $stmtProfile->close();
    }
}

?>



<!-- ========================= -->
<!-- KNOWLEDGE HUB TITLE -->
<!-- ========================= -->

<div class="knowledge-title">

📚 Knowledge Hub

</div>



<!-- ========================= -->
<!-- NAVBAR -->
<!-- ========================= -->

<nav class="navbar navbar-expand-lg">

<div class="container-fluid">


<div class="main-nav">

<a class="nav-link"
href="profile.php">

<i class="fa fa-home"></i>
&nbsp; Home

</a>


<a class="nav-link"
href="library.php">

<i class="fa fa-building"></i>
&nbsp; Library

</a>


<a class="nav-link"
href="about us.php">

<i class="fa fa-info-circle"></i>
&nbsp; About Us

</a>

</div>



<!-- USER -->

<div class="user-area">

<a href="#"
class="user-link"
onclick="openProfile(); return false;">

<i class="fa fa-user-circle"></i>

<span>

<?php

echo htmlspecialchars(
    $_SESSION["username"] ?? "guest"
);

?>

</span>

</a>

</div>

</div>

</nav>



<!-- ========================= -->
<!-- PROFILE SIDE PANEL -->
<!-- ========================= -->

<div id="profilePanel"
class="profile-panel">


<div class="profile-header">

<h4>

<i class="fa fa-user-circle"></i>

&nbsp; My Profile

</h4>


<span class="close-btn"
onclick="closeProfile()">

&times;

</span>

</div>



<!-- MINI PROFILE -->

<div class="profile-user">

<div class="profile-user-icon">

<i class="fa fa-user"></i>

</div>


<h5>

<?php

echo htmlspecialchars(
    $_SESSION["username"] ?? "guest"
);

?>

</h5>


<p>

Knowledge Hub User

</p>

</div>



<!-- PROFILE OPTIONS -->

<div class="profile-body">


<a href="#"
class="profile-item"
data-toggle="modal"
data-target="#profileModal"
onclick="closeProfile()">

<div class="profile-item-icon">

<i class="fa fa-user"></i>

</div>

<div>

<strong>
See Your Profile
</strong>

<small>
View your profile information
</small>

</div>

</a>



<a href="#"
class="profile-item"
data-toggle="modal"
data-target="#editProfileModal"
onclick="closeProfile()">

<div class="profile-item-icon">

<i class="fa fa-edit"></i>

</div>

<div>

<strong>
Edit Profile
</strong>

<small>
Update your profile details
</small>

</div>

</a>



<a href="#"
class="profile-item"
data-toggle="modal"
data-target="#contactModal"
onclick="closeProfile()">

<div class="profile-item-icon">

<i class="fa fa-phone"></i>

</div>

<div>

<strong>
Contact
</strong>

<small>
Contact Knowledge Hub
</small>

</div>

</a>



<div class="profile-line"></div>



<a href="index.php?logout=1"
class="profile-item logout">

<div class="profile-item-icon">

<i class="fa fa-sign-out"></i>

</div>

<div>

<strong>
Logout
</strong>

<small>
Sign out of your account
</small>

</div>

</a>


</div>

</div>



<!-- OVERLAY -->

<div id="profileOverlay"
onclick="closeProfile()">
</div>



<!-- ========================= -->
<!-- CENTER CONTENT -->
<!-- ========================= -->

<div class="welcome-content">


<div class="welcome-card">


<div class="welcome-icon">

<i class="fa fa-user"></i>

</div>


<h1>

Welcome,
<?php

echo htmlspecialchars(
    $_SESSION["username"] ?? "Guest"
);

?>

! 👋

</h1>


<p class="learning-text">

Your Personal Learning Space

</p>


<div class="small-line"></div>


<p class="short-text">

Welcome to Knowledge Hub.<br>

We hope you have a great learning experience with us.

</p>


<div class="welcome-info">


<div>

<i class="fa fa-book"></i>

<span>
Explore Library
</span>

</div>


<div>

<i class="fa fa-graduation-cap"></i>

<span>
Learn & Grow
</span>

</div>


<div>

<i class="fa fa-user"></i>

<span>
Your Profile
</span>

</div>


</div>


</div>


</div>



<!-- ========================= -->
<!-- PROFILE MODAL -->
<!-- ========================= -->

<div class="modal fade"
id="profileModal"
tabindex="-1"
aria-hidden="true">


<div class="modal-dialog modal-dialog-centered">


<div class="modal-content">


<div class="modal-header">

<h5 class="modal-title">

<i class="fa fa-user-circle"></i>

&nbsp; My Profile

</h5>


<button type="button"
class="close"
data-dismiss="modal">

<span>

&times;

</span>

</button>

</div>



<div class="modal-body">


<?php if($profile) { ?>


<div class="profile-modal-card">


<div class="profile-modal-top">

<div class="profile-modal-icon">

<i class="fa fa-user"></i>

</div>


<h4>

<?php

echo htmlspecialchars(
    $profile["uname"]
);

?>

</h4>


<p>
Knowledge Hub User
</p>

</div>



<div class="profile-info">


<div class="info-row">

<i class="fa fa-user"></i>

<div>

<span>Username</span>

<strong>

<?php

echo htmlspecialchars(
    $profile["uname"]
);

?>

</strong>

</div>

</div>



<div class="info-row">

<i class="fa fa-envelope"></i>

<div>

<span>Email</span>

<strong>

<?php

echo htmlspecialchars(
    $profile["email"]
);

?>

</strong>

</div>

</div>



<div class="info-row">

<i class="fa fa-map-marker"></i>

<div>

<span>Address</span>

<strong>

<?php

echo htmlspecialchars(
    $profile["address"]
);

?>

</strong>

</div>

</div>



<div class="info-row">

<i class="fa fa-phone"></i>

<div>

<span>Mobile No</span>

<strong>

<?php

echo htmlspecialchars(
    $profile["mobile"]
);

?>

</strong>

</div>

</div>


</div>

</div>


<?php } ?>


</div>



<div class="modal-footer">

<button type="button"
class="btn btn-secondary"
data-dismiss="modal">

Close

</button>

</div>


</div>

</div>

</div>



<!-- ========================= -->
<!-- EDIT PROFILE MODAL -->
<!-- ========================= -->

<div class="modal fade"
id="editProfileModal"
tabindex="-1"
aria-hidden="true">


<div class="modal-dialog modal-dialog-centered">


<div class="modal-content">


<div class="modal-header">

<h5 class="modal-title">

<i class="fa fa-edit"></i>

&nbsp; Edit Profile

</h5>


<button type="button"
class="close"
data-dismiss="modal">

<span>

&times;

</span>

</button>

</div>



<div class="modal-body">


<form action="profile.php"
method="post">


<?php if($profile) { ?>


<div class="form-group">

<label>
Email address
</label>

<input type="email"
name="e"
value="<?php echo htmlspecialchars($profile["email"]); ?>"
class="form-control">

</div>



<div class="form-group">

<label>
Password
</label>

<input type="text"
name="p"
value="<?php echo htmlspecialchars($profile["pass"]); ?>"
class="form-control">

</div>



<div class="form-group">

<label>
Address
</label>

<input type="text"
name="a"
value="<?php echo htmlspecialchars($profile["address"]); ?>"
class="form-control">

</div>



<div class="form-group">

<label>
Username
</label>

<input type="text"
name="un"
value="<?php echo htmlspecialchars($profile["uname"]); ?>"
class="form-control">

</div>



<div class="form-group">

<label>
Mobile No
</label>

<input type="text"
name="m"
value="<?php echo htmlspecialchars($profile["mobile"]); ?>"
class="form-control">

</div>



<input type="submit"
class="btn btn-primary"
value="Update Profile"
name="ep">


<?php } ?>


</form>

</div>



<div class="modal-footer">

<button type="button"
class="btn btn-secondary"
data-dismiss="modal">

Close

</button>

</div>


</div>

</div>

</div>



<!-- ========================= -->
<!-- CONTACT MODAL -->
<!-- ========================= -->

<div class="modal fade"
id="contactModal"
tabindex="-1"
aria-hidden="true">


<div class="modal-dialog modal-dialog-centered">


<div class="modal-content">


<div class="modal-header">

<h5 class="modal-title">

<i class="fa fa-phone"></i>

&nbsp; Contact

</h5>


<button type="button"
class="close"
data-dismiss="modal">

<span>

&times;

</span>

</button>

</div>



<div class="modal-body">


<div class="contact-card">


<div class="contact-icon">

<i class="fa fa-building"></i>

</div>


<h4>
Knowledge Hub
</h4>


<p>

For library related information and assistance,
please contact the Knowledge Hub.

</p>


<div class="contact-info">


<div>

<i class="fa fa-phone"></i>

<span>
Contact: Knowledge Hub
</span>

</div>


<div>

<i class="fa fa-envelope"></i>

<span>
Email: knowledgehub@gmail.com
</span>

</div>


<div>

<i class="fa fa-clock-o"></i>

<span>
Available: Monday - Saturday
</span>

</div>


</div>

</div>

</div>



<div class="modal-footer">

<button type="button"
class="btn btn-secondary"
data-dismiss="modal">

Close

</button>

</div>


</div>

</div>

</div>



<style>

/* ========================= */
/* BODY */
/* ========================= */

html,
body {

margin:0;

min-height:100%;

height:100%;

font-family:Arial, sans-serif;

}


/*
   Background image ko alag layer me rakha gaya hai.
   Isse sirf image blur hogi,
   text/navbar blur nahi honge.
*/

body {

position:relative;

display:flex;

flex-direction:column;

background:#eee6f5;

}


body::before {

content:"";

position:fixed;

top:-8px;

left:-8px;

right:-8px;

bottom:-8px;

z-index:-2;

background-image:url("img/im1.jpeg");

background-size:cover;

background-position:center;

background-repeat:no-repeat;

filter:blur(3px);

transform:scale(1.02);

}


/* LIGHT OVERLAY */

body::after {

content:"";

position:fixed;

top:0;

left:0;

right:0;

bottom:0;

z-index:-1;

background:rgba(255,255,255,0.20);

pointer-events:none;

}



/* ========================= */
/* KNOWLEDGE HUB TITLE */
/* ========================= */

.knowledge-title {

text-align:center;

font-size:30px;

font-weight:bold;

color:white;

background:#76588f;

padding:20px 10px 13px;

text-shadow:0 2px 4px rgba(0,0,0,0.20);

}



/* ========================= */
/* NAVBAR */
/* ========================= */

.navbar {

background:#a285bc !important;

min-height:65px;

padding:8px 30px;

box-shadow:0 3px 12px rgba(60,40,75,.22);

}


.navbar .container-fluid {

width:100%;

display:flex;

align-items:center;

position:relative;

}



/* NAVIGATION */

.main-nav {

display:flex;

align-items:center;

gap:8px;

margin-left:-45px;

}


.main-nav .nav-link {

color:white !important;

font-size:17px;

font-weight:600;

padding:10px 17px;

border-radius:8px;

text-decoration:none;

transition:0.3s;

}


.main-nav .nav-link:hover {

background:rgba(255,255,255,0.20);

color:white !important;

text-decoration:none;

}



/* USER */

.user-area {

position:absolute;

right:25px;

top:50%;

transform:translateY(-50%);

}


.user-link {

display:flex;

align-items:center;

gap:9px;

color:white !important;

font-size:17px;

font-weight:600;

padding:8px 12px;

border-radius:9px;

text-decoration:none;

transition:0.3s;

}


.user-link:hover {

background:rgba(255,255,255,0.20);

color:white !important;

text-decoration:none;

}


.user-link .fa-user-circle {

font-size:34px;

color:white;

}



/* ========================= */
/* PROFILE SIDE PANEL */
/* ========================= */

.profile-panel {

position:fixed;

top:0;

right:-370px;

width:370px;

height:100vh;

background:white;

z-index:1055;

box-shadow:-8px 0 25px rgba(0,0,0,0.25);

transition:right 0.35s ease;

}


.profile-panel.active {

right:0;

}



/* HEADER */

.profile-header {

height:88px;

background:#a285bc;

color:white;

display:flex;

align-items:center;

justify-content:space-between;

padding:0 25px;

}


.profile-header h4 {

margin:0;

font-size:22px;

font-weight:bold;

}


.profile-header h4 i {

font-size:25px;

}


.close-btn {

font-size:36px;

font-weight:300;

cursor:pointer;

line-height:1;

}



/* MINI PROFILE */

.profile-user {

text-align:center;

padding:25px 15px 22px;

border-bottom:1px solid #ddd2e5;

}


.profile-user-icon {

width:72px;

height:72px;

margin:auto;

border-radius:50%;

background:#eee6f5;

display:flex;

align-items:center;

justify-content:center;

}


.profile-user-icon i {

font-size:36px;

color:#76588f;

}


.profile-user h5 {

margin:12px 0 3px;

font-size:20px;

font-weight:bold;

color:#4f4058;

}


.profile-user p {

margin:0;

font-size:13px;

color:#777;

}



/* PROFILE BODY */

.profile-body {

padding:18px;

}


.profile-item {

display:flex;

align-items:center;

gap:13px;

padding:14px 13px;

margin-bottom:7px;

border-radius:10px;

color:#55505a;

font-size:16px;

font-weight:500;

text-decoration:none;

transition:0.3s;

}


.profile-item:hover {

background:#f1eaf5;

color:#76588f;

text-decoration:none;

}


.profile-item-icon {

width:42px;

height:42px;

border-radius:8px;

background:#eee6f5;

display:flex;

align-items:center;

justify-content:center;

flex-shrink:0;

}


.profile-item-icon i {

font-size:19px;

color:#76588f;

}


.profile-item strong {

display:block;

font-size:16px;

font-weight:600;

}


.profile-item small {

display:block;

font-size:12px;

color:#888;

margin-top:2px;

}


.profile-line {

height:1px;

background:#ddd2e5;

margin:18px 5px;

}



/* LOGOUT */

.profile-item.logout {

color:#a85b5b;

}


.profile-item.logout .profile-item-icon {

background:#f8eeee;

}


.profile-item.logout .profile-item-icon i {

color:#a85b5b;

}


.profile-item.logout:hover {

background:#faf1f1;

color:#974848;

}



/* OVERLAY */

#profileOverlay {

display:none;

position:fixed;

top:0;

left:0;

width:100%;

height:100%;

background:rgba(35,20,45,0.30);

z-index:1050;

}


#profileOverlay.active {

display:block;

}



/* ========================= */
/* WELCOME CONTENT */
/* ========================= */

.welcome-content {

flex:1;

display:flex;

justify-content:center;

align-items:center;

text-align:center;

padding:55px 20px;

}


.welcome-card {

max-width:650px;

padding:38px 50px;

border-radius:20px;

background:rgba(255,255,255,0.72);

border:1px solid rgba(255,255,255,0.70);

box-shadow:0 10px 35px rgba(50,30,65,0.18);

backdrop-filter:blur(3px);

-webkit-backdrop-filter:blur(3px);

}


.welcome-icon {

width:70px;

height:70px;

margin:0 auto 17px;

border-radius:50%;

background:#a285bc;

display:flex;

align-items:center;

justify-content:center;

box-shadow:0 5px 15px rgba(80,50,100,0.20);

}


.welcome-icon i {

font-size:31px;

color:white;

}


.welcome-content h1 {

font-size:34px;

font-weight:bold;

margin-bottom:8px;

color:#76588f;

}


.learning-text {

font-size:19px;

font-weight:600;

color:#4f4058;

margin-bottom:10px;

}


.small-line {

width:65px;

height:4px;

background:#a285bc;

margin:15px auto;

border-radius:5px;

}


.short-text {

font-size:16px;

line-height:1.6;

color:#51495a;

margin-bottom:25px;

}



/* SMALL INFO */

.welcome-info {

display:flex;

justify-content:center;

gap:25px;

padding-top:15px;

border-top:1px solid rgba(118,88,143,0.20);

}


.welcome-info div {

display:flex;

flex-direction:column;

align-items:center;

gap:6px;

font-size:13px;

font-weight:600;

color:#51495a;

}


.welcome-info i {

font-size:21px;

color:#76588f;

}



/* ========================= */
/* MODAL */
/* ========================= */

.modal-content {

border:none;

border-radius:12px;

overflow:hidden;

box-shadow:0 8px 30px rgba(0,0,0,0.25);

}


.modal-header {

background:#a285bc;

color:white;

border:none;

padding:17px 20px;

}


.modal-title {

font-size:20px;

font-weight:bold;

}


.modal-header .close {

color:white;

opacity:1;

text-shadow:none;

}


.modal-body {

background:#f4eff7;

padding:22px;

}


.modal-footer {

background:#eee6f5;

border-top:1px solid #ddd2e5;

}



/* PROFILE CARD */

.profile-modal-card {

background:white;

border-radius:12px;

overflow:hidden;

border:1px solid #d9cce2;

}


.profile-modal-top {

text-align:center;

background:#eee6f5;

padding:25px 15px 20px;

}


.profile-modal-icon {

width:70px;

height:70px;

border-radius:50%;

background:#dfd1e8;

display:flex;

align-items:center;

justify-content:center;

margin:0 auto 10px;

}


.profile-modal-icon i {

font-size:35px;

color:#76588f;

}


.profile-modal-top h4 {

margin:5px 0;

font-size:21px;

font-weight:bold;

color:#4f4058;

}


.profile-modal-top p {

margin:0;

font-size:13px;

color:#777;

}



/* PROFILE INFO */

.profile-info {

padding:8px 20px;

}


.info-row {

display:flex;

align-items:center;

padding:14px 0;

border-bottom:1px solid #eeeeee;

}


.info-row:last-child {

border-bottom:none;

}


.info-row > i {

width:40px;

height:40px;

border-radius:8px;

background:#eee6f5;

display:flex;

align-items:center;

justify-content:center;

color:#76588f;

font-size:18px;

margin-right:13px;

}


.info-row span {

display:block;

font-size:12px;

color:#888;

}


.info-row strong {

display:block;

font-size:15px;

color:#333;

font-weight:600;

}



/* EDIT PROFILE */

.modal-body label {

font-weight:600;

color:#4f4058;

}


.modal-body .form-control {

border:1px solid #cfc1d8;

border-radius:7px;

background:white;

color:#333;

}


.modal-body .form-control:focus {

border-color:#a285bc;

box-shadow:0 0 0 2px rgba(162,133,188,0.15);

}



/* BUTTONS */

.modal .btn-primary,
.modal .btn-secondary {

background:#a285bc;

border-color:#a285bc;

color:white;

}


.modal .btn-primary:hover,
.modal .btn-secondary:hover {

background:#76588f;

border-color:#76588f;

color:white;

}



/* ========================= */
/* CONTACT */
/* ========================= */

.contact-card {

background:white;

border:1px solid #d9cce2;

border-radius:12px;

text-align:center;

padding:25px 20px;

}


.contact-icon {

width:65px;

height:65px;

border-radius:50%;

background:#eee6f5;

display:flex;

align-items:center;

justify-content:center;

margin:0 auto 12px;

}


.contact-icon i {

font-size:30px;

color:#76588f;

}


.contact-card h4 {

font-size:21px;

font-weight:bold;

color:#4f4058;

margin-bottom:8px;

}


.contact-card p {

font-size:14px;

color:#666;

line-height:1.6;

}


.contact-info {

margin-top:18px;

text-align:left;

border-top:1px solid #eeeeee;

padding-top:12px;

}


.contact-info div {

padding:9px 0;

color:#555;

font-size:14px;

}


.contact-info i {

width:30px;

color:#76588f;

}



/* ========================= */
/* FOOTER */
/* ========================= */

.footer {

background:#a285bc;

color:white;

padding:22px 30px;

display:flex;

align-items:center;

justify-content:space-between;

}


.footer-left {

text-align:left;

font-size:18px;

font-weight:bold;

}


.footer-center {

text-align:center;

font-size:13px;

}


.footer-right {

text-align:right;

font-size:14px;

}



/* ========================= */
/* MOBILE */
/* ========================= */

@media(max-width:768px) {

.knowledge-title {

font-size:25px;

}


.navbar {

padding:7px 10px;

}


.main-nav {

gap:2px;

}


.main-nav .nav-link {

font-size:14px;

padding:8px 7px;

}


.user-area {

right:8px;

}


.user-link span {

display:none;

}


.user-link .fa-user-circle {

font-size:31px;

}


.profile-panel {

width:320px;

}


.welcome-content {

padding:35px 15px;

}


.welcome-card {

padding:30px 20px;

}


.welcome-content h1 {

font-size:25px;

}


.learning-text {

font-size:16px;

}


.short-text {

font-size:14px;

}


.welcome-info {

gap:14px;

}


.footer {

padding:18px 10px;

}


.footer-left {

font-size:14px;

}


.footer-center {

font-size:11px;

}


.footer-right {

font-size:11px;

}

}

</style>



<script>

function openProfile()
{

document.getElementById("profilePanel")
.classList.add("active");

document.getElementById("profileOverlay")
.classList.add("active");

}


function closeProfile()
{

document.getElementById("profilePanel")
.classList.remove("active");

document.getElementById("profileOverlay")
.classList.remove("active");

}

</script>



<!-- ========================= -->
<!-- FOOTER -->
<!-- ========================= -->

<footer class="footer">

<div class="footer-left">

📚 Knowledge Hub

</div>


<div class="footer-center">

© 2026 Knowledge Hub. All Rights Reserved.

</div>


<div class="footer-right">

Digital Library & Learning Space

</div>

</footer>



<!-- BOOTSTRAP JS -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js">
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>
