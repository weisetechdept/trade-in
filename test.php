<link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet">
<link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
<style>
    /**
 * FilePond Custom Styles
 */
.filepond--drop-label {
	color: #4c4e53;
}

.filepond--label-action {
	text-decoration-color: #babdc0;
}

.filepond--panel-root {
	border-radius: 2em;
	background-color: #edf0f4;
	height: 1em;
}

.filepond--item-panel {
	background-color: #595e68;
}

.filepond--drip-blob {
	background-color: #7f8a9a;
}


/**
 * Page Styles
 */
html {
	padding:30vh 0 0;
}

body {
	max-width: 20em;
	margin: 0 auto;
}
</style>
<!--
The classic file input element we'll enhance to a file pond
-->
<input type="file" 
       class="filepond"
       name="filepond"
       multiple
       data-max-file-size="300MB"
       data-max-files="3" />

<script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
/*
We want to preview images, so we need to register the Image Preview plugin
*/
FilePond.registerPlugin(
	
	// encodes the file as base64 data
  FilePondPluginFileEncode,
	
	// validates the size of the file
	FilePondPluginFileValidateSize,
	
	// corrects mobile image orientation
	FilePondPluginImageExifOrientation,
	
	FilePondPluginFilePoster,
	
	// previews dropped images
  	FilePondPluginImagePreview
);


// Select the file input and use create() to turn it into a pond
FilePond.create(
	document.querySelector('input'),
	{
		multiple: true,
		maxFiles: 3,
		allowFileTypeValidation: true,
		acceptedFileTypes: ['image/*'],
		maxFileSize: '300MB',
		onprocessfiles: (files) => {
			const formData = new FormData();
			files.forEach((file) => {
				formData.append('filepond', file.file);
			});
			axios.post('https://api.cloudflare.com/client/v4/accounts/1adf66719c0e0ef72e53038acebcc018/stream', formData, {
				headers: {
					'Content-Type': 'multipart/form-data',
					'Authorization': 'Bearer x2skj57v2poPW8UxIQGqBACBxkJ4Glg42lVhbDPe'
				}
			})
			.then((response) => {
				console.log(response);
			})
			.catch((error) => {
				console.log(error);
			});
		}
	}
);
</script>
