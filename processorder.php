<?php
  // create short variable names
  $bondqty = $_POST['bondqty'];
  $spongeqty = $_POST['spongeqty'];
  $rubberqty = $_POST['rubberqty'];
  $polyeqty = $_POST['polyeqty'];
  $polyuqty = $_POST['polyuqty'];
  $poronqty = $_POST['poronqty'];
  $foamqty = $_POST['foamqty'];
  $tapeqty = $_POST['tapeqty'];
  $filmqty = $_POST['filmqty'];
  $find = $_POST['find'];
  $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
  $date = date('H:i, jS F Y');
?>
<html>
<head>
  <title>Sawcon Rubber - Order Results</title>
</head>
<body>
<h1>Sawcon Rubber</h1>
<h2>Order Results</h2>
<?php
	echo "<p>Order processed at ".date('H:i, jS F Y')."</p>";
	echo "<p>Your order is as follows: </p>";
	$totalqty = 0;
	$totalqty = $bondqty + $spongeqty + $rubberqty + $polyeqty + $polyuqty + $poronqty + $foamqty + $tapeqty + $filmqty;
	echo "Items ordered: ".$totalqty."<br />";
	if ($totalqty == 0) {
	  echo "You did not order anything on the previous page!<br />";
	} else {
	  if ($bondqty > 0) {
		echo $bondqty." bonding tapes<br />";
	  }
	  if ($spongeqty > 0) {
		echo $spongeqty." Sponges<br />";
	  }
	  if ($rubberqty > 0) {
		echo $rubberqty." Dense Rubber<br />";
	  }
	  if ($polyeqty > 0) {
		echo $polyeqty." Polyethelyne<br />";
	  }
	  if ($polyuqty > 0) {
		echo $polyuqty." Polyurethane<br />";
	  }
	  if ($poronqty > 0) {
		echo $poronqty." Poron<br />";
	  }
  	  if ($foamqty > 0) {
		echo $foamqty." PVC Foams<br />";
	  }
	  if ($tapeqty > 0) {
		echo $tapeqty." Tapes<br />";
	  }
	  if ($filmqty > 0) {
		echo $filmqty." Films<br />";
	  }
	}
	$totalamount = 0.00;

	@ $db = new mysqli('localhost', 'jacob', 'jacobmueller14', 'Secon');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }
	$query = "SELECT * FROM Products";
	$result = $db->query($query);
	while($row = $result->fetch_assoc()){
		switch($row['ProductId']){
			case'bond':
				define('BONDPRICE', $row['ProductPrice']);
				break;
			case'sponge':				
				define('SPONGEPRICE', $row['ProductPrice']);
				break;
			case'rubber':
				define('RUBBERPRICE', $row['ProductPrice']);
				break;
			case'polye':
				define('POLYEPRICE', $row['ProductPrice']);
				break;
			case'polyu':
				define('POLYUPRICE', $row['ProductPrice']);
				break;
			case'poron':
				define('PORONPRICE', $row['ProductPrice']);
				break;
			case'foam':
				define('FOAMPRICE', $row['ProductPrice']);
				break;
			case'tape':
				define('TAPEPRICE', $row['ProductPrice']);
				break;
			case'film':
				define('FILMPRICE', $row['ProductPrice']);
				break;
		}
	}
		
	$totalamount = $bondqty * BONDPRICE
				 + $spongeqty * SPONGEPRICE
				 + $rubberqty * RUBBERPRICE
				 + $polyeqty * POLYEPRICE
				 + $polyuqty * POLYUPRICE
				 + $poronqty * PORONPRICE
				 + $foamqty * FOAMPRICE
				 + $tapeqty * TAPEPRICE
				 + $filmqty * FILMPRICE;
	$totalamount=number_format($totalamount, 2, '.', ' ');
	echo "Subtotal: $".number_format($totalamount,2)."<br />";
	$taxrate = 0.10;  // local sales tax is 10%
	$totalamount = $totalamount * (1 + $taxrate);
	echo "Total including tax: $".number_format($totalamount,2)."<br />";
	if($find == "a") {
	  echo "<p>Regular customer.</p>";
	} elseif($find == "b") {
	  echo "<p>Customer referred by TV advertisement.</p>";
	} elseif($find == "c") {
	  echo "<p>Customer referred by internet advertisement.</p>";
	} elseif($find == "d") {
	  echo "<p>Customer referred by radio advertisement.</p>";
	} elseif($find == "e"){
	  echo "<p>Customer referred by family or friend.</p>";
	}
	else {
	  echo "<p>We do not know how this customer found us.</p>";
	}
	$db->close();
?>
<div id="center_button"><button onclick="location.href='register.html'">Input Customer Information</button></div>
</body>
</html>

	