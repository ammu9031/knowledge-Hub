<?php
ob_start();
session_start();

$conn = new mysqli("127.0.0.1","root","","project_batch");
if($conn->connect_error) die("Database Connection Failed");

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0",false);
header("Pragma: no-cache");
header("Expires: 0");
$user_id = isset($_SESSION["user_id"]) ? (int)$_SESSION["user_id"] : 0;
/* OLD SESSION FALLBACK */
if($user_id<=0 && !empty($_SESSION["username"])){
    $u=$_SESSION["username"];
    $p=$_SESSION["password"]??"";

    if($p!==""){
        $stmt=$conn->prepare("SELECT user_id FROM user_info WHERE uname=? AND pass=? LIMIT 1");
        if($stmt) $stmt->bind_param("ss",$u,$p);
    }else{
        $stmt=$conn->prepare("SELECT user_id FROM user_info WHERE uname=? LIMIT 1");
        if($stmt) $stmt->bind_param("s",$u);
    }

    if(isset($stmt) && $stmt){
        $stmt->execute();
        $stmt->bind_result($found);
        if($stmt->fetch()){
            $user_id=(int)$found;
            $_SESSION["user_id"]=$user_id;
        }
        $stmt->close();
    }
}

/* UPDATE PROFILE */
if(isset($_POST["update_profile"])){
    $email=trim($_POST["e"]??"");
    $password=trim($_POST["p"]??"");
    $address=trim($_POST["a"]??"");
    $username=trim($_POST["un"]??"");
    $mobile=trim($_POST["m"]??"");

    if($user_id>0){
        $stmt=$conn->prepare("UPDATE user_info SET email=?,pass=?,address=?,uname=?,mobile=? WHERE user_id=?");
        if($stmt){
            $stmt->bind_param("sssssi",$email,$password,$address,$username,$mobile,$user_id);
            if($stmt->execute()){
                $_SESSION["user_id"]=$user_id;
                $_SESSION["username"]=$username;
                $_SESSION["password"]=$password;
                $stmt->close();
                header("Location: library.php?updated=1");
                exit;
            }
            $stmt->close();
        }
    }
}

/* USER PROFILE */
$profile=null;

if($user_id>0){
    $stmt=$conn->prepare("SELECT user_id,email,pass,address,uname,mobile FROM user_info WHERE user_id=? LIMIT 1");
    if($stmt){
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $stmt->bind_result($db_id,$db_email,$db_pass,$db_address,$db_uname,$db_mobile);

        if($stmt->fetch()){
            $profile=[
                "user_id"=>$db_id,
                "email"=>$db_email,
                "pass"=>$db_pass,
                "address"=>$db_address,
                "uname"=>$db_uname,
                "mobile"=>$db_mobile
            ];
        }
        $stmt->close();
    }
}

/* AJAX SEARCH */
if(isset($_GET["id"])){
    $like="%".trim($_GET["id"])."%";
    $stmt=$conn->prepare("SELECT library_id,hn,ha,hp1,rating FROM hostel_details WHERE hn LIKE ? ORDER BY library_id DESC");

    if($stmt){
        $stmt->bind_param("s",$like);
        $stmt->execute();
        $res=$stmt->get_result();

        if($res->num_rows>0){
            while($rows=$res->fetch_assoc()){
                $rating=max(0,min(5,floatval($rows["rating"])));
                $full=(int)floor($rating);
                $empty=5-$full;
?>
<div class="library-card">
    <?php if(!empty($rows["hp1"])): ?>
        <img src="img/<?php echo htmlspecialchars($rows["hp1"]); ?>" class="library-image" alt="Library Image">
    <?php else: ?>
        <div class="no-image">No Image</div>
    <?php endif; ?>

    <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($rows["hn"]); ?></h5>

        <p class="card-text">
            <i class="fa fa-map-marker"></i>&nbsp;
            <?php echo htmlspecialchars($rows["ha"]); ?>
        </p>

        <p class="card-text rating-line">
            <span class="library-rating"><?php echo str_repeat("★",$full).str_repeat("☆",$empty); ?></span>
            <span class="rating-number"><?php echo number_format($rating,1); ?>/5</span>
        </p>

        <a href="library.php?id1=<?php echo (int)$rows["library_id"]; ?>" class="btn common-btn">View Details</a>
    </div>
</div>
<?php
            }
        }else{
            echo '<div class="no-result">No library found.</div>';
        }
        $stmt->close();
    }
    $conn->close();
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Knowledge Hub</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
html,body{
    margin:0;
    min-height:100%;
    font-family:Arial,sans-serif;
    color:#000;
}
body{
    position:relative;
    background:#f7f2fa;
}
body::before{
    content:"";
    position:fixed;
    inset:-10px;
    background:url("img/im1.jpeg") center/cover no-repeat;
    filter:blur(4px);
    z-index:-2;
}
body::after{
    content:"";
    position:fixed;
    inset:0;
    background:rgba(255,255,255,.76);
    z-index:-1;
}

.knowledge-title{
    text-align:center;
    font-size:30px;
    font-weight:bold;
    color:white;
    background:#76588f;
    padding:14px 10px;
    letter-spacing:.4px;
}

.navbar{
    background:#a285bc!important;
    min-height:65px;
    padding:8px 30px;
    box-shadow:0 3px 12px rgba(60,40,75,.16);
}
.navbar .container-fluid{
    width:100%;
    display:flex;
    align-items:center;
    position:relative;
}
.main-nav{
    display:flex;
    align-items:center;
    gap:6px;
    margin-left:-45px;
}
.main-nav .nav-link{
    color:white!important;
    font-size:16px;
    font-weight:600;
    padding:10px 16px;
    border-radius:8px;
    text-decoration:none;
    transition:.25s;
}
.main-nav .nav-link:hover{
    background:rgba(255,255,255,.20);
    color:white!important;
}
.search-form{margin-left:8px}
.search-form .form-control{
    width:190px;
    height:40px;
    border:0;
    border-radius:22px;
    padding:8px 16px;
    background:white;
    color:#000;
    box-shadow:0 2px 7px rgba(0,0,0,.10);
}
.user-area{
    position:absolute;
    right:20px;
    top:50%;
    transform:translateY(-50%);
}
.user-link{
    display:flex;
    align-items:center;
    gap:8px;
    color:white!important;
    font-size:16px;
    font-weight:600;
    padding:7px 11px;
    border-radius:9px;
    text-decoration:none;
}
.user-link:hover{
    background:rgba(255,255,255,.20);
    color:white!important;
    text-decoration:none;
}
.user-link .fa-user-circle{font-size:32px}

.profile-panel{
    position:fixed;
    top:0;
    right:-380px;
    width:370px;
    max-width:90%;
    height:100vh;
    background:white;
    z-index:1055;
    box-shadow:-8px 0 25px rgba(0,0,0,.22);
    transition:right .3s ease;
    overflow-y:auto;
}
.profile-panel.active{right:0}
.profile-header{
    height:78px;
    background:#a285bc;
    color:white;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 22px;
}
.profile-header h4{
    margin:0;
    font-size:21px;
    font-weight:bold;
}
.profile-header h4 i{font-size:24px}
.close-btn{
    font-size:34px;
    cursor:pointer;
    line-height:1;
}
.profile-user{
    text-align:center;
    padding:22px 15px 18px;
    border-bottom:1px solid #eee;
}
.profile-user-icon{
    width:68px;
    height:68px;
    margin:auto;
    border-radius:50%;
    background:#eee8f3;
    display:flex;
    align-items:center;
    justify-content:center;
}
.profile-user-icon i{
    font-size:34px;
    color:#76588f;
}
.profile-user h5{
    margin:10px 0 3px;
    font-size:19px;
    font-weight:bold;
    color:#000;
}
.profile-user p{
    margin:0;
    font-size:13px;
    color:#666;
}
.profile-body{padding:15px}
.profile-item{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px;
    margin-bottom:6px;
    border-radius:9px;
    color:#000;
    text-decoration:none;
    transition:.2s;
}
.profile-item:hover{
    background:#f4eff7;
    color:#000;
    text-decoration:none;
}
.profile-item-icon{
    width:40px;
    height:40px;
    border-radius:8px;
    background:#eee8f3;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}
.profile-item-icon i{
    color:#76588f;
    font-size:18px;
}
.profile-item strong{
    display:block;
    color:#000;
    font-size:15px;
}
.profile-item small{
    display:block;
    color:#777;
    font-size:12px;
    margin-top:2px;
}
.profile-line{
    height:1px;
    background:#eee;
    margin:14px 5px;
}
#profileOverlay{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.30);
    z-index:1050;
}
#profileOverlay.active{display:block}

#demo{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    align-items:flex-start;
    gap:22px;
    padding:22px 20px 35px;
}
.library-card{
    width:24rem;
    display:flex;
    flex-direction:column;
    overflow:hidden;
    border:1px solid #e2d7e9;
    border-radius:14px;
    background:white;
    box-shadow:0 5px 18px rgba(86,61,103,.14);
    transition:.25s;
}
.library-card:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 25px rgba(86,61,103,.20);
}
.library-image,.no-image{
    width:100%;
    height:280px;
    object-fit:cover;
}
.no-image{
    display:flex;
    align-items:center;
    justify-content:center;
    background:#eee;
    color:#000;
    font-size:17px;
}
.library-card .card-body{
    padding:17px 19px 19px;
    color:#000;
    display:flex;
    flex-direction:column;
    flex:1;
}
.card-title,.card-text{color:#000!important}
.card-title{
    font-size:21px;
    font-weight:bold;
    margin-bottom:9px;
}
.card-text{
    font-size:15px;
    margin-bottom:9px;
}
.rating-line{
    display:flex;
    align-items:center;
    gap:8px;
    margin-bottom:15px;
}
.library-rating{
    color:#e0a800;
    font-size:18px;
    letter-spacing:1px;
}
.rating-number{
    color:#000;
    font-weight:bold;
}
.common-btn,.modal-btn,.profile-update-btn{
    background:#a285bc!important;
    border:1px solid #a285bc!important;
    color:white!important;
    border-radius:7px;
    font-weight:600;
    text-decoration:none!important;
}
.common-btn{
    padding:8px 17px;
    margin-top:auto;
}
.common-btn:hover,.modal-btn:hover,.profile-update-btn:hover{
    background:#a285bc!important;
    border-color:#a285bc!important;
    color:white!important;
}
.no-result{
    width:100%;
    text-align:center;
    color:#000;
    font-size:18px;
    font-weight:bold;
    padding:30px;
}

.details-wrap{
    max-width:1050px;
    margin:15px auto 30px;
    padding:0 15px;
}
.details-title{
    text-align:center;
    color:#76588f;
    font-size:26px;
    font-weight:bold;
    margin-bottom:10px;
}
.details-card{
    background:white;
    border:1px solid #e1d6e8;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 6px 22px rgba(86,61,103,.13);
}
.details-image{
    display:block;
    width:100%;
    height:310px;
    object-fit:cover;
}
.details-body{
    padding:17px 22px 20px;
    color:#000;
}
.details-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    column-gap:28px;
}
.detail-item{
    padding:9px 0;
    border-bottom:1px solid #eee;
    color:#000;
    font-size:15px;
    line-height:1.45;
}
.detail-item.full-width{grid-column:1/-1}
.detail-item strong{
    color:#000;
    font-weight:bold;
}
.detail-item i{
    width:19px;
    color:#000;
}
.detail-rating{
    color:#000;
    font-weight:bold;
}
.detail-stars{
    color:#e0a800;
    font-size:17px;
    margin-left:6px;
    letter-spacing:1px;
}
.detail-buttons{
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:10px;
    margin-top:17px;
}
.detail-buttons a{margin:0!important}

.modal-content{
    border:none;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 8px 30px rgba(0,0,0,.22);
}
.modal-header{
    background:#a285bc;
    color:white;
    border:none;
    padding:16px 20px;
}
.modal-title{
    color:white;
    font-size:19px;
    font-weight:bold;
}
.modal-header .close{
    color:white;
    opacity:1;
    text-shadow:none;
}
.modal-body{
    background:#f8f5fa;
    padding:20px;
}
.modal-footer{
    background:white;
    border-top:1px solid #eee;
}
.profile-modal-card{
    background:white;
    border:1px solid #e2dbe7;
    border-radius:11px;
    overflow:hidden;
}
.profile-modal-top{
    text-align:center;
    background:#eee8f3;
    padding:22px 15px 18px;
}
.profile-modal-icon{
    width:65px;
    height:65px;
    border-radius:50%;
    background:#e1d5e8;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 9px;
}
.profile-modal-icon i{
    font-size:32px;
    color:#76588f;
}
.profile-modal-top h4{
    margin:4px 0;
    font-size:20px;
    color:#000;
    font-weight:bold;
}
.profile-modal-top p{
    margin:0;
    color:#666;
    font-size:13px;
}
.profile-info{padding:5px 18px}
.info-row{
    display:flex;
    align-items:center;
    padding:12px 0;
    border-bottom:1px solid #eee;
}
.info-row:last-child{border-bottom:none}
.info-row>i{
    width:38px;
    height:38px;
    border-radius:8px;
    background:#eee8f3;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#76588f;
    margin-right:12px;
}
.info-row span{
    display:block;
    font-size:12px;
    color:#777;
}
.info-row strong{
    display:block;
    font-size:15px;
    color:#000;
    font-weight:600;
}
.modal-body label{
    font-weight:600;
    color:#000;
}
.modal-body .form-control{
    border:1px solid #d5c9dc;
    border-radius:7px;
    color:#000;
    background:white;
}
.modal-body .form-control:focus{
    border-color:#a285bc;
    box-shadow:0 0 0 2px rgba(162,133,188,.15);
}
.profile-update-btn{
    width:100%;
    padding:9px;
}
.contact-card{
    background:white;
    border:1px solid #e2dbe7;
    border-radius:11px;
    text-align:center;
    padding:22px 18px;
}
.contact-icon{
    width:60px;
    height:60px;
    border-radius:50%;
    background:#eee8f3;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 10px;
}
.contact-icon i{
    font-size:28px;
    color:#76588f;
}
.contact-card h4{
    color:#000;
    font-size:20px;
    font-weight:bold;
    margin-bottom:7px;
}
.contact-card p{
    color:#555;
    font-size:14px;
    line-height:1.5;
}
.contact-info{
    text-align:left;
    border-top:1px solid #eee;
    margin-top:15px;
    padding-top:10px;
}
.contact-info div{
    padding:7px 0;
    color:#000;
    font-size:14px;
}
.contact-info i{
    width:28px;
    color:#76588f;
}

#libraryFacilities{
    display:none;
    max-width:1100px;
    margin:0 auto 30px;
    padding:0 15px;
}
#libraryFacilities.active{display:block}
.facilities-title{
    text-align:center;
    color:#76588f;
    font-size:26px;
    font-weight:bold;
    margin:5px 0 16px;
}
.facilities-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}
.facility-card{
    background:white;
    border:1px solid #e2d7e9;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 5px 18px rgba(86,61,103,.14);
    transition:.25s;
}
.facility-card:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 25px rgba(86,61,103,.20);
}
.facility-card img{
    width:100%;
    height:190px;
    object-fit:cover;
    display:block;
}
.facility-card-body{
    padding:15px 16px 17px;
    text-align:center;
}
.facility-card-body h5{
    margin:0 0 7px;
    color:#000;
    font-size:19px;
    font-weight:bold;
}
.facility-card-body p{
    margin:0;
    color:#555;
    font-size:14px;
    line-height:1.5;
}
.facilities-back{
    text-align:center;
    margin-top:18px;
}

.site-footer{
    background:#a285bc;
    color:white;
    text-align:center;
    padding:14px 10px;
    margin-top:0;
}
.site-footer p{
    margin:0;
    font-size:14px;
}

@media(max-width:768px){
    .knowledge-title{
        font-size:25px;
        padding:12px 8px;
    }
    .navbar{padding:7px 10px}
    .main-nav{
        gap:2px;
        margin-left:0;
        flex-wrap:wrap;
    }
    .main-nav .nav-link{
        font-size:14px;
        padding:8px 7px;
    }
    .search-form{margin-left:3px}
    .search-form .form-control{
        width:125px;
        height:36px;
    }
    .user-area{right:7px}
    .user-link span{display:none}
    .user-link .fa-user-circle{font-size:30px}
    #demo{
        padding:17px 10px 28px;
        gap:16px;
    }
    .library-card{
        width:100%;
        max-width:400px;
    }
    .library-image,.no-image{height:240px}
    .details-wrap{
        margin:11px auto 25px;
        padding:0 10px;
    }
    .details-title{font-size:22px}
    .details-image{height:230px}
    .details-body{padding:14px 16px 18px}
    .details-grid{grid-template-columns:1fr}
    .detail-item.full-width{grid-column:auto}
    .detail-buttons{flex-direction:column}
    .detail-buttons a{
        width:100%;
        text-align:center;
    }
    .profile-panel{width:320px}
    #libraryFacilities{padding:0 10px}
    .facilities-title{font-size:22px}
    .facilities-grid{
        grid-template-columns:1fr;
        gap:16px;
    }
    .facility-card img{height:210px}
}
</style>
</head>

<body>

<div class="knowledge-title">📚 Knowledge Hub</div>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <div class="main-nav">
            <a class="nav-link" href="profile.php">
                <i class="fa fa-home"></i>&nbsp; Home
            </a>
            <a class="nav-link" href="library.php">
                <i class="fa fa-building"></i>&nbsp; Library
            </a>
            <form onsubmit="return false;" class="search-form">
                <input class="form-control" type="text" placeholder="Search Library"
                       aria-label="Search" id="s" name="s" onkeyup="se()">
            </form>
        </div>

        <div class="user-area">
            <a href="#" class="user-link" onclick="openProfile();return false;">
                <i class="fa fa-user-circle"></i>
                <span><?php echo htmlspecialchars($_SESSION["username"]??"guest"); ?></span>
            </a>
        </div>
    </div>
</nav>

<div id="profilePanel" class="profile-panel">
    <div class="profile-header">
        <h4><i class="fa fa-user-circle"></i>&nbsp; My Profile</h4>
        <span class="close-btn" onclick="closeProfile()">&times;</span>
    </div>

    <div class="profile-user">
        <div class="profile-user-icon"><i class="fa fa-user"></i></div>
        <h5><?php echo htmlspecialchars($_SESSION["username"]??"guest"); ?></h5>
        <p>Knowledge Hub User</p>
    </div>

    <div class="profile-body">
        <a href="#" class="profile-item" data-toggle="modal" data-target="#profileModal" onclick="closeProfile()">
            <div class="profile-item-icon"><i class="fa fa-user"></i></div>
            <div>
                <strong>See Your Profile</strong>
                <small>View your profile information</small>
            </div>
        </a>

        <a href="#" class="profile-item" data-toggle="modal" data-target="#editProfileModal" onclick="closeProfile()">
            <div class="profile-item-icon"><i class="fa fa-edit"></i></div>
            <div>
                <strong>Edit Profile</strong>
                <small>Update your profile details</small>
            </div>
        </a>

        <a href="#" class="profile-item" data-toggle="modal" data-target="#contactModal" onclick="closeProfile()">
            <div class="profile-item-icon"><i class="fa fa-phone"></i></div>
            <div>
                <strong>Contact</strong>
                <small>Contact Knowledge Hub</small>
            </div>
        </a>

        <div class="profile-line"></div>

        <a href="index.php?logout=1" class="profile-item logout">
            <div class="profile-item-icon"><i class="fa fa-sign-out"></i></div>
            <div>
                <strong>Logout</strong>
                <small>Sign out of your account</small>
            </div>
        </a>
    </div>
</div>

<div id="profileOverlay" onclick="closeProfile()"></div>

<?php if(!isset($_REQUEST["id1"])): ?>

<div id="demo">
<?php
$res=$conn->query("SELECT library_id,hn,ha,hp1,rating FROM hostel_details ORDER BY library_id DESC");

if($res){
    while($rows=mysqli_fetch_assoc($res)){
        $rating=max(0,min(5,floatval($rows["rating"])));
        $full=(int)floor($rating);
        $empty=5-$full;
?>
<div class="library-card">
    <?php if(!empty($rows["hp1"])): ?>
        <img src="img/<?php echo htmlspecialchars($rows["hp1"]); ?>" class="library-image" alt="Library Image">
    <?php else: ?>
        <div class="no-image">No Image</div>
    <?php endif; ?>

    <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($rows["hn"]); ?></h5>

        <p class="card-text">
            <i class="fa fa-map-marker"></i>&nbsp;
            <?php echo htmlspecialchars($rows["ha"]); ?>
        </p>

        <p class="card-text rating-line">
            <span class="library-rating"><?php echo str_repeat("★",$full).str_repeat("☆",$empty); ?></span>
            <span class="rating-number"><?php echo number_format($rating,1); ?>/5</span>
        </p>

        <a href="library.php?id1=<?php echo (int)$rows["library_id"]; ?>" class="btn common-btn">
            View Details
        </a>
    </div>
</div>
<?php
    }
}
?>
</div>

<?php endif; ?>

<?php
if(isset($_REQUEST["id1"])){
    $library_id=(int)$_REQUEST["id1"];

    $stmt=$conn->prepare("SELECT library_id,hn,ha,abt,hm,hp1,hp2,hp3,opening_time,closing_time,working_days,seating_capacity,fee,library_type,email,rating FROM hostel_details WHERE library_id=? LIMIT 1");
    $stmt->bind_param("i",$library_id);
    $stmt->execute();
    $res=$stmt->get_result();

    if($res && ($rows=mysqli_fetch_assoc($res))){
        $rating=max(0,min(5,floatval($rows["rating"])));
        $full=(int)floor($rating);
        $empty=5-$full;
?>

<div class="details-wrap">
    <div class="details-title"><?php echo strtoupper(htmlspecialchars($rows["hn"])); ?></div>

    <div class="details-card">
        <?php if(!empty($rows["hp1"])): ?>
            <img src="img/<?php echo htmlspecialchars($rows["hp1"]); ?>" class="details-image" alt="Library Image">
        <?php endif; ?>

        <div class="details-body">
            <div class="details-grid">

                <div class="detail-item full-width">
                    <strong><i class="fa fa-info-circle"></i>&nbsp; About Library:</strong>
                    <?php echo nl2br(htmlspecialchars($rows["abt"])); ?>
                </div>

                <div class="detail-item">
                    <strong><i class="fa fa-map-marker"></i>&nbsp; Address:</strong>
                    <?php echo htmlspecialchars($rows["ha"]); ?>
                </div>

                <div class="detail-item">
                    <strong><i class="fa fa-phone"></i>&nbsp; Mobile Number:</strong>
                    <?php echo htmlspecialchars($rows["hm"]); ?>
                </div>

                <div class="detail-item">
                    <strong><i class="fa fa-clock-o"></i>&nbsp; Opening Time:</strong>
                    <?php echo htmlspecialchars($rows["opening_time"]??"Not Available"); ?>
                </div>

                <div class="detail-item">
                    <strong><i class="fa fa-clock-o"></i>&nbsp; Closing Time:</strong>
                    <?php echo htmlspecialchars($rows["closing_time"]??"Not Available"); ?>
                </div>

                <div class="detail-item">
                    <strong><i class="fa fa-calendar"></i>&nbsp; Working Days:</strong>
                    <?php echo htmlspecialchars($rows["working_days"]??"Not Available"); ?>
                </div>

                <div class="detail-item">
                    <strong><i class="fa fa-users"></i>&nbsp; Seating Capacity:</strong>
                    <?php
                    if(isset($rows["seating_capacity"]) && $rows["seating_capacity"]!==null && $rows["seating_capacity"]!=="")
                        echo htmlspecialchars($rows["seating_capacity"])." Seats";
                    else echo "Not Available";
                    ?>
                </div>

                <div class="detail-item">
                    <strong><i class="fa fa-inr"></i>&nbsp; Fee:</strong>
                    <?php echo htmlspecialchars($rows["fee"]??"Not Available"); ?>
                </div>

                <div class="detail-item">
                    <strong><i class="fa fa-building"></i>&nbsp; Library Type:</strong>
                    <?php echo htmlspecialchars($rows["library_type"]??"Not Available"); ?>
                </div>

                <div class="detail-item">
                    <strong><i class="fa fa-envelope"></i>&nbsp; Email:</strong>
                    <?php echo htmlspecialchars($rows["email"]??"Not Available"); ?>
                </div>

                <div class="detail-item">
                    <strong><i class="fa fa-star"></i>&nbsp; Rating:</strong>
                    <span class="detail-rating"><?php echo number_format($rating,1); ?>/5</span>
                    <span class="detail-stars"><?php echo str_repeat("★",$full).str_repeat("☆",$empty); ?></span>
                </div>
            </div>

            <div class="detail-buttons">
                <a href="library.php" class="btn common-btn">Back to Libraries</a>
                <a href="#libraryFacilities" class="btn common-btn" onclick="showFacilities();return false;">
                    <i class="fa fa-building"></i>&nbsp; Library Facilities
                </a>
            </div>
        </div>
    </div>
</div>

<?php
    }
    $stmt->close();
}
?>

<!-- PROFILE MODAL -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user-circle"></i>&nbsp; My Profile</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>

            <div class="modal-body">
                <?php if($profile): ?>
                <div class="profile-modal-card">

                    <div class="profile-modal-top">
                        <div class="profile-modal-icon"><i class="fa fa-user"></i></div>
                        <h4><?php echo htmlspecialchars($profile["uname"]); ?></h4>
                        <p>Knowledge Hub User</p>
                    </div>

                    <div class="profile-info">
                        <div class="info-row">
                            <i class="fa fa-user"></i>
                            <div>
                                <span>Username</span>
                                <strong><?php echo htmlspecialchars($profile["uname"]); ?></strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <i class="fa fa-envelope"></i>
                            <div>
                                <span>Email</span>
                                <strong><?php echo htmlspecialchars($profile["email"]); ?></strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <i class="fa fa-map-marker"></i>
                            <div>
                                <span>Address</span>
                                <strong><?php echo htmlspecialchars($profile["address"]); ?></strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <i class="fa fa-phone"></i>
                            <div>
                                <span>Mobile No</span>
                                <strong><?php echo htmlspecialchars($profile["mobile"]); ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                    <p class="text-center">Profile information not found.</p>
                <?php endif; ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn common-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT PROFILE MODAL -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-edit"></i>&nbsp; Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>

            <div class="modal-body">
                <?php if($profile): ?>
                <form action="library.php" method="post">

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="e" class="form-control"
                               value="<?php echo htmlspecialchars($profile["email"]); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="p" class="form-control"
                               value="<?php echo htmlspecialchars($profile["pass"]); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="a" class="form-control"
                               value="<?php echo htmlspecialchars($profile["address"]); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="un" class="form-control"
                               value="<?php echo htmlspecialchars($profile["uname"]); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Mobile No</label>
                        <input type="text" name="m" maxlength="10" class="form-control"
                               value="<?php echo htmlspecialchars($profile["mobile"]); ?>" required>
                    </div>

                    <button type="submit" name="update_profile" class="btn profile-update-btn">
                        Update Profile
                    </button>
                </form>
                <?php endif; ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn common-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- CONTACT MODAL -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-phone"></i>&nbsp; Contact</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="contact-card">
                    <div class="contact-icon"><i class="fa fa-building"></i></div>
                    <h4>Knowledge Hub</h4>
                    <p>For library related information and assistance, please contact the Knowledge Hub.</p>

                    <div class="contact-info">
                        <div><i class="fa fa-phone"></i> Contact: Knowledge Hub</div>
                        <div><i class="fa fa-envelope"></i> Email: knowledgehub@gmail.com</div>
                        <div><i class="fa fa-clock-o"></i> Available: Monday - Saturday</div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn common-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- LIBRARY FACILITIES -->
<div id="libraryFacilities">
    <div class="facilities-title">Library Facilities</div>

    <div class="facilities-grid">
        <div class="facility-card">
            <img src="img/wifi.jpg" alt="Free Wi-Fi">
            <div class="facility-card-body">
                <h5>Free Wi-Fi</h5>
                <p>Fast and reliable Wi-Fi facility is available for library users.</p>
            </div>
        </div>

        <div class="facility-card">
            <img src="img/ac.avif" alt="AC Reading Hall">
            <div class="facility-card-body">
                <h5>AC Reading Hall</h5>
                <p>Comfortable air-conditioned reading space for focused study.</p>
            </div>
        </div>

        <div class="facility-card">
            <img src="img/books.avif" alt="Book Collection">
            <div class="facility-card-body">
                <h5>Book Collection</h5>
                <p>A useful collection of books and study materials is available.</p>
            </div>
        </div>

        <div class="facility-card">
            <img src="img/cctv.jpg" alt="CCTV Security">
            <div class="facility-card-body">
                <h5>CCTV Security</h5>
                <p>CCTV monitoring helps maintain a safe and secure environment.</p>
            </div>
        </div>

        <div class="facility-card">
            <img src="img/news.webp" alt="Newspapers and Magazines">
            <div class="facility-card-body">
                <h5>Newspapers &amp; Magazines</h5>
                <p>Newspapers and magazines are available for reading and updates.</p>
            </div>
        </div>

        <div class="facility-card">
            <img src="img/water.webp" alt="Drinking Water">
            <div class="facility-card-body">
                <h5>Drinking Water</h5>
                <p>Clean drinking water facility is available for library visitors.</p>
            </div>
        </div>
    </div>

    <div class="facilities-back">
        <button type="button" class="btn common-btn" onclick="hideFacilities();">
            <i class="fa fa-arrow-up"></i>&nbsp; Back to Library Details
        </button>
    </div>
</div>

<footer class="site-footer">
    <p>© 2026 Knowledge Hub &nbsp; | &nbsp; All Rights Reserved</p>
</footer>

<script>
function se(){
    var xhttp=new XMLHttpRequest();
    var searchValue=document.getElementById("s").value;

    xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            document.getElementById("demo").innerHTML=this.responseText;
            equalCardHeight();
        }
    };

    xhttp.open("GET","library.php?id="+encodeURIComponent(searchValue),true);
    xhttp.send();
}

function equalCardHeight(){
    var cards=document.querySelectorAll("#demo .library-card");
    var maxHeight=0;

    cards.forEach(function(card){
        card.style.height="auto";
    });

    cards.forEach(function(card){
        if(card.offsetHeight>maxHeight) maxHeight=card.offsetHeight;
    });

    cards.forEach(function(card){
        card.style.height=maxHeight+"px";
    });
}

window.addEventListener("load",equalCardHeight);
window.addEventListener("resize",equalCardHeight);

function showFacilities(){
    var facilities=document.getElementById("libraryFacilities");
    if(facilities){
        facilities.classList.add("active");
        facilities.scrollIntoView({behavior:"smooth",block:"start"});
    }
}

function hideFacilities(){
    var facilities=document.getElementById("libraryFacilities");
    if(facilities) facilities.classList.remove("active");
}

function openProfile(){
    document.getElementById("profilePanel").classList.add("active");
    document.getElementById("profileOverlay").classList.add("active");
}

function closeProfile(){
    document.getElementById("profilePanel").classList.remove("active");
    document.getElementById("profileOverlay").classList.remove("active");
}
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>