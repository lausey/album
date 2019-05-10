<?php
	$db = mysqli_connect('localhost', 'album', 'testpass1', 'album');
	$collection_id = 1;

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
	
	print_r($results);
?>