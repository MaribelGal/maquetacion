export let renderizarDropImage_single = () => {


    let inputElements = document.querySelectorAll(".upload-input-single");

    inputElements.forEach(inputElement => {

        let uploadElement = inputElement.closest(".upload-single");

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
            uploadElement.classList.add("upload-over-single");
        });

        ["dragleave", "dragend"].forEach((type) => {
            uploadElement.addEventListener(type, (e) => {
                uploadElement.classList.remove("upload-over-single");
            });
        });

        uploadElement.addEventListener("drop", (e) => {
            e.preventDefault();

            if (e.dataTransfer.files.length) {
                inputElement.files = e.dataTransfer.files;
                updateThumbnail(uploadElement, e.dataTransfer.files[0]);
            }

            uploadElement.classList.remove("upload-over-single");
        });
    });

    function updateThumbnail(uploadElement, files) {

        console.log(files.length);

        for (let index = 0; index < files.length; index++) {
            const file = files[index];

            console.log(files[index]);

            let thumbnailElement = uploadElement.querySelector(".upload-thumb-image-item");
            let inputElement = uploadElement.querySelector(".upload-input-single");

            if (uploadElement.querySelector(".upload-prompt-single")) {
                uploadElement.querySelector(".upload-prompt-single").remove();
            }

            // if (!thumbnailElement) {
            //     thumbnailElement = document.createElement("div");
            //     thumbnailElement.classList.add("upload-thumb-single");
            //     uploadElement.appendChild(thumbnailElement);
            // }

            thumbnailElement.dataset.label = file.name;

            if (file.type.startsWith("image/")) {
                let reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = () => {
                    thumbnailElement.src = reader.result;
                    inputElement.name = "images[" + inputElement.dataset.content + "." + inputElement.dataset.alias + "][.]"
                };
            } else {
                thumbnailElement.src= null;
            }
        }
    }


    let imageSingle = document.querySelectorAll(".image-single");


    imageSingle.forEach(imageSingle => {

        let uploadActions_single = imageSingle.querySelector(".upload-actions-single");
        let uploadThumbImage = imageSingle.querySelector(".upload-thumb-image-single");
        let uploadSingle = imageSingle.querySelector(".upload-single");

        let deleteUploadElement = uploadActions_single.querySelector(".upload-thumb-delete-single");
        let editUploadElement = uploadActions_single.querySelector(".upload-thumb-edit-single");
        let editPanelUploadElement = uploadActions_single.querySelector(".upload-edit-panel");


        console.log(uploadActions_single);
        console.log(deleteUploadElement);
        let deleteButtonUploadElements = deleteUploadElement.querySelector(".upload-thumb-delete-button");

        deleteButtonUploadElements.addEventListener("click", () => {
            uploadThumbImage.querySelector(".upload-thumb-image-item").src = "";
            uploadSingle.querySelector(".upload-input-single").value = null;
        });

        let editButtonUploadElements = editUploadElement.querySelector(".upload-thumb-edit-button");


        let action_editButtonUploadElements = () => {
            console.log(editButtonUploadElements);
            editPanelUploadElement.classList.toggle("visible");
        }

        editButtonUploadElements.addEventListener("click", action_editButtonUploadElements);


        let altUploadedElement = editPanelUploadElement.querySelector(".upload-edit-panel-alt-input");
        let titleUploadedElement = editPanelUploadElement.querySelector(".upload-edit-panel-alt-input");
        let saveUploadedElement = editPanelUploadElement.querySelector(".upload-edit-panel-save");
        let closeUploadedElement = editPanelUploadElement.querySelector(".upload-edit-panel-close");

        saveUploadedElement.addEventListener("click", () => {
            let inputElement = imageSingle.querySelector(".upload-input-single");
            let uploadThumb = editPanelUploadElement.closest(".upload-thumb");

            inputElement.name = "images[" + inputElement.dataset.content + "." + inputElement.dataset.alias + "]["+altUploadedElement.value+"."+titleUploadedElement.value+"]";

            console.log(inputElement.name);
        });

        closeUploadedElement.addEventListener("click", () => {
            editPanelUploadElement.classList.toggle("visible");
        });

    });
}