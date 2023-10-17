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
		server: {
			process: {
				url: 'https://api.cloudflare.com/client/v4/accounts/1adf66719c0e0ef72e53038acebcc018/images/v1',
				method: 'POST',
				headers: {
					'Authorization': 'Bearer cy61fvnJ5PhvxJRcidmDNuu07LsGlQIWJAwy61AP',
					'Content-Type': ' multipart/form-data'
				},
				onload: function(response) {
					console.log(response);
				},
				onerror: function(response) {
					console.log(response);
				},
				send: function() {
					const formData = new FormData();
					for (let i = 0; i < this.files.length; i++) {
						formData.append('filepond[]', this.files[i].file);
					}
					axios.post(this.url, formData, {
						headers: this.headers
					})
					.then(response => {
						this.onload(response);
					})
					.catch(error => {
						this.onerror(error);
					});
				}
			},
			revert: {
				url: 'https://api.cloudflare.com/client/v4/accounts/1adf66719c0e0ef72e53038acebcc018/images/v1',
				method: 'DELETE',
				headers: {
					'Authorization': 'Bearer cy61fvnJ5PhvxJRcidmDNuu07LsGlQIWJAwy61AP',
					'Content-Type': ' multipart/form-data'
				},
				onload: function(response) {
					console.log(response);
				},
				onerror: function(response) {
					console.log(response);
				},
				send: function() {
					axios.delete(this.url, {
						headers: this.headers
					})
					.then(response => {
						this.onload(response);
					})
					.catch(error => {
						this.onerror(error);
					});
				}
			}
		},
		onprocessfiles: function(files) {
			const formData = new FormData();
			for (let i = 0; i < files.length; i++) {
				formData.append('filepond[]', files[i].file);
			}
			this.server.process.headers = {
				...this.server.process.headers,
				...formData.getHeaders()
			};
			this.server.process.data = formData;
			this.server.process.send();
		}
	}
);
</script>
<!-- file upload itself is disabled in this pen -->