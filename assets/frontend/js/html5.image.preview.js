/*!
 * == HTML5 Image Preview ==
 * Created By: Tomas Dostal
 * Version: 1.0 (05-12-2012)
 * Documentation: http://tomasdostal.com/projects/html5ImagePreview
 *
 * HTML structure:
 *	<div>
 *		<input type="file" name="imagefile" onchange="previewImage(this,{256,128,64},5)">
 *		<div class="imagePreview"></div>
 *	</div>
 *
 */

 function previewImage1(e1,widths,limit){
	var files = e1.files;
	var wrap = e1.parentNode;
	var output = wrap.getElementsByClassName('imagePreview3')[0];
	var allowedTypes = ['JPG','JPEG','GIF','PNG','SVG','WEBP'];

	output.innerHTML='Loading...';

	var file = files[0];
	var imageType = /image.*/;

	// detect device
	var device = detectDevice();

	if (!device.android){ // Since android doesn't handle file types right, do not do this check for phones
		if (!file.type.match(imageType)) {
			var description = document.createElement('p');
			output.innerHTML='';
			description.innerHTML='This is not valid Image file';
			output.appendChild(description);
			return false;
		}
	}

	var img='';

	var reader = new FileReader();
	reader.onload = (function(aImg) {
		return function(ee1) {
			output.innerHTML='';

			var format = ee1.target.result.split(';');
			format = format[0].split('/');
    		format = format[1].split('+');
			format = format[0].toUpperCase();

			// We will change this for an android
			if (device.android){
				format = file.name.split('.');
        		format = format[format.length-1].split('+');
				format = format[0].toUpperCase();
			}
			
			var description = document.createElement('p');
			//description.innerHTML = '<br />This is a <b>'+format+'</b> image, size of <b>'+(e.total/1024).toFixed(2)+'</b> KB.';

			if (allowedTypes.indexOf(format)>=0 && ee1.total<(limit*1024*1024)){
				for (var size in widths){
					var image = document.createElement('img');
					var src = ee1.target.result;

					// very nasty hack for android
					// This actually injects a small string with format into a temp image.
					/*if (device.android){
						src = src.split(':');
						if (src[1].substr(0,4) == 'base'){
							src = src[0] + ':image/'+format.toLowerCase()+';'+src[1];
						}
					}*/
										
					image.src = src;

					image.width = widths[size];
					image.title = 'Image preview '+widths[size]+'px';
					output.appendChild(image);
				}

				//description.innerHTML += '<br /><span style="color:green;">Picture seems to be fine for upload.</span>';
			} else {
			    description.innerHTML += '<br /><span style="color:red;">Which is wrong format / size! Accepted formats: '+allowedTypes.join(', ')+'. Size limit is: '+limit+'MB</span>';
			}						

			output.appendChild(description);
		};
	})(img);
	reader.readAsDataURL(file);
}



 function previewImage2(e2,widths,limit){
	var files = e2.files;
	var wrap = e2.parentNode;
	var output = wrap.getElementsByClassName('imagePreview2')[0];
	var allowedTypes = ['JPG','JPEG','GIF','PNG','SVG','WEBP'];

	output.innerHTML='Loading...';

	var file = files[0];
	var imageType = /image.*/;

	// detect device
	var device = detectDevice();

	if (!device.android){ // Since android doesn't handle file types right, do not do this check for phones
		if (!file.type.match(imageType)) {
			var description = document.createElement('p');
			output.innerHTML='';
			description.innerHTML='This is not valid Image file';
			output.appendChild(description);
			return false;
		}
	}

	var img='';

	var reader = new FileReader();
	reader.onload = (function(aImg) {
		return function(ee2) {
			output.innerHTML='';

			var format = ee2.target.result.split(';');
			format = format[0].split('/');
    		format = format[1].split('+');
			format = format[0].toUpperCase();

			// We will change this for an android
			if (device.android){
				format = file.name.split('.');
        		format = format[format.length-1].split('+');
				format = format[0].toUpperCase();
			}
			
			var description = document.createElement('p');
			//description.innerHTML = '<br />This is a <b>'+format+'</b> image, size of <b>'+(e.total/1024).toFixed(2)+'</b> KB.';

			if (allowedTypes.indexOf(format)>=0 && ee2.total<(limit*1024*1024)){
				for (var size in widths){
					var image = document.createElement('img');
					var src = ee2.target.result;

					// very nasty hack for android
					// This actually injects a small string with format into a temp image.
					/*if (device.android){
						src = src.split(':');
						if (src[1].substr(0,4) == 'base'){
							src = src[0] + ':image/'+format.toLowerCase()+';'+src[1];
						}
					}*/
										
					image.src = src;

					image.width = widths[size];
					image.title = 'Image preview '+widths[size]+'px';
					output.appendChild(image);
				}

				//description.innerHTML += '<br /><span style="color:green;">Picture seems to be fine for upload.</span>';
			} else {
			    description.innerHTML += '<br /><span style="color:red;">Which is wrong format / size! Accepted formats: '+allowedTypes.join(', ')+'. Size limit is: '+limit+'MB</span>';
			}						

			output.appendChild(description);
		};
	})(img);
	reader.readAsDataURL(file);
}



 function previewImage3(e3,widths,limit){
	var files = e3.files;
	var wrap = e3.parentNode;
	var output = wrap.getElementsByClassName('imagePreview3')[0];
	var allowedTypes = ['JPG','JPEG','GIF','PNG','SVG','WEBP'];

	output.innerHTML='Loading...';

	var file = files[0];
	var imageType = /image.*/;

	// detect device
	var device = detectDevice();

	if (!device.android){ // Since android doesn't handle file types right, do not do this check for phones
		if (!file.type.match(imageType)) {
			var description = document.createElement('p');
			output.innerHTML='';
			description.innerHTML='This is not valid Image file';
			output.appendChild(description);
			return false;
		}
	}

	var img='';

	var reader = new FileReader();
	reader.onload = (function(aImg) {
		return function(ee3) {
			output.innerHTML='';

			var format = ee3.target.result.split(';');
			format = format[0].split('/');
    		format = format[1].split('+');
			format = format[0].toUpperCase();

			// We will change this for an android
			if (device.android){
				format = file.name.split('.');
        		format = format[format.length-1].split('+');
				format = format[0].toUpperCase();
			}
			
			var description = document.createElement('p');
			//description.innerHTML = '<br />This is a <b>'+format+'</b> image, size of <b>'+(e.total/1024).toFixed(2)+'</b> KB.';

			if (allowedTypes.indexOf(format)>=0 && ee3.total<(limit*1024*1024)){
				for (var size in widths){
					var image = document.createElement('img');
					var src = ee3.target.result;

					// very nasty hack for android
					// This actually injects a small string with format into a temp image.
					/*if (device.android){
						src = src.split(':');
						if (src[1].substr(0,4) == 'base'){
							src = src[0] + ':image/'+format.toLowerCase()+';'+src[1];
						}
					}*/
										
					image.src = src;

					image.width = widths[size];
					image.title = 'Image preview '+widths[size]+'px';
					output.appendChild(image);
				}

				//description.innerHTML += '<br /><span style="color:green;">Picture seems to be fine for upload.</span>';
			} else {
			    description.innerHTML += '<br /><span style="color:red;">Which is wrong format / size! Accepted formats: '+allowedTypes.join(', ')+'. Size limit is: '+limit+'MB</span>';
			}						

			output.appendChild(description);
		};
	})(img);
	reader.readAsDataURL(file);
}

// Detect client's device
function detectDevice(){
	var ua = navigator.userAgent;
	var brand = {
		apple: ua.match(/(iPhone|iPod|iPad)/),
		blackberry: ua.match(/BlackBerry/),
		android: ua.match(/Android/),
		microsoft: ua.match(/Windows Phone/),
		zune: ua.match(/ZuneWP7/)
	}

	return brand;
}
