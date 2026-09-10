
<?php
ob_start();
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

$conn = new mysqli("localhost", "root", "", "project_batch");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>

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

<title>Knowledge Hub Admin</title>

<style>

/* =========================
   BASIC
========================= */

html,
body
{
    margin:0;
    min-height:100%;
    font-family:Arial,sans-serif;
    color:#333;
}


/* =========================
   BACKGROUND IMAGE
========================= */

body
{
    position:relative;
    background:#eee6f5;
    overflow-x:hidden;
}

body::before
{
    content:"";

    position:fixed;

    top:-10px;
    left:-10px;

    width:calc(100% + 20px);
    height:calc(100% + 20px);

    background-image:url("img/im1.jpeg");

    background-size:cover;
    background-position:center center;
    background-repeat:no-repeat;

    filter:blur(4px);

    z-index:-2;
}

body::after
{
    content:"";

    position:fixed;

    top:0;
    left:0;

    width:100%;
    height:100%;

    background:rgba(255,255,255,0.25);

    z-index:-1;
}


/* =========================
   HEADER
========================= */

.header
{
    background:#a285bc;

    color:white;

    padding:12px 35px;
}

.logo
{
    font-size:25px;

    font-weight:bold;

    color:white;
}

.logout
{
    background:white;

    color:#76588f;

    padding:9px 20px;

    border-radius:5px;

    text-decoration:none;

    font-size:15px;
}

.logout:hover
{
    background:#eee6f5;

    color:#76588f;

    text-decoration:none;
}


/* =========================
   MAIN
========================= */

.main
{
    width:90%;

    margin:20px auto;
}


/* =========================
   COMMON BOX
========================= */

.welcome,
.box,
.section
{
    background:rgba(255,255,255,0.96);

    border:1px solid #d2c2df;

    border-radius:10px;

    box-shadow:0 2px 8px rgba(70,50,90,0.15);

    color:#333;
}


/* =========================
   WELCOME
========================= */

.welcome
{
    padding:15px;

    margin-bottom:18px;

    text-align:center;
}

.welcome h2
{
    margin:0 0 5px 0;

    font-size:25px;

    color:#76588f;
}

.welcome p
{
    margin:5px;

    font-size:15px;

    color:#333;
}


/* =========================
   ALL BOX FONT
========================= */

.box
{
    

    text-align:center;

    font-family:Arial,sans-serif;

    font-size:16px;

    color:#333;
}

.box h2
{
    font-family:Arial,sans-serif;

    font-size:22px;

    

    color:#76588f;
}

.box h3
{
    font-family:Arial,sans-serif;

    font-size:16px;

   

    color:#333;
}

.box p
{
    font-family:Arial,sans-serif;

    font-size:16px;

  

    color:#333;
}

.box b
{
    font-family:Arial,sans-serif;

    font-size:16px;

    color:#76588f;
}

.box h2 b
{
    font-size:22px;

    color:#76588f;
}


/* =========================
   ACTION BOX
========================= */

.action-box
{
padding:20px ;

    cursor:pointer;

    min-height:105px;
}

.action-box div
{
    font-family:Arial,sans-serif;

    font-size:16px;

    color:#333;
}

.action-box b
{
    font-family:Arial,sans-serif;

    font-size:16px;

    color:#76588f;
}

.action-box:hover
{
    background:#f8f4fb;

    border-color:#a285bc;
}


/* =========================
   SECTION
========================= */

.section
{
    padding:26px;

    margin-top:18px;
}

.section h4
{
    font-family:Arial,sans-serif;

    font-size:20px;

    font-weight:bold;

    color:#76588f;

    margin-bottom:15px;
}


/* =========================
   FORM
========================= */

label
{
    font-family:Arial,sans-serif;

    font-size:16px;

    font-weight:bold;

    color:#333;
}

.form-control
{
    height:38px;

    font-family:Arial,sans-serif;

    font-size:15px;

    color:#333;

    background:white;

    border:1px solid #cdbddd;
}

.form-control:focus
{
    border-color:#a285bc;

    box-shadow:0 0 0 0.15rem
    rgba(162,133,188,0.20);
}

textarea.form-control
{
    height:70px;
}


/* =========================
   BUTTONS
========================= */

.save,
.edit
{
    background:#a285bc;

    color:white;

    border:0;

    border-radius:4px;
}

.save
{
    padding:7px 25px;

    font-size:15px;
}

.edit
{
    padding:7px 15px;

    font-size:15px;

    text-decoration:none;
}

.save:hover,
.edit:hover
{
    background:#76588f;

    color:white;

    text-decoration:none;
}

.delete
{
    background:#888;

    color:white;

    padding:7px 15px;

    border-radius:4px;

    font-size:15px;

    text-decoration:none;
}

.delete:hover
{
    background:#666;

    color:white;

    text-decoration:none;
}


/* =========================
   TABLE
========================= */

.table
{
    background:white;

    font-family:Arial,sans-serif;

    font-size:15px;

    color:#333;

    margin-bottom:0;
}

.table thead
{
    background:#a285bc;

    color:white;
}

.table td,
.table th
{
    padding:12px;

    vertical-align:middle;

    font-size:15px;
}

.table-bordered td,
.table-bordered th
{
    border:1px solid #ddd;
}


/* =========================
   LIBRARY IMAGE
========================= */

.libimg
{
    width:60px;

    height:50px;

    object-fit:cover;

    border-radius:5px;

    border:1px solid #d2c2df;
}


/* =========================
   SEARCH
========================= */

.search
{
    height:34px;

    font-family:Arial,sans-serif;

    font-size:15px;

    max-width:260px;
}


/* =========================
   FOOTER
========================= */

.footer
{
    background:#a285bc;

    color:white;

    text-align:center;

    padding:12px;

    font-size:15px;

    margin-top:25px;
}


/* =========================
   HIDE
========================= */

.hidden-section
{
    display:none;
}

</style>

</head>

<body>


<!-- =========================
     HEADER
========================= -->

<div class="header">

<div class="row align-items-center">

<div class="col-md-6">

<div class="logo">

<i class="fa fa-book"></i>
Knowledge Hub - Admin Panel

</div>

</div>


<div class="col-md-6 text-right">

Welcome Admin &nbsp;&nbsp;

<a href="index.php?logout=1"
class="logout">

<i class="fa fa-sign-out"></i>
Logout

</a>

</div>

</div>

</div>


<div class="main">


<!-- =========================
     DASHBOARD
========================= -->

<div class="welcome">

<h2>
<b>Admin Dashboard</b>
</h2>

<p>
Manage libraries and registered users from here.
</p>

</div>


<?php

/* =========================
   DASHBOARD STATISTICS
========================= */


/* TOTAL USERS */

$res = $conn->query(
"SELECT COUNT(*) AS total
 FROM user_info"
);

$row = $res->fetch_assoc();

$totaluser = $row["total"];


/* TOTAL LIBRARIES */

$res = $conn->query(
"SELECT COUNT(*) AS total
 FROM hostel_details"
);

$row = $res->fetch_assoc();

$totallibrary = $row["total"];


/* AVERAGE RATING */

$res = $conn->query(
"SELECT ROUND(
AVG(CAST(NULLIF(rating,'') AS DECIMAL(10,2))),1
) AS average_rating
FROM hostel_details"
);

$row = $res->fetch_assoc();

$average_rating = $row["average_rating"];

if($average_rating == "")
{
    $average_rating = "0";
}


/* HIGHEST RATING */

$res = $conn->query(
"SELECT MAX(
CAST(NULLIF(rating,'') AS DECIMAL(10,2))
) AS highest_rating
FROM hostel_details"
);

$row = $res->fetch_assoc();

$highest_rating = $row["highest_rating"];

if($highest_rating == "")
{
    $highest_rating = "0";
}


/* LOWEST RATING */

$res = $conn->query(
"SELECT MIN(
CAST(NULLIF(rating,'') AS DECIMAL(10,2))
) AS lowest_rating
FROM hostel_details"
);

$row = $res->fetch_assoc();

$lowest_rating = $row["lowest_rating"];

if($lowest_rating == "")
{
    $lowest_rating = "0";
}


/* TOTAL SEATING */

$res = $conn->query(
"SELECT SUM(seating_capacity) AS total_seats
FROM hostel_details"
);

$row = $res->fetch_assoc();

$total_seats = $row["total_seats"];

if($total_seats == "")
{
    $total_seats = "0";
}

?>


<!-- =========================
     TOTAL USERS + LIBRARIES
========================= -->

<div class="row">


<div class="col-md-6 mb-3">

<div class="box">

<div style="font-size:21px;">
<i class="fa fa-users"></i>
</div>

<h2>
<b><?php echo $totaluser; ?></b>
</h2>

<p>
<b>Total Users</b>
</p>

</div>

</div>


<div class="col-md-6 mb-3">

<div class="box">

<div style="font-size:21px;">
<i class="fa fa-building"></i>
</div>

<h2>
<b><?php echo $totallibrary; ?></b>
</h2>

<p>
<b>Total Libraries</b>
</p>

</div>

</div>


</div>


<!-- =========================
     ADD LIBRARY / USERS
========================= -->

<div class="row">


<div class="col-md-6 mb-3">

<div class="box action-box"
onclick="showLibraryForm()">

<div>

<i class="fa fa-plus-circle"></i>

<b>Add Library</b>

</div>

<div>

Click here to add a new library

</div>

</div>

</div>


<div class="col-md-6 mb-3">

<div class="box action-box"
onclick="showUsers()">

<div>

<i class="fa fa-users"></i>

<b>Registered Users</b>

</div>

<div>

Click here to view registered users

</div>

</div>

</div>


</div>


<!-- =========================
     ADD LIBRARY FORM
========================= -->

<div class="section hidden-section"
id="libraryForm">

<h4>

<i class="fa fa-plus-circle"></i>
Add Library

</h4>


<form action="admin.php"
method="post"
enctype="multipart/form-data">


<div class="form-row">


<div class="form-group col-md-6">

<label>
Library Name
</label>

<input type="text"
name="hn"
class="form-control"
required>

</div>


<div class="form-group col-md-6">

<label>
Address
</label>

<input type="text"
name="ha"
class="form-control"
required>

</div>


</div>


<div class="form-group">

<label>
About Library
</label>

<textarea
name="abt"
class="form-control"
required></textarea>

</div>


<div class="form-group">

<label>
Mobile Number
</label>

<input type="text"
name="hm"
maxlength="10"
class="form-control"
required>

</div>


<div class="form-row">


<div class="form-group col-md-6">

<label>
Opening Time
</label>

<input type="time"
name="hot"
class="form-control"
required>

</div>


<div class="form-group col-md-6">

<label>
Closing Time
</label>

<input type="time"
name="hct"
class="form-control"
required>

</div>


</div>


<div class="form-row">


<div class="form-group col-md-6">

<label>
Working Days
</label>

<input type="text"
name="hwd"
class="form-control"
placeholder="e.g. Monday - Saturday"
required>

</div>


<div class="form-group col-md-6">

<label>
Seating Capacity
</label>

<input type="number"
name="hsc"
class="form-control"
placeholder="e.g. 100"
min="1"
required>

</div>


</div>


<div class="form-row">


<div class="form-group col-md-6">

<label>
Fee
</label>

<input type="text"
name="hfee"
class="form-control"
placeholder="e.g. ₹500/month"
required>

</div>


<div class="form-group col-md-6">

<label>
Library Type
</label>

<select name="htype"
class="form-control"
required>

<option value="">
Select Library Type
</option>

<option value="Public Library">
Public Library
</option>

<option value="Private Library">
Private Library
</option>

<option value="Study Library">
Study Library
</option>

<option value="Digital Library">
Digital Library
</option>

<option value="Community Library">
Community Library
</option>

</select>

</div>


</div>


<div class="form-group">

<label>
Email ID
</label>

<input type="email"
name="hrating"
class="form-control"
placeholder="e.g. library@gmail.com"
required>

</div>


<div class="form-row">


<div class="form-group col-md-4">

<label>
Upload Picture 1
</label>

<input type="file"
name="hp1"
class="form-control"
accept="image/*">

</div>


<div class="form-group col-md-4">

<label>
Upload Picture 2
</label>

<input type="file"
name="hp2"
class="form-control"
accept="image/*">

</div>


<div class="form-group col-md-4">

<label>
Upload Picture 3
</label>

<input type="file"
name="hp3"
class="form-control"
accept="image/*">

</div>


</div>


<input type="submit"
name="x"
value="SAVE"
class="save">


</form>

</div>


<?php

/* =========================
   ADD LIBRARY
========================= */

if(isset($_POST["x"]))
{

$p1 = $_POST["hn"];
$p2 = $_POST["ha"];
$p3 = $_POST["abt"];
$p4 = $_POST["hm"];

$p8 = $_POST["hot"];
$p9 = $_POST["hct"];
$p10 = $_POST["hwd"];
$p11 = $_POST["hsc"];
$p12 = $_POST["hfee"];
$p13 = $_POST["htype"];
$p14 = $_POST["hrating"];


/* PICTURE 1 */

$p5 = "";

if(isset($_FILES["hp1"]))
{

if($_FILES["hp1"]["name"] != "")
{

$p5 = basename($_FILES["hp1"]["name"]);

move_uploaded_file(
$_FILES["hp1"]["tmp_name"],
"img/".$p5
);

}

}


/* PICTURE 2 */

$p6 = "";

if(isset($_FILES["hp2"]))
{

if($_FILES["hp2"]["name"] != "")
{

$p6 = basename($_FILES["hp2"]["name"]);

move_uploaded_file(
$_FILES["hp2"]["tmp_name"],
"img/".$p6
);

}

}


/* PICTURE 3 */

$p7 = "";

if(isset($_FILES["hp3"]))
{

if($_FILES["hp3"]["name"] != "")
{

$p7 = basename($_FILES["hp3"]["name"]);

move_uploaded_file(
$_FILES["hp3"]["tmp_name"],
"img/".$p7
);

}

}


/* INSERT */

$str = "INSERT INTO hostel_details
(hn,ha,abt,hm,hp1,hp2,hp3,
opening_time,closing_time,working_days,
seating_capacity,fee,library_type,email,rating)
VALUES
('$p1','$p2','$p3','$p4','$p5','$p6','$p7',
'$p8','$p9','$p10','$p11','$p12','$p13','$p14','')";


if($conn->query($str))
{

?>

<script>

alert("Library added successfully !!!!");

window.location="admin.php";

</script>

<?php

}
else
{

echo "<script>
alert('Library could not be added.');
</script>";

}

}

?>


<!-- =========================
     REGISTERED USERS
========================= -->

<div class="section hidden-section"
id="usersSection">


<div class="row align-items-center">


<div class="col-md-6">

<h4>

<i class="fa fa-users"></i>
Registered Users

</h4>

</div>


<div class="col-md-6">

<input type="text"
id="usersearch"
class="form-control search float-right"
placeholder="Search User">

</div>


</div>


<div class="table-responsive">


<table class="table table-bordered"
id="usertable">


<thead>

<tr>

<th>Username</th>
<th>Email</th>
<th>Address</th>
<th>Mobile</th>

</tr>

</thead>


<tbody>

<?php

$res = $conn->query(
"SELECT uname,email,address,mobile
FROM user_info
ORDER BY user_id DESC"
);


while($user = $res->fetch_assoc())
{

?>

<tr>

<td>
<?php echo htmlspecialchars($user["uname"]); ?>
</td>

<td>
<?php echo htmlspecialchars($user["email"]); ?>
</td>

<td>
<?php echo htmlspecialchars($user["address"]); ?>
</td>

<td>
<?php echo htmlspecialchars($user["mobile"]); ?>
</td>

</tr>

<?php

}

?>

</tbody>

</table>


</div>

</div>


<!-- =========================
     LIBRARIES
========================= -->

<div class="section">


<div class="row align-items-center">


<div class="col-md-6">

<h4>

<i class="fa fa-building"></i>
Libraries

</h4>

</div>


<div class="col-md-6">

<input type="text"
id="search"
class="form-control search float-right"
placeholder="Search Library">

</div>


</div>


<div class="table-responsive">


<table class="table table-bordered"
id="library">


<thead>

<tr>

<th>Picture</th>
<th>Library Name</th>
<th>Address</th>
<th>Mobile</th>
<th>Action</th>

</tr>

</thead>


<tbody>

<?php

$res = $conn->query(
"SELECT *
FROM hostel_details
ORDER BY CAST(NULLIF(rating,'') AS DECIMAL(10,2)) DESC"
);


while($rows = $res->fetch_assoc())
{

?>

<tr>


<td>

<?php

if($rows["hp1"] != "")
{

?>

<img
src="img/<?php echo htmlspecialchars($rows["hp1"]); ?>"
class="libimg">

<?php

}
else
{

echo "No Image";

}

?>

</td>


<td>

<?php echo htmlspecialchars($rows["hn"]); ?>

</td>


<td>

<?php echo htmlspecialchars($rows["ha"]); ?>

</td>


<td>

<?php echo htmlspecialchars($rows["hm"]); ?>

</td>


<td>


<a href="admin.php?edit=<?php echo (int)$rows["library_id"]; ?>"
class="edit">

Edit

</a>


&nbsp;


<a href="admin.php?delete=<?php echo urlencode($rows["hn"]); ?>"
class="delete"

onclick="return confirm('Are you sure you want to delete this library?');">

Delete

</a>


</td>


</tr>

<?php

}

?>

</tbody>

</table>


</div>

</div>


<?php

/* =========================
   DELETE LIBRARY
========================= */

if(isset($_GET["delete"]))
{

$name = $_GET["delete"];

$str = "DELETE FROM hostel_details
WHERE hn='$name'";


if($conn->query($str))
{

?>

<script>

alert("Library deleted successfully !!!!");

window.location="admin.php";

</script>

<?php

}

}

?>


<?php

/* =========================
   EDIT FORM
========================= */

if(isset($_GET["edit"]))
{

$library_id = isset($_GET["edit"]) ? (int)$_GET["edit"] : 0;

$str = "SELECT *
FROM hostel_details
WHERE library_id=$library_id
LIMIT 1";

$res = $conn->query($str);
if($rows = $res->fetch_assoc())
{

?>

<!-- =========================
     EDIT LIBRARY
========================= -->

<div class="section"
id="editForm">


<h4>

<i class="fa fa-edit"></i>
Edit Library

</h4>


<form action="admin.php"
method="post"
enctype="multipart/form-data">


<input type="hidden"
name="library_id"
value="<?php echo (int)$rows["library_id"]; ?>">


<div class="form-row">


<div class="form-group col-md-6">

<label>
Library Name
</label>

<input type="text"
name="hn"
class="form-control"
value="<?php echo htmlspecialchars($rows["hn"]); ?>"
required>

</div>


<div class="form-group col-md-6">

<label>
Address
</label>

<input type="text"
name="ha"
class="form-control"
value="<?php echo htmlspecialchars($rows["ha"]); ?>"
required>

</div>


</div>


<div class="form-group">

<label>
About Library
</label>

<textarea
name="abt"
class="form-control"
required><?php echo htmlspecialchars($rows["abt"]); ?></textarea>

</div>


<div class="form-group">

<label>
Mobile Number
</label>

<input type="text"
name="hm"
maxlength="10"
class="form-control"
value="<?php echo htmlspecialchars($rows["hm"]); ?>"
required>

</div>


<div class="form-row">


<div class="form-group col-md-6">

<label>
Opening Time
</label>

<input type="time"
name="hot"
class="form-control"
value="<?php echo htmlspecialchars($rows["opening_time"]); ?>"
required>

</div>


<div class="form-group col-md-6">

<label>
Closing Time
</label>

<input type="time"
name="hct"
class="form-control"
value="<?php echo htmlspecialchars($rows["closing_time"]); ?>"
required>

</div>


</div>


<div class="form-row">


<div class="form-group col-md-6">

<label>
Working Days
</label>

<input type="text"
name="hwd"
class="form-control"
value="<?php echo htmlspecialchars($rows["working_days"]); ?>"
placeholder="e.g. Monday - Saturday"
required>

</div>


<div class="form-group col-md-6">

<label>
Seating Capacity
</label>

<input type="number"
name="hsc"
class="form-control"
value="<?php echo htmlspecialchars($rows["seating_capacity"]); ?>"
min="1"
required>

</div>


</div>


<div class="form-row">


<div class="form-group col-md-6">

<label>
Fee
</label>

<input type="text"
name="hfee"
class="form-control"
value="<?php echo htmlspecialchars($rows["fee"]); ?>"
placeholder="e.g. ₹500/month"
required>

</div>


<div class="form-group col-md-6">

<label>
Library Type
</label>

<select name="htype"
class="form-control"
required>


<option value="">
Select Library Type
</option>


<option value="Public Library"

<?php

if($rows["library_type"]=="Public Library")
{
    echo "selected";
}

?>>

Public Library

</option>


<option value="Private Library"

<?php

if($rows["library_type"]=="Private Library")
{
    echo "selected";
}

?>>

Private Library

</option>


<option value="Study Library"

<?php

if($rows["library_type"]=="Study Library")
{
    echo "selected";
}

?>>

Study Library

</option>


<option value="Digital Library"

<?php

if($rows["library_type"]=="Digital Library")
{
    echo "selected";
}

?>>

Digital Library

</option>


<option value="Community Library"

<?php

if($rows["library_type"]=="Community Library")
{
    echo "selected";
}

?>>

Community Library

</option>


</select>

</div>


</div>


<div class="form-group">

<label>
Email ID
</label>

<input type="email"
name="hrating"
class="form-control"
value="<?php echo htmlspecialchars($rows["email"]); ?>"
placeholder="e.g. library@gmail.com"
required>

</div>


<div class="form-row">


<div class="form-group col-md-4">

<label>
Picture 1
</label>

<br>


<?php

if($rows["hp1"] != "")
{

?>

<img
src="img/<?php echo htmlspecialchars($rows["hp1"]); ?>"
class="libimg">

<?php

}

?>


<br><br>


<input type="file"
name="hp1"
class="form-control"
accept="image/*">

</div>


<div class="form-group col-md-4">

<label>
Picture 2
</label>

<br>


<?php

if($rows["hp2"] != "")
{

?>

<img
src="img/<?php echo htmlspecialchars($rows["hp2"]); ?>"
class="libimg">

<?php

}

?>


<br><br>


<input type="file"
name="hp2"
class="form-control"
accept="image/*">

</div>


<div class="form-group col-md-4">

<label>
Picture 3
</label>

<br>


<?php

if($rows["hp3"] != "")
{

?>

<img
src="img/<?php echo htmlspecialchars($rows["hp3"]); ?>"
class="libimg">

<?php

}

?>


<br><br>


<input type="file"
name="hp3"
class="form-control"
accept="image/*">

</div>


</div>


<input type="submit"
name="update"
value="UPDATE"
class="save">


<a href="admin.php"
class="btn btn-secondary btn-sm">

Cancel

</a>


</form>


</div>

<?php

}

}

?>


<?php

/* =========================
   UPDATE LIBRARY
========================= */

if(isset($_POST["update"]))
{

$library_id = isset($_POST["library_id"]) ? (int)$_POST["library_id"] : 0;

$p1 = isset($_POST["hn"]) ? trim($_POST["hn"]) : "";
$p2 = isset($_POST["ha"]) ? trim($_POST["ha"]) : "";
$p3 = isset($_POST["abt"]) ? trim($_POST["abt"]) : "";
$p4 = isset($_POST["hm"]) ? trim($_POST["hm"]) : "";
$p8 = isset($_POST["hot"]) ? trim($_POST["hot"]) : "";
$p9 = isset($_POST["hct"]) ? trim($_POST["hct"]) : "";
$p10 = isset($_POST["hwd"]) ? trim($_POST["hwd"]) : "";
$p11 = isset($_POST["hsc"]) ? trim($_POST["hsc"]) : "";
$p12 = isset($_POST["hfee"]) ? trim($_POST["hfee"]) : "";
$p13 = isset($_POST["htype"]) ? trim($_POST["htype"]) : "";
$p14 = isset($_POST["hrating"]) ? trim($_POST["hrating"]) : "";

/* OLD PICTURES */

$stmtOld = $conn->prepare("SELECT hp1,hp2,hp3 FROM hostel_details WHERE library_id=? LIMIT 1");

if($stmtOld)
{
    $stmtOld->bind_param("i", $library_id);
    $stmtOld->execute();
    $oldResult = $stmtOld->get_result();

    if($old = $oldResult->fetch_assoc())
    {
        $p5 = $old["hp1"];
        $p6 = $old["hp2"];
        $p7 = $old["hp3"];
    }
    else
    {
        echo "<script>alert('Library not found.');</script>";
        $stmtOld->close();
        exit;
    }
    $stmtOld->close();
}
else
{
    echo "<script>alert('Could not read library data.');</script>";
    exit;
}

/* NEW PICTURE 1 */
if(isset($_FILES["hp1"]) && $_FILES["hp1"]["error"] == UPLOAD_ERR_OK && $_FILES["hp1"]["name"] != "")
{
    $ext = strtolower(pathinfo($_FILES["hp1"]["name"], PATHINFO_EXTENSION));
    $newname = "library_" . $library_id . "_1_" . time() . ($ext != "" ? "." . $ext : "");

    if(move_uploaded_file($_FILES["hp1"]["tmp_name"], "img/" . $newname))
    {
        $p5 = $newname;
    }
}

/* NEW PICTURE 2 */
if(isset($_FILES["hp2"]) && $_FILES["hp2"]["error"] == UPLOAD_ERR_OK && $_FILES["hp2"]["name"] != "")
{
    $ext = strtolower(pathinfo($_FILES["hp2"]["name"], PATHINFO_EXTENSION));
    $newname = "library_" . $library_id . "_2_" . time() . ($ext != "" ? "." . $ext : "");

    if(move_uploaded_file($_FILES["hp2"]["tmp_name"], "img/" . $newname))
    {
        $p6 = $newname;
    }
}

/* NEW PICTURE 3 */
if(isset($_FILES["hp3"]) && $_FILES["hp3"]["error"] == UPLOAD_ERR_OK && $_FILES["hp3"]["name"] != "")
{
    $ext = strtolower(pathinfo($_FILES["hp3"]["name"], PATHINFO_EXTENSION));
    $newname = "library_" . $library_id . "_3_" . time() . ($ext != "" ? "." . $ext : "");

    if(move_uploaded_file($_FILES["hp3"]["tmp_name"], "img/" . $newname))
    {
        $p7 = $newname;
    }
}

/* UPDATE */

$stmt = $conn->prepare("UPDATE hostel_details SET
hn=?, ha=?, abt=?, hm=?, hp1=?, hp2=?, hp3=?,
opening_time=?, closing_time=?, working_days=?,
seating_capacity=?, fee=?, library_type=?, email=?
WHERE library_id=?");

if($stmt)
{
    $stmt->bind_param(
        "ssssssssssssssi",
        $p1, $p2, $p3, $p4, $p5, $p6, $p7,
        $p8, $p9, $p10, $p11, $p12, $p13, $p14,
        $library_id
    );

    if($stmt->execute())
    {
        ?>
        <script>
        alert("Library updated successfully !!!!");
        window.location="admin.php";
        </script>
        <?php
    }
    else
    {
        echo "<script>alert('Library update failed: " . addslashes($stmt->error) . "');</script>";
    }

    $stmt->close();
}
else
{
    echo "<script>alert('Library update failed: " . addslashes($conn->error) . "');</script>";
}

}
?>

<!-- =========================
     FOOTER
========================= -->

<div class="footer">

<i class="fa fa-book"></i>
Knowledge Hub | Admin Panel

<br>

© 2026 Knowledge Hub | All Rights Reserved

</div>


<script>

/* =========================
   ADD LIBRARY
========================= */

function showLibraryForm()
{

var form =
document.getElementById("libraryForm");

var users =
document.getElementById("usersSection");


users.style.display = "none";


if(form.style.display == "block")
{

form.style.display = "none";

}
else
{

form.style.display = "block";

form.scrollIntoView({
behavior:"smooth"
});

}

}


/* =========================
   REGISTERED USERS
========================= */

function showUsers()
{

var users =
document.getElementById("usersSection");

var form =
document.getElementById("libraryForm");


form.style.display = "none";


if(users.style.display == "block")
{

users.style.display = "none";

}
else
{

users.style.display = "block";

users.scrollIntoView({
behavior:"smooth"
});

}

}


/* =========================
   LIBRARY SEARCH
========================= */

document.getElementById("search")
.addEventListener("keyup",function()
{

var value =
this.value.toLowerCase();


var rows =
document.querySelectorAll(
"#library tbody tr"
);


rows.forEach(function(row)
{

if(
row.innerText
.toLowerCase()
.includes(value)
)
{

row.style.display = "";

}
else
{

row.style.display = "none";

}

});

});


/* =========================
   USER SEARCH
========================= */

document.getElementById("usersearch")
.addEventListener("keyup",function()
{

var value =
this.value.toLowerCase();


var rows =
document.querySelectorAll(
"#usertable tbody tr"
);


rows.forEach(function(row)
{

if(
row.innerText
.toLowerCase()
.includes(value)
)
{

row.style.display = "";

}
else
{

row.style.display = "none";

}

});

});


/* =========================
   EDIT FORM OPEN
========================= */

<?php

if(isset($_GET["edit"]))
{

?>

window.onload = function()
{

var editForm =
document.getElementById("editForm");


if(editForm)
{

editForm.scrollIntoView({
behavior:"smooth"
});

}

};

<?php

}

?>

</script>


</body>

</html>

