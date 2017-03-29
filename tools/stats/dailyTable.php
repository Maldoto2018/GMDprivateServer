<h1>Daily Levels</h1>
<table border="1"><tr><th>#</th><th>ID</th><th>Name</th><th>Creator</th><th>Time</tr>
<?php
//error_reporting(0);
include "../../incl/lib/connection.php";
$x = 1;
$query = $db->prepare("SELECT * FROM dailyfeatures ORDER BY feaID DESC");
$query->execute();
$result = $query->fetchAll();
foreach($result as &$daily){
	//basic daily info
	$feaID = $daily["feaID"];
	$levelID = $daily["levelID"];
	$time = $daily["timestamp"];
	echo "<tr><td>$feaID</td><td>$levelID</td>";
	//level name
	$query = $db->prepare("SELECT levelName, userID FROM levels WHERE levelID = :level");
	$query->execute([':level' => $levelID]);
	$level = $query->fetchAll()[0];
	$levelName = $level["levelName"];
	$userID = $level["userID"];
	echo "<td>$levelName</td>";
	//creator name
	$query = $db->prepare("SELECT userName FROM users WHERE userID = :userID");
	$query->execute([':userID' => $userID]);
	$creator = $query->fetchAll()[0]["userName"];
	echo "<td>$creator</td>";
	//timestamp
	$time = date("d/m/Y H:i", $time);
	echo "<td>$time</td></tr>";
}
?>
</table>