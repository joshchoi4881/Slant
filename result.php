<?php
	include("database.php");
	$id = $_GET["id"];
	$response = $_GET["response"];
	$type = $_GET["type"];
	if($type == "yesno") {
		$yes = database::query("SELECT yes FROM posts WHERE id=:id", array(":id"=>$id))[0]["yes"];
		$idk = database::query("SELECT idk FROM posts WHERE id=:id", array(":id"=>$id))[0]["idk"];
		$no = database::query("SELECT no FROM posts WHERE id=:id", array(":id"=>$id))[0]["no"];
		if($response == "yes") {
			$yes += 1;
			database::query("UPDATE posts SET yes=:yes WHERE id=:id", array(":yes"=>$yes, ":id"=>$id));
		}
		else if($response == "idk") {
			$idk += 1;
			database::query("UPDATE posts SET idk=:idk WHERE id=:id", array(":idk"=>$idk, ":id"=>$id));
		} else {
			$no += 1;
			database::query("UPDATE posts SET no=:no WHERE id=:id", array(":no"=>$no, ":id"=>$id));
		}
		$total = $yes + $idk + $no;
		$yesPercent = number_format((float)$yes / ($total), 2, ".", "") * 100;
		$idkPercent = number_format((float)$idk / ($total), 2, ".", "") * 100;
		$noPercent = number_format((float)$no / ($total), 2, ".", "") * 100;
		echo "<p>Yes: ".$yes." (".$yesPercent."%)<br /><meter min='0' max='100' value=".$yesPercent."></meter>
			<br />Not Sure: ".$idk." (".$idkPercent."%)<br /><meter min='0' max='100' value=".$idkPercent." low='.00001' high='100' optimum='0'></meter>
			<br />No: ".$no." (".$noPercent."%)<br /><meter min='0' max='100' value=".$noPercent." low='.00001' high='.0001' optimum='0'></meter></p>";
		echo "<p>Total: ".$total."</p><br>";
	}
	else if($type == "num") {
		$one = database::query("SELECT one FROM posts WHERE id=:id", array(":id"=>$id))[0]["one"];
		$two = database::query("SELECT two FROM posts WHERE id=:id", array(":id"=>$id))[0]["two"];
		$three = database::query("SELECT three FROM posts WHERE id=:id", array(":id"=>$id))[0]["three"];
		$four = database::query("SELECT four FROM posts WHERE id=:id", array(":id"=>$id))[0]["four"];
		$five = database::query("SELECT five FROM posts WHERE id=:id", array(":id"=>$id))[0]["five"];
		$six = database::query("SELECT six FROM posts WHERE id=:id", array(":id"=>$id))[0]["six"];
		$seven = database::query("SELECT seven FROM posts WHERE id=:id", array(":id"=>$id))[0]["seven"];
		$eight = database::query("SELECT eight FROM posts WHERE id=:id", array(":id"=>$id))[0]["eight"];
		$nine = database::query("SELECT nine FROM posts WHERE id=:id", array(":id"=>$id))[0]["nine"];
		$ten = database::query("SELECT ten FROM posts WHERE id=:id", array(":id"=>$id))[0]["ten"];
		if($response == "one") {
			$one += 1;
			database::query("UPDATE posts SET one=:one WHERE id=:id", array(":one"=>$one, ":id"=>$id));
		}
		else if($response == "two") {
			$two += 1;
			database::query("UPDATE posts SET two=:two WHERE id=:id", array(":two"=>$two, ":id"=>$id));
		}
		else if($response == "three") {
			$three += 1;
			database::query("UPDATE posts SET three=:three WHERE id=:id", array(":three"=>$three, ":id"=>$id));
		}
		else if($response == "four") {
			$four += 1;
			database::query("UPDATE posts SET four=:four WHERE id=:id", array(":four"=>$four, ":id"=>$id));
		}
		else if($response == "five") {
			$five += 1;
			database::query("UPDATE posts SET five=:five WHERE id=:id", array(":five"=>$five, ":id"=>$id));
		}
		else if($response == "six") {
			$six += 1;
			database::query("UPDATE posts SET six=:six WHERE id=:id", array(":six"=>$six, ":id"=>$id));
		}
		else if($response == "seven") {
			$seven += 1;
			database::query("UPDATE posts SET seven=:seven WHERE id=:id", array(":seven"=>$seven, ":id"=>$id));
		}
		else if($response == "eight") {
			$eight += 1;
			database::query("UPDATE posts SET eight=:eight WHERE id=:id", array(":eight"=>$eight, ":id"=>$id));
		}
		else if($response == "nine") {
			$nine += 1;
			database::query("UPDATE posts SET nine=:nine WHERE id=:id", array(":nine"=>$nine, ":id"=>$id));
		}
		else if($response == "ten") {
			$ten += 1;
			database::query("UPDATE posts SET ten=:ten WHERE id=:id", array(":ten"=>$ten, ":id"=>$id));
		}
		$total = $one + $two + $three + $four + $five + $six + $seven + $eight + $nine + $ten;
		$sum = ($one * 1) + ($two * 2) + ($three * 3) + ($four * 4) + ($five * 5) + ($six * 6) + ($seven * 7) + ($eight * 8) + ($nine * 9) + ($ten * 10);
		$average = number_format((float)$sum / ($total), 2, ".", "");
		echo "<p>Average: ".$average."<br /><meter min='0' max='10' value=".$average."></meter>";
		echo "<p>Total: ".$total."</p><br>";
	}
?>