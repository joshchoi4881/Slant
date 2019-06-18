<?php
	include("database.php");
	$id = $_GET["id"];
	$response = $_GET["response"];
	$yes = database::query("SELECT yes FROM posts WHERE id=:id", array(":id"=>$id))[0]["yes"];
	$no = database::query("SELECT no FROM posts WHERE id=:id", array(":id"=>$id))[0]["no"];
	if($response == "yes") {
		$yes += 1;
		database::query("UPDATE posts SET yes=:yes WHERE id=:id", array(":yes"=>$yes, ":id"=>$id));
	} else {
		$no += 1;
		database::query("UPDATE posts SET no=:no WHERE id=:id", array(":no"=>$no, ":id"=>$id));
	}
	$total = $yes + $no;
	$yesPercent = number_format((float)$yes / ($total), 2, ".", "") * 100;
	$noPercent = number_format((float)$no / ($total), 2, ".", "") * 100;
	echo "<p>Yes: ".$yes." (".$yesPercent."%)<br />No: ".$no." (".$noPercent."%)</p>";
	echo "<p>Total: ".$total."</p><br>";
	echo "<p>Yes <meter min='0' max='100' value=".$yesPercent."></meter> No</p>";
?>