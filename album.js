var image_filenames = [];
var image_idx = 0;
var test = false;

window.fadeIn = function(obj) {
	$(obj).fadeIn("slow");
}

function load_image() {
	if (image_filenames.length > 0) {
		$('#image_obj').fadeOut("slow", function() {
			$('#image_obj').attr("src", "images/" + image_filenames[image_idx]);
		});
	}
}
function load() {

	if (test) {
		image_filenames.push("20160801_150151.jpg");
		image_filenames.push("20160801_150301.jpg");
		
		load_image();
	}
	else
	{
		$.ajax({
			type: "POST",
			url: "get_images.php",
			async: true,
			data: {collection: 1},
			dataType: 'json',
			success: function (data) {
				for (var idx = 0; idx < data.length; idx++) {
					var image_data = data[idx];
					image_filenames.push(image_data.image_filename);
				}
				load_image();
			}
		});
	}
}

function change_image(direction) {
	if (image_filenames.length > 0) {
		image_idx = image_idx + direction;
		
		
		if (image_idx == -1) {
			image_idx = image_filenames.length - 1;
		}
		
		if (image_idx == image_filenames.length) {
			image_idx = 0;
		}

		load_image();
	}
}