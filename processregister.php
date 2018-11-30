
<html>
<head>
  <title>Secon Customer Entry</title>
  <link rel="stylesheet" type="text/css" href="secon.css">
</head>
<body>
<div class="topnav" id="myTopnav">
    <img src = "Secon_logo.png"
         alt = "Secon Logo" 
         style="width:250px;height:100px;"/>
    <a href="about.html">About</a>
    <a href="contact.html">Contact</a>
    <a href="orderform.html">Order Products</a>
    <a href="HomePage.html">Home</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
  <div class="transbox">
    <h1>Thank you for your order! A receipt has been sent to your email.</h1>
  </div>

<?php
  // create short variable names
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $address=$_POST['address'];


  if (!$fname || !$lname || !$email || !$phone || !$address) {
     echo "You have not entered all the required details.<br />"
          ."Please go back and try again.";
     exit;
  }

  if (!get_magic_quotes_gpc()) {
    $fname = addslashes($fname);
    $lname = addslashes($lname);
    $email = addslashes($email);
    $phone = addslashes($phone);
    $address = addslashes($address);
  }

  @ $db = new mysqli('localhost', 'jacob', 'jacobmueller14', 'Secon');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

  $query = "insert into Customer
            (LastName, FirstName, Email, Phone, Address)
            VALUES
            ('".$fname."', '".$lname."', '".$email."', '".$phone."', '".$address."')";
  $result = $db->query($query);


  $db->close();
?>
</body>
</html>
