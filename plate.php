<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


$sql = "SELECT id FROM users";
$result = $conn->query($sql);

//$id=34456;

$LETTERS=["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $id=$row["id"];

    if($id<26000)
	{
		$secHalf= $id % 1000;
		$result = $id / 1000;
		$integer_part = floor($result);

		$tempVal = $integer_part / 26;

		$tempInteger = floor($tempVal);

		$decimal_part = $tempVal - $tempInteger;

		echo (int)$decimal_part;
		
		echo "AA".$LETTERS[(int)$decimal_part+1].$secHalf;
	}

	else if($id<2600000)
	{

		$tempId="";
		$tempVal=0;

		$secHalf= $id % 1000;
		$result = $id / 1000;

		$integer_part = floor($result);

		$tempVal = $integer_part ;

		while($tempVal>=1)
		{
			$x = $tempVal  / 26;
			$y = floor($x);
			$z = $x - $y;

			$tempVal = $y ;

			$z=(int)($z*26);

			if($tempId=="")
				$tempId=$LETTERS[$z].$secHalf;
			else
				$tempId=$LETTERS[(int)$z].$tempId;
		}

		echo "A".$tempId;
	}
	elseif($id<1000)
		echo "AAA".$id;
	else if($id<100)
		echo "AAA0".$id;

	else if($id<10)
		echo "AAA00".$id;
	else
	{

		$tempId="";
		$tempVal=0;

		$secHalf= $id % 1000;
		$result = $id / 1000;

		$integer_part = floor($result);

		$tempVal = $integer_part ;

		while($tempVal>=1)
		{

			$x = $tempVal  / 26;
			$y = floor($x);
			$z = $x - $y;

			$z=truncate_decimal($z, 2)*26+1;

			
			if($tempId=="")
				$tempId=$LETTERS[$z].$secHalf;
			else
				$tempId=$LETTERS[$z].$tempId;


			$tempVal = $y;
		}

		echo $tempId;
	}


  }
} else {
  echo "0 results";
}
$conn->close();



function truncate_decimal($number, $precision) {
    $multiplier = pow(10, $precision);
    if ($number >= 0) {
        return floor($number * $multiplier) / $multiplier;
    } else {
        return ceil($number * $multiplier) / $multiplier;
    }
}


?>
