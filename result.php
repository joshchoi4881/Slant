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
	$yesPercent = number_format((float)$yes / ($yes + $no) * 100, 2, ".", "");
	$noPercent = number_format((float)$no / ($yes + $no) * 100, 2, ".", "");
	echo "<h1>Yes: ".$yesPercent."%<br />No: ".$noPercent."%</h1>";
?>