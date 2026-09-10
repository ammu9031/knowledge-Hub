
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

<title>About Us - Knowledge Hub</title>


<style>

/* ================= BODY ================= */

html,body{
    margin:0;
    min-height:100%;
    font-family:Arial,sans-serif;
    background:#eee6f5;
}

/* Background Image */


```css
body{
    margin:0;
    min-height:100vh;
    font-family:Arial, sans-serif;
    position:relative;
    overflow-x:hidden;
    background:#eee6f5;
}

/* Background Image */
body::before{
    content:"";
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;

    background-image:url("img/im1.jpeg");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;

    filter:blur(4px);

    z-index:0;
    transform:scale(1.03);
}

/* White transparent layer */
body::after{
    content:"";
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;

    background:rgba(255,255,255,0.45);

    z-index:1;
    pointer-events:none;
}

/* Page content above background */
body > *{
    position:relative;
    z-index:2;
}




/* ================= KNOWLEDGE HUB TITLE ================= */

.knowledge-title{
    background:#76588f;
    color:white;
    text-align:center;

    font-size:30px;
    font-weight:bold;

    padding:15px 10px;
}


/* ================= NAVBAR ================= */

.navbar{
    background:#a285bc;
    padding:6px 20px;
}

.main-nav{
    display:flex;
    align-items:center;
}

.nav-link{
    color:white !important;

    font-size:19px;
    font-weight:bold;

    padding:8px 14px !important;
}

.nav-link:hover{
    color:white !important;
    background:rgba(255,255,255,0.15);
    border-radius:6px;
}

.nav-link i{
    font-size:20px;
}


/* ================= USER AREA ================= */

.user-area{
    margin-left:auto;
}

.user-link{
    color:white !important;
    text-decoration:none !important;

    font-size:17px;
    font-weight:bold;

    display:flex;
    align-items:center;
    gap:8px;
}

.user-link i{
    font-size:25px;
}


/* ================= RIGHT PROFILE PANEL ================= */

.profile-panel{
    position:fixed;

    top:0;
    right:-360px;

    width:350px;
    height:100vh;

    background:white;

    z-index:1050;

    box-shadow:-5px 0 20px rgba(0,0,0,0.25);

    transition:0.3s;
}

.profile-panel.active{
    right:0;
}


/* PROFILE HEADER */

.profile-header{
    position:relative;

    background:#a285bc;
    color:white;

    padding:18px 20px;

    text-align:center;
}

.profile-header h4{
    margin:0;

    font-size:22px;
}

.profile-header h4 i{
    font-size:25px;
}

.close-btn{
    position:absolute;

    right:18px;
    top:12px;

    font-size:30px;
    cursor:pointer;

    color:white;
}


/* PROFILE MINI HEADER */

.profile-user{
    text-align:center;

    padding:22px 15px;

    border-bottom:1px solid #eeeeee;
}

.profile-user-icon{
    width:65px;
    height:65px;

    margin:0 auto 10px;

    border-radius:50%;

    background:#eee6f5;
    color:#76588f;

    display:flex;
    align-items:center;
    justify-content:center;
}

.profile-user-icon i{
    font-size:34px;
}

.profile-user h5{
    margin:5px 0;

    color:#76588f;

    font-size:20px;
}

.profile-user p{
    margin:0;

    color:#777;

    font-size:14px;
}


/* PROFILE OPTIONS */

.profile-body{
    padding:8px 0;
}

.profile-item{
    display:flex;

    align-items:center;

    text-decoration:none !important;

    color:#444 !important;

    padding:15px 20px;

    border-bottom:1px solid #eeeeee;

    transition:0.2s;
}

.profile-item:hover{
    background:#f1eaf5;
}

.profile-item-icon{
    width:45px;
    height:45px;

    border-radius:50%;

    background:#eee6f5;
    color:#76588f;

    display:flex;
    align-items:center;
    justify-content:center;

    margin-right:14px;
}

.profile-item-icon i{
    font-size:20px;
}

.profile-item strong{
    display:block;

    color:#76588f;

    font-size:16px;
}

.profile-item small{
    color:#777;

    font-size:13px;
}

.profile-line{
    height:8px;
    background:#f5f5f5;
}


/* LOGOUT */

.profile-item.logout strong{
    color:#76588f;
}


/* OVERLAY */

#profileOverlay{
    display:none;

    position:fixed;

    top:0;
    left:0;

    width:100%;
    height:100%;

    background:rgba(0,0,0,0.45);

    z-index:1040;
}

#profileOverlay.active{
    display:block;
}


/* ================= ABOUT ================= */

.about-container{
    max-width:850px;

    margin:50px auto;

    padding:0 20px;
}

.about-box{
    background:rgba(255,255,255,0.96);

    border:2px solid #a285bc;

    border-radius:15px;

    padding:35px 45px;

    box-shadow:0 5px 20px rgba(80,50,100,0.15);

    text-align:center;
}

.about-icon{
    width:70px;
    height:70px;

    margin:0 auto 15px;

    border-radius:50%;

    background:#eee6f5;

    color:#76588f;

    display:flex;
    align-items:center;
    justify-content:center;
}

.about-icon i{
    font-size:35px;
}

.about-box h1{
    color:#76588f;

    font-size:34px;

    font-weight:bold;

    margin-bottom:10px;
}

.line{
    width:100px;
    height:3px;

    background:#a285bc;

    margin:0 auto 25px;
}

.about-box p{
    color:#444;

    font-size:18px;

    line-height:1.7;

    margin-bottom:18px;
}

.about-section{
    background:#f1eaf5;

    border-radius:10px;

    padding:18px 20px;

    margin-top:18px;

    text-align:left;
}

.about-section h4{
    color:#76588f;

    font-size:21px;

    font-weight:bold;

    margin-bottom:8px;
}

.about-section h4 i{
    margin-right:8px;
}

.about-section p{
    margin:0;

    font-size:17px;
}


/* ================= MODAL ================= */

.modal-content{
    border:none;
    border-radius:12px;

    overflow:hidden;
}

.modal-header{
    background:#a285bc;
    color:white;

    border:none;
}

.modal-title{
    font-weight:bold;
}

.modal-header .close{
    color:white;
    opacity:1;
}

.modal-body{
    background:white;
}

.modal-footer{
    background:#fafafa;
}


/* PROFILE MODAL CARD */

.profile-modal-card{
    border:1px solid #ddd;

    border-radius:10px;

    overflow:hidden;
}

.profile-modal-top{
    text-align:center;

    background:#f1eaf5;

    padding:20px;
}

.profile-modal-icon{
    width:65px;
    height:65px;

    margin:0 auto 8px;

    border-radius:50%;

    background:#a285bc;
    color:white;

    display:flex;
    align-items:center;
    justify-content:center;
}

.profile-modal-icon i{
    font-size:30px;
}

.profile-modal-top h4{
    color:#76588f;

    margin:5px 0;

    font-size:22px;
}

.profile-modal-top p{
    color:#777;

    margin:0;

    font-size:14px;
}

.profile-info{
    padding:5px 15px;
}

.info-row{
    display:flex;

    align-items:center;

    padding:13px 5px;

    border-bottom:1px solid #eeeeee;
}

.info-row:last-child{
    border-bottom:none;
}

.info-row > i{
    width:42px;

    color:#76588f;

    font-size:20px;
}

.info-row span{
    display:block;

    color:#777;

    font-size:13px;
}

.info-row strong{
    color:#333;

    font-size:16px;

    word-break:break-word;
}


/* ================= EDIT FORM ================= */

.form-group label{
    color:#76588f;

    font-weight:bold;
}

.form-control{
    border:1px solid #c9b5d8;
}

.form-control:focus{
    border-color:#a285bc;

    box-shadow:0 0 0 0.2rem rgba(162,133,188,0.20);
}

.btn-purple{
    background:#a285bc;

    color:white;

    border:none;
}

.btn-purple:hover{
    background:#76588f;

    color:white;
}


/* ================= FOOTER ================= */

.footer{
    background:#a285bc;

    color:white;

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:15px 25px;

    margin-top:40px;

    font-size:14px;
}

.footer-left{
    font-size:17px;
    font-weight:bold;
}

.footer-center{
    text-align:center;
}

.footer-right{
    text-align:right;
}


/* ================= MOBILE ================= */

@media(max-width:768px){

    .knowledge-title{
        font-size:25px;
    }

    .navbar{
        padding:10px;
    }

    .nav-link{
        font-size:14px;

        padding:7px !important;
    }

    .user-link{
        font-size:14px;
    }

    .user-link i{
        font-size:22px;
    }

    .about-container{
        margin:30px auto;
    }

    .about-box{
        padding:25px 20px;
    }

    .about-box h1{
        font-size:28px;
    }

    .about-box p{
        font-size:17px;
    }

    .profile-panel{
        width:320px;
    }

    .footer{
        flex-direction:column;

        gap:8px;

        text-align:center;
    }

    .footer-right{
        text-align:center;
    }

}

</style>

</head>


<body>


<?php

/* =========================
   DATABASE CONNECTION
   ========================= */

$conn = new mysqli(
    "127.0.0.1",
    "root",
    "",
    "project_batch"
);

if($conn->connect_error)
{
    die("Database connection failed: ".$conn->connect_error);
}


/* =========================
   GET LOGGED-IN USER ID
   ========================= */

$user_id = isset($_SESSION["user_id"])
           ? (int)$_SESSION["user_id"]
           : 0;


/*
   OLD SESSION FALLBACK
   If user_id is not available,
   find it using username + password.
*/

if($user_id <= 0 && !empty($_SESSION["username"]))
{

    $sessionUsername = $_SESSION["username"];

    $sessionPassword = $_SESSION["password"] ?? "";


    if($sessionPassword !== "")
    {

        $stmtUser = $conn->prepare(
            "SELECT user_id
             FROM user_info
             WHERE uname=? AND pass=?
             LIMIT 1"
        );

        if($stmtUser)
        {
            $stmtUser->bind_param(
                "ss",
                $sessionUsername,
                $sessionPassword
            );
        }

    }
    else
    {

        $stmtUser = $conn->prepare(
            "SELECT user_id
             FROM user_info
             WHERE uname=?
             LIMIT 1"
        );

        if($stmtUser)
        {
            $stmtUser->bind_param(
                "s",
                $sessionUsername
            );
        }

    }


    if(isset($stmtUser) && $stmtUser)
    {

        $stmtUser->execute();

        $stmtUser->bind_result(
            $found_user_id
        );


        if($stmtUser->fetch())
        {

            $user_id = (int)$found_user_id;

            $_SESSION["user_id"] = $user_id;

        }


        $stmtUser->close();

    }

}


/* =========================
   GET COMPLETE USER DATA
   ========================= */

$profile = null;


if($user_id > 0)
{

    $stmtProfile = $conn->prepare(
        "SELECT user_id,
                email,
                pass,
                address,
                uname,
                mobile
         FROM user_info
         WHERE user_id=?
         LIMIT 1"
    );


    if($stmtProfile)
    {

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


        if($stmtProfile->fetch())
        {

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


<!-- LEFT NAVIGATION -->

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



<!-- USER RIGHT SIDE -->

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
<!-- RIGHT SIDE PROFILE PANEL -->
<!-- ========================= -->

<div id="profilePanel"
class="profile-panel">


<!-- PROFILE HEADER -->

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



<!-- PROFILE MINI HEADER -->

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


<!-- SEE YOUR PROFILE -->

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



<!-- EDIT PROFILE -->

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



<!-- CONTACT -->

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



<!-- LOGOUT -->

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



<!-- DARK OVERLAY -->

<div id="profileOverlay"
onclick="closeProfile()">
</div>



<!-- ========================= -->
<!-- ABOUT US CONTENT -->
<!-- ========================= -->

<div class="about-container">


<div class="about-box">


<div class="about-icon">

<i class="fa fa-info-circle"></i>

</div>


<h1>
About Knowledge Hub
</h1>


<div class="line"></div>


<p>
Knowledge Hub is a simple digital learning platform
created to help students explore useful educational
resources in one convenient place.
</p>


<p>
Our aim is to make learning easier, organized and
accessible through a simple and user-friendly
digital library.
</p>


<div class="about-section">


<h4>

<i class="fa fa-book"></i>

Our Purpose

</h4>


<p>

To provide students with a convenient digital space
to explore libraries, learning resources and useful
information.

</p>


</div>



<div class="about-section">


<h4>

<i class="fa fa-users"></i>

For Students

</h4>


<p>

Knowledge Hub is designed for students who want an
easy and comfortable way to access learning
information.

</p>


</div>


</div>

</div>



<!-- ================================================= -->
<!-- SEE YOUR PROFILE MODAL -->
<!-- ================================================= -->

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

<span>&times;</span>

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


<!-- USER ID -->

<div class="info-row">

<i class="fa fa-id-card"></i>

<div>

<span>
User ID
</span>

<strong>

<?php

echo htmlspecialchars(
    $profile["user_id"]
);

?>

</strong>

</div>

</div>



<!-- USERNAME -->

<div class="info-row">

<i class="fa fa-user"></i>

<div>

<span>
Username
</span>

<strong>

<?php

echo htmlspecialchars(
    $profile["uname"]
);

?>

</strong>

</div>

</div>



<!-- EMAIL -->

<div class="info-row">

<i class="fa fa-envelope"></i>

<div>

<span>
Email
</span>

<strong>

<?php

echo htmlspecialchars(
    $profile["email"]
);

?>

</strong>

</div>

</div>



<!-- PASSWORD -->

<div class="info-row">

<i class="fa fa-lock"></i>

<div>

<span>
Password
</span>

<strong>

<?php

echo htmlspecialchars(
    $profile["pass"]
);

?>

</strong>

</div>

</div>



<!-- ADDRESS -->

<div class="info-row">

<i class="fa fa-map-marker"></i>

<div>

<span>
Address
</span>

<strong>

<?php

echo htmlspecialchars(
    $profile["address"]
);

?>

</strong>

</div>

</div>



<!-- MOBILE -->

<div class="info-row">

<i class="fa fa-phone"></i>

<div>

<span>
Mobile No
</span>

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


<?php } else { ?>


<div class="alert alert-warning">

User profile not found.

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



<!-- ================================================= -->
<!-- EDIT PROFILE MODAL -->
<!-- ================================================= -->

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

<span>&times;</span>

</button>


</div>



<div class="modal-body">


<form action="library.php"
method="post">


<?php if($profile) { ?>


<!-- USER ID -->

<div class="form-group">

<label>
User ID
</label>


<input type="text"
class="form-control"
value="<?php echo htmlspecialchars($profile["user_id"]); ?>"
readonly>

</div>



<!-- EMAIL -->

<div class="form-group">

<label>
Email address
</label>


<input type="email"
name="e"
value="<?php echo htmlspecialchars($profile["email"]); ?>"
class="form-control"
required>

</div>



<!-- PASSWORD -->

<div class="form-group">

<label>
Password
</label>


<input type="text"
name="p"
value="<?php echo htmlspecialchars($profile["pass"]); ?>"
class="form-control"
required>

</div>



<!-- ADDRESS -->

<div class="form-group">

<label>
Address
</label>


<input type="text"
name="a"
value="<?php echo htmlspecialchars($profile["address"]); ?>"
class="form-control"
required>

</div>



<!-- USERNAME -->

<div class="form-group">

<label>
Username
</label>


<input type="text"
name="un"
value="<?php echo htmlspecialchars($profile["uname"]); ?>"
class="form-control"
required>

</div>



<!-- MOBILE -->

<div class="form-group">

<label>
Mobile No
</label>


<input type="text"
name="m"
value="<?php echo htmlspecialchars($profile["mobile"]); ?>"
class="form-control"
required>

</div>



<!-- UPDATE BUTTON -->

<input type="submit"
class="btn btn-purple"
value="Update Profile"
name="ep">


<?php } else { ?>


<div class="alert alert-warning">

User profile not found.

</div>


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



<!-- ================================================= -->
<!-- CONTACT MODAL -->
<!-- ================================================= -->

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

<span>&times;</span>

</button>


</div>



<div class="modal-body">


<div class="text-center p-3">


<i class="fa fa-building"
style="font-size:50px;color:#76588f;">
</i>


<h4 class="mt-3"
style="color:#76588f;">

Knowledge Hub

</h4>


<p>

For library related information and assistance,
please contact the Knowledge Hub.

</p>


<p>

<i class="fa fa-phone"
style="color:#76588f;">
</i>

&nbsp; Contact: Knowledge Hub

</p>


<p>

<i class="fa fa-envelope"
style="color:#76588f;">
</i>

&nbsp; Email: knowledgehub@gmail.com

</p>


<p>

<i class="fa fa-clock-o"
style="color:#76588f;">
</i>

&nbsp; Available: Monday - Saturday

</p>


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



<!-- ========================= -->
<!-- JAVASCRIPT -->
<!-- ========================= -->

<script>

function openProfile()
{
    document
    .getElementById("profilePanel")
    .classList.add("active");

    document
    .getElementById("profileOverlay")
    .classList.add("active");
}


function closeProfile()
{
    document
    .getElementById("profilePanel")
    .classList.remove("active");

    document
    .getElementById("profileOverlay")
    .classList.remove("active");
}

</script>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
