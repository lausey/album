<?php
	$test = false;

	if (!$test) {
		$mysqli = new mysqli('localhost', 'album', 'testpass1', 'album');

		if(isset($_POST['collection'])) {
			$collection_id = $_POST['collection'];
		}
		else
		{
			$collection_id = 1;
		}

		$results = array();

		$stmt = $mysqli->prepare("SELECT filename FROM album_photos WHERE collection_id = ? AND visible = 'Yes'");

		$stmt->bind_param("i", $collection_id);
		
		$stmt->execute();
		$result = $stmt->get_result();

		while($image_row = $result->fetch_assoc()) {
			$results[] = array("image_filename" => $image_row['filename']);
		}
	}
	else
	{
		$results[] = array("image_filename" => "20160801_150151.jpg");
		$results[] = array("image_filename" => "20160801_150301.jpg");
		$results[] = array("image_filename" => "20160801_154558.jpg");
		$results[] = array("image_filename" => "20160801_195209.jpg");
		$results[] = array("image_filename" => "20160802_142216.jpg");
		$results[] = array("image_filename" => "20160803_142638.jpg");
		$results[] = array("image_filename" => "20160803_151243.jpg");
	}

	exit(json_encode($results));
?>