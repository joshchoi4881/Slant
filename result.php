<?php
	include("database.php");
	$id = $_GET["id"];
	$response = $_GET["response"];
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
?>