// const dropZoneInputs = document.querySelectorAll(".drop-zone__input");

export let renderizarDropImage = () => {

    let inputElements = document.querySelectorAll(".upload-input");

    inputElements.forEach(inputElement => {

        let uploadElement = inputElement.closest(".upload");

        uploadElement.addEventListener("click", (e) => {
            inputElement.click();
        });

        inputElement.addEventListener("change", (e) => {
            if (inputElement.files.length) {
                updateThumbnail(uploadElement, inputElement.files);
            }
        });

        uploadElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            uploadElement.classList.add("upload-over");
        });

        ["dragleave", "dragend"].forEach((type) => {
            uploadElement.addEventListener(type, (e) => {
                uploadElement.classList.remove("upload-over");
            });
        });

        uploadElement.addEventListener("drop", (e) => {
            e.preventDefault();

            if (e.dataTransfer.files.length) {
                inputElement.files = e.dataTransfer.files;
                updateThumbnail(uploadElement, e.dataTransfer.files[0]);
            }

            uploadElement.classList.remove("upload-over");
        });
    });

    function updateThumbnail(uploadElement, files) {

        console.log(files.length);

        for (let index = 0; index < files.length; index++) {
            const file = files[index];

            console.log(files[index]);
            
            let thumbnailElement = uploadElement.querySelector(".upload-thumb");

            if (uploadElement.querySelector(".upload-prompt")) {
                uploadElement.querySelector(".upload-prompt").remove();
            }

            // if (!thumbnailElement) {
                thumbnailElement = document.createElement("div");
                thumbnailElement.classList.add("upload-thumb");
                uploadElement.appendChild(thumbnailElement);
            // }

            thumbnailElement.dataset.label = file.name;

            if (file.type.startsWith("image/")) {
                let reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = () => {
                    thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
                };
            } else {
                thumbnailElement.style.backgroundImage = null;
            }
        }

    }
}