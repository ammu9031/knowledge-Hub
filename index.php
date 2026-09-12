
<?php
ob_start();
session_start();

$conn = new mysqli("127.0.0.1","root","","project_batch");

if($conn->connect_error)
    die("Database connection failed: ".$conn->connect_error);


/* ================= ADMIN LOGIN ================= */

if(isset($_POST["admin_login"])){

    $username = $_POST["admin_username"];
    $password = $_POST["admin_password"];

    $stmt = $conn->prepare(
        "SELECT admin_id, username, password
         FROM admin_info
         WHERE username=?
         LIMIT 1"
    );

    $stmt->bind_param("s",$username);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows == 1){

        $admin = $result->fetch_assoc();

        if($password === $admin["password"]){

            $_SESSION["admin_id"] = $admin["admin_id"];
            $_SESSION["admin_username"] = $admin["username"];

            $stmt->close();
            $conn->close();

            header("Location: admin.php");
            exit;

        }else{

            $admin_error = "Invalid Admin Password";

        }

    }else{

        $admin_error = "Invalid Admin Username";

    }

    $stmt->close();
}


/* ================= USER SIGN UP ================= */

if(isset($_POST["x"])){

    $stmt = $conn->prepare(
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
        $signup_message = "You are registered successfully !!!!";
    }else{
        $signup_message = "Registration failed. Please try again.";
    }

    $stmt->close();
}


/* ================= USER SIGN IN ================= */

if(isset($_POST["y"])){

    $stmt = $conn->prepare(
        "SELECT user_id,uname,pass
         FROM user_info
         WHERE uname=? AND pass=?
         LIMIT 1"
    );

    $stmt->bind_param("ss",$_POST["u"],$_POST["p"]);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows == 1){

        $stmt->bind_result($user_id,$username,$password);
        $stmt->fetch();

        $_SESSION["user_id"] = (int)$user_id;
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;

        $stmt->close();
        $conn->close();

        header("Location: profile.php");
        exit;

    }else{

        $login_error = "Invalid Login Details!!!";

    }

    $stmt->close();
}

$conn->close();
?>

<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<title>Knowledge Hub</title>

<style>

*{
    box-sizing:border-box;
}

html,body{
    margin:0;
    padding:0;
    font-family:Arial,sans-serif;
    color:#333;
    background:#76588f;
}

body{
    overflow-x:hidden;
}


/* ================= NAVBAR ================= */

.navbar{
    background:#a285bc!important;
    padding:15px 50px;
    box-shadow:0 3px 12px rgba(0,0,0,.15);
}

.navbar-brand{
    color:#fff!important;
    font-size:28px;
    font-weight:bold;
    transition:.25s;
}

.navbar-brand:hover{
    color:#f1eafb!important;
    transform:translateY(-1px);
}

.nav-buttons{
    display:flex;
    gap:12px;
}

.nav-btn{
    padding:10px 25px;
    border-radius:7px;
    text-decoration:none!important;
    font-size:17px;
    font-weight:600;
    cursor:pointer;
    transition:.25s ease;
}

.signin-btn,
.signup-btn{
    color:#51406f!important;
    background:#fff;
    border:1px solid #fff;
    box-shadow:0 3px 8px rgba(0,0,0,.12);
}

.signin-btn:hover,
.signup-btn:hover{
    color:#fff!important;
    background:#76588f;
    border-color:#76588f;
    transform:translateY(-2px);
    box-shadow:0 6px 14px rgba(0,0,0,.2);
}


/* ================= HERO ================= */

.hero{
    min-height:700px;
    background:url('img/im1.jpeg') center/cover no-repeat;
    position:relative;
    display:flex;
    align-items:center;
    justify-content:center;
}

.overlay{
    position:absolute;
    inset:0;
    background:rgba(255,255,255,.08);
}


/* ================= HERO CONTENT ================= */

.hero-content{
    position:relative;
    z-index:2;
    width:90%;
    max-width:900px;
    padding:42px 48px 165px;
    text-align:center;
    border-radius:18px;
    background:rgba(255,255,255,.25);
    backdrop-filter:blur(5px);
    -webkit-backdrop-filter:blur(5px);
    border:1px solid rgba(255,255,255,.45);
    box-shadow:0 10px 35px rgba(0,0,0,.12);
}

.welcome{
    display:inline-block;
    padding:9px 20px;
    margin-bottom:18px;
    background:rgba(255,255,255,.92);
    border-radius:20px;
    color:#51406f;
    font-size:18px;
    font-weight:600;
}

.hero-content h1{
    margin:0 0 18px;
    font-size:56px;
    line-height:1.2;
    font-weight:700;
    color:#352a49;
    text-shadow:0 1px 2px #fff;
}

.hero-description{
    max-width:700px;
    margin:0 auto 24px;
    padding:13px 20px;
    background:rgba(255,255,255,.92);
    border-radius:8px;
    color:#39343f;
    font-size:17px;
    line-height:1.75;
}


/* ================= FEATURE BOX ================= */

.features{
    margin-top:30px;
}

.feature-box{
    background:rgba(255,255,255,.94);
    border:1px solid #e1d9eb;
    border-radius:10px;
    padding:27px 24px;
    min-height:160px;
    box-shadow:0 5px 16px rgba(0,0,0,.08);
    transition:.3s ease;
}

.feature-box:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 22px rgba(0,0,0,.16);
    border-color:#cbb9dd;
}

.feature-box h4{
    color:#51406f;
    font-size:20px;
    margin:0 0 11px;
    font-weight:600;
}

.feature-box p{
    color:#55505b;
    margin:0;
    font-size:17px;
    line-height:1.75;
}


/* ================= ADMIN AREA ================= */

.admin-area{
    position:absolute;
    bottom:50px;
    left:50%;
    transform:translateX(-50%);
    z-index:5;
    text-align:center;
    width:100%;
}

.admin-title{
    color:#352a49;
    font-size:18px;
    font-weight:600;
    margin-bottom:6px;
    text-shadow:0 1px 2px #fff;
}

.admin-subtitle{
    color:#40354e;
    font-size:16px;
    margin-bottom:15px;
}

.admin-login-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    min-width:195px;
    padding:12px 26px;
    background:#76588f;
    color:#fff!important;
    border:2px solid #fff;
    border-radius:30px;
    text-decoration:none!important;
    font-size:17px;
    font-weight:600;
    cursor:pointer;
    box-shadow:0 5px 15px rgba(0,0,0,.25);
    transition:.3s ease;
}

.admin-login-btn:hover{
    background:#fff;
    color:#76588f!important;
    border-color:#76588f;
    transform:translateY(-3px);
    box-shadow:0 9px 22px rgba(0,0,0,.25);
}

.admin-arrow{
    font-size:18px;
    transition:.3s ease;
}

.admin-login-btn:hover .admin-arrow{
    transform:translateX(6px);
}


/* ================= MODALS ================= */

.modal-content{
    border:0;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 12px 40px rgba(0,0,0,.25);
}

.modal-header{
    background:#a285bc;
    color:#fff;
    border:0;
    padding:18px 22px;
}

.modal-header .close{
    color:#fff;
    opacity:1;
    font-size:28px;
    transition:.2s;
}

.modal-header .close:hover{
    color:#eee;
    transform:rotate(90deg);
}

.modal-body{
    padding:27px;
}

.form-control{
    height:45px;
    border:1px solid #d8d0e3;
    border-radius:7px;
    transition:.2s;
}

.form-control:focus{
    border-color:#8068a5;
    box-shadow:0 0 0 .15rem rgba(128,104,165,.15);
}

.my-btn{
    background:#8068a5;
    color:#fff;
    border:0;
    padding:12px 15px;
    border-radius:7px;
    font-weight:600;
    transition:.3s ease;
}

.my-btn:hover{
    background:#604675;
    color:#fff;
    transform:translateY(-2px);
    box-shadow:0 6px 15px rgba(96,70,117,.3);
}


/* ================= ADMIN MODAL ================= */

.admin-modal .modal-dialog{
    max-width:430px;
    margin-top:70px;
}

.admin-modal .modal-header{
    background:#76588f;
    padding:20px 25px;
}

.admin-modal .modal-title{
    font-size:22px;
    font-weight:bold;
}

.admin-modal-body{
    padding:28px 30px 30px;
    background:#fff;
}

.admin-icon{
    width:65px;
    height:65px;
    margin:0 auto 15px;
    border-radius:50%;
    background:#eee7f4;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
}

.admin-welcome{
    text-align:center;
    color:#51406f;
    font-size:18px;
    font-weight:bold;
    margin-bottom:5px;
}

.admin-info{
    text-align:center;
    color:#777;
    font-size:14px;
    margin-bottom:22px;
}

.admin-label{
    color:#51406f;
    font-weight:600;
    font-size:15px;
}

.admin-submit{
    background:#76588f;
    color:#fff;
    border:0;
    width:100%;
    padding:13px;
    border-radius:7px;
    font-weight:bold;
    font-size:15px;
    transition:.3s ease;
}

.admin-submit:hover{
    background:#604675;
    color:#fff;
    transform:translateY(-2px);
    box-shadow:0 7px 16px rgba(96,70,117,.3);
}


/* ================= FOOTER ================= */

footer{
    background:#76588f;
    color:#fff;
    padding:30px 0 15px;
    box-shadow:0 -3px 12px rgba(0,0,0,.12);
}

.footer-title{
    color:#fff;
    font-size:22px;
    font-weight:bold;
    margin-bottom:10px;
}

footer h5{
    color:#fff;
    font-size:19px;
    font-weight:bold;
    margin-bottom:12px;
}

footer p{
    color:#e7e1eb;
    font-size:16px;
    line-height:1.7;
    margin-bottom:6px;
}

.footer-left{
    text-align:left;
}

.footer-middle{
    text-align:center;
}

.footer-right{
    text-align:right;
}

.footer-line{
    border:0;
    border-top:1px solid rgba(255,255,255,.25);
    margin:22px 0 14px;
}

.copyright{
    text-align:center;
    color:#e1d9e8;
    font-size:14px;
    margin:0;
}


/* ================= MOBILE ================= */

@media(max-width:767px){

    .navbar{
        padding:13px 18px;
    }

    .navbar-brand{
        font-size:22px;
    }

    .nav-buttons{
        margin-top:12px;
        justify-content:center;
        width:100%;
    }

    .nav-btn{
        padding:9px 20px;
        font-size:16px;
    }

    .hero{
        min-height:780px;
        padding:30px 0;
    }

    .hero-content{
        width:92%;
        padding:25px 18px 160px;
    }

    .welcome{
        font-size:17px;
    }

    .hero-content h1{
        font-size:38px;
    }

    .hero-description{
        font-size:15px;
        line-height:1.7;
    }

    .feature-box{
        margin-bottom:15px;
    }

    .admin-area{
        bottom:70px;
    }

    .admin-title{
        font-size:17px;
    }

    .admin-login-btn{
        min-width:180px;
    }

    footer{
        padding:28px 20px 16px;
    }

    .footer-left,
    .footer-middle,
    .footer-right{
        text-align:center;
        margin-bottom:20px;
    }

    footer p{
        font-size:15px;
    }

}

</style>

</head>

<body>


<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-expand-lg">

    <a class="navbar-brand" href="index.php">
        📚 Knowledge Hub
    </a>

    <div class="ml-auto nav-buttons">

        <a class="nav-btn signin-btn"
           data-toggle="modal"
           data-target="#exampleModal123">
           Sign In
        </a>

        <a class="nav-btn signup-btn"
           data-toggle="modal"
           data-target="#exampleModal">
           Sign Up
        </a>

    </div>

</nav>


<!-- ================= HERO ================= -->

<section class="hero">

    <div class="overlay"></div>

    <div class="hero-content">

        <div class="welcome">
            Welcome To
        </div>

        <h1>
            Knowledge Hub
        </h1>

        <p class="hero-description">
            A smart learning platform that connects you to books,
            resources and knowledge anytime, anywhere.
        </p>

        <div class="container features">

            <div class="row">

                <div class="col-md-4">

                    <div class="feature-box">

                        <h4>📚 Wide Collection</h4>

                        <p>
                            Useful books and learning resources
                            for your studies.
                        </p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="feature-box">

                        <h4>🔐 Secure Platform</h4>

                        <p>
                            Your information stays protected
                            while using the platform.
                        </p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="feature-box">

                        <h4>🕒 Anytime Access</h4>

                        <p>
                            Access your digital library
                            whenever you need it.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= ADMIN LOGIN ================= -->

    <div class="admin-area">

        <div class="admin-title">
            🔐 Library Administration
        </div>

        <div class="admin-subtitle">
            Authorized administrators only
        </div>

        <a href="#"
           class="admin-login-btn"
           data-toggle="modal"
           data-target="#adminModal">

            <span>Admin Login</span>
            <span class="admin-arrow">→</span>

        </a>

    </div>

</section>


<!-- ================= SIGN UP MODAL ================= -->

<div class="modal fade" id="exampleModal" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title">
                    Sign Up
                </h4>

                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    &times;
                </button>

            </div>

            <div class="modal-body">

                <form action="index.php" method="post">

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label>Email</label>

                            <input type="email"
                                   name="e"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="form-group col-md-6">

                            <label>Password</label>

                            <input type="password"
                                   name="p"
                                   class="form-control"
                                   required>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Address</label>

                        <input type="text"
                               name="a"
                               class="form-control"
                               required>

                    </div>

                    <div class="form-group">

                        <label>Username</label>

                        <input type="text"
                               name="u"
                               class="form-control"
                               required>

                    </div>

                    <div class="form-group">

                        <label>Mobile Number</label>

                        <input type="text"
                               name="m"
                               maxlength="10"
                               class="form-control"
                               required>

                    </div>

                    <input type="submit"
                           name="x"
                           value="Sign Up"
                           class="my-btn btn-block">

                </form>

            </div>

        </div>

    </div>

</div>


<!-- ================= SIGN IN MODAL ================= -->

<div class="modal fade" id="exampleModal123" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title">
                    Sign In
                </h4>

                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    &times;
                </button>

            </div>

            <div class="modal-body">

                <form action="index.php" method="post">

                    <div class="form-group">

                        <label>Username</label>

                        <input type="text"
                               name="u"
                               class="form-control"
                               placeholder="Enter Username"
                               required>

                    </div>

                    <div class="form-group">

                        <label>Password</label>

                        <input type="password"
                               name="p"
                               class="form-control"
                               placeholder="Enter Password"
                               required>

                    </div>

                    <input type="submit"
                           name="y"
                           value="Sign In"
                           class="my-btn btn-block">

                </form>

            </div>

        </div>

    </div>

</div>


<!-- ================= ADMIN LOGIN MODAL ================= -->

<div class="modal fade admin-modal"
     id="adminModal"
     tabindex="-1"
     role="dialog"
     aria-labelledby="adminModalLabel"
     aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title"
                    id="adminModalLabel">
                    🔐 Admin Login
                </h4>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">

                    <span aria-hidden="true">
                        &times;
                    </span>

                </button>

            </div>

            <div class="admin-modal-body">

                <div class="admin-icon">
                    🔑
                </div>

                <div class="admin-welcome">
                    Welcome, Administrator
                </div>

                <div class="admin-info">
                    Login to manage Knowledge Hub
                </div>

                <?php if(isset($admin_error)){ ?>

                    <div class="admin-error">
                        <?php echo $admin_error; ?>
                    </div>

                <?php } ?>

                <form action="index.php" method="post">

                    <div class="form-group">

                        <label class="admin-label">
                            Admin Username
                        </label>

                        <input type="text"
                               name="admin_username"
                               class="form-control"
                               placeholder="Enter admin username"
                               required>

                    </div>

                    <div class="form-group">

                        <label class="admin-label">
                            Admin Password
                        </label>

                        <input type="password"
                               name="admin_password"
                               class="form-control"
                               placeholder="Enter admin password"
                               required>

                    </div>

                    <button type="submit"
                            name="admin_login"
                            class="admin-submit">

                        Login to Admin Panel →

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


<!-- ================= FOOTER ================= -->

<footer>

    <div class="container">

        <div class="row">

            <div class="col-md-4 footer-left">

                <div class="footer-title">
                    📚 Knowledge Hub
                </div>

                <p>
                    Your Digital Library for Smart Learning.
                </p>

            </div>

            <div class="col-md-4 footer-middle">

                <h5>
                    Learn More
                </h5>

                <p>About us</p>
                <p>Facilities</p>
                <p>Library Rules</p>

            </div>

            <div class="col-md-4 footer-right">

                <h5>
                    Support
                </h5>

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


<!-- ================= JAVASCRIPT ================= -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


<?php

if(isset($signup_message)){

    echo "<script>
            alert('".$signup_message."');
          </script>";

}

if(isset($login_error)){

    echo "<script>
            alert('".$login_error."');
            $('#exampleModal123').modal('show');
          </script>";

}

if(isset($admin_error)){

    echo "<script>
            $('#adminModal').modal('show');
          </script>";

}

?>

</body>
</html>

