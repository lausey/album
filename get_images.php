<?php
	$test = false;

	if (!$test) {
		$db = mysqli_connect('localhost', 'album', 'testpass1', 'album');
		if(isset($_POST['collection'])) {
			$collection_id = mysqli_real_escape_string($db, $_POST['collection']);
		}
		else
		{
			$collection_id = 1;
		}

		$results = array();

		$get_images = <<<SQL
			select filename from album_photos
			where collection_id = $collection_id
			and visible = 'Yes'
SQL;

		$image_query = mysqli_query($db, $get_images) or die(mysqli_error($db));

		while($image_row = mysqli_fetch_array($image_query)) {
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