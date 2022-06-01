<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload images!</title>
    <link rel="stylesheet" href="src/main.css">
</head>

<body>
    <form action="?view=upload" method="POST" enctype="multipart/form-data">
        <input type="file" id="file" multiple accept="image/*">
    </form>

    <div id="files-container">

    </div>

    <script>
        const fileInput = document.querySelector('#file');
        const filesContainer = document.querySelector('#files-container');

        fileInput.addEventListener('change', e => {
            const files = e.target.files;
            processFiles(files);
        });

        function processFiles(files) {
            const promises = [];
            for (const file of files) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(file);

                fileReader.addEventListener('load', e => {
                    const url = fileReader.result;
                    const size = parseInt(file.size / 1024) > 1000 ? parseInt((file.size / 1024) / 1024) + 'MB' : parseFloat(file.size / 1024).toFixed(2) + 'kB'
                    const id = 'id' + crypto.randomUUID();
                    const html = `
                        <div class="file-item">
                            <img src="${url}" width="300" />
                            <div>${file.name}</div>
                            <div>${size}</div>
                            <div id="size-${id}">0%</div>
                            <div class="progress-bar" id="${id}"></div>
                        </div>`
                    filesContainer.innerHTML += html;
                    upload(file, id);
                });
            }
        }

        function upload(f, id) {
            return new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                // listen for `upload.load` event
                xhr.upload.onload = () => {
                    console.log(`The upload is completed: ${xhr.status} ${xhr.response}`);
                    resolve();
                };

                // listen for `upload.error` event
                xhr.upload.onerror = () => {
                    console.error('Upload failed.');
                    reject();
                }

                // listen for `upload.abort` event
                xhr.upload.onabort = () => {
                    console.error('Upload cancelled.');
                }

                // listen for `progress` event
                xhr.upload.onprogress = (event) => {
                    const container = document.querySelector('#' + id);
                    const sizeDiv = document.querySelector('#size-' + id);
                    // event.loaded returns how many bytes are downloaded
                    // event.total returns the total number of bytes
                    // event.total is only available if server sends `Content-Length` header
                    console.log(`Uploaded ${event.loaded} of ${event.total} bytes, ${container.id}`);
                    container.style.height = '10px';
                    container.style.backgroundColor = 'blue';
                    container.style.width = ((event.loaded / event.total) * 100) + '%';
                    sizeDiv.textContent = ((event.loaded / event.total) * 100).toFixed(0) + '%';

                }

                // open request
                xhr.open('POST', '?view=upload');

                // prepare a file object
                //const files = document.querySelector('[name=file]').files;
                const file = f;
                const formData = new FormData();
                formData.append('file', file);

                // send request
                xhr.send(formData);

            });
        }
    </script>
</body>

</html>