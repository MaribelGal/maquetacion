// const dropZoneInputs = document.querySelectorAll(".drop-zone__input");
let filesToUpload;
let fileIdCounter;
let fileIdCounterOnload;


export let renderizarDropImage = () => {

    let imagesContainers = document.querySelectorAll(".images-container");

    imagesContainers.forEach(imagesContainer => {
        let inputElement = imagesContainer.querySelector(".upload-input");
        let previewContainer = imagesContainer.querySelector(".preview");

        filesToUpload = {};
        fileIdCounter = 0;
        fileIdCounterOnload = 0;

        let uploadElement = imagesContainer.querySelector(".upload");


        uploadElement.addEventListener("click", (e) => {
            inputElement.click();
        });

        inputElement.addEventListener("change", (e) => {

            if (inputElement.files.length) {

                let alias = inputElement.dataset.alias;
                let content = inputElement.dataset.content;

                for (let index = 0; index < inputElement.files.length; index++) {
                    fileIdCounter++;

                    let file = inputElement.files[index];
                    let fileId = alias + "." + content + "." + fileIdCounter;

                    filesToUpload[fileId] = {
                        file: file,
                        alt: "",
                        title: ""
                    };

                    console.log(filesToUpload);
                    updateThumbnail(previewContainer, file, fileId);
                }
            }
            console.log(filesToUpload);

            filesToUpload = renderizarAcciones(filesToUpload);
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
                updateThumbnail(previewContainer, e.dataTransfer.files[0]);
            }

            uploadElement.classList.remove("upload-over");
        });

    });

    function updateThumbnail(previewContainer, file, fileId) {

        let thumbnailElementPrototype = previewContainer.querySelector(".upload-thumb-prototype");

        console.log(previewContainer);
        let thumbnailElement = thumbnailElementPrototype.cloneNode(true);

        let uploadEditPanel = thumbnailElement.querySelector(".upload-edit-panel");
        uploadEditPanel.dataset.fileId = fileId;

        thumbnailElement.classList.replace("upload-thumb-prototype", "upload-thumb");

        // thumbnailElement.appendChild(thumbnailElementDelete);

        previewContainer.appendChild(thumbnailElement);
        // }

        thumbnailElement.dataset.label = file.name;
        thumbnailElement.dataset.fileid = fileId;

        console.log(thumbnailElement.querySelector(".upload-edit-panel-image"));
        // thumbnailElementEditImage = thumbnailElement.querySelector(".upload-edit-panel-image");
        // console.log(thumbnailElementEditImage);

        if (file.type.startsWith("image/")) {
            let reader = new FileReader();

            reader.readAsDataURL(file);

            reader.onload = () => {
                thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
                thumbnailElement.querySelector(".upload-edit-panel-image").style.backgroundImage = `url('${reader.result}')`;
            };
        } else {
            thumbnailElement.style.backgroundImage = null;
            thumbnailElement.querySelector(".upload-edit-panel-image").style.backgroundImage = null;
        }

    }

}

let renderizarAcciones = (filesToUpload) => {

    let deleteUploadedElements = document.querySelectorAll(".upload-thumb-delete");
    let editUploadedElements = document.querySelectorAll(".upload-thumb-edit");
    let editPanelUploadedElements = document.querySelectorAll(".upload-edit-panel");


    deleteUploadedElements.forEach(deleteUploadedElement => {

        let deleteButtonUploadedElements = deleteUploadedElement.querySelector(".upload-thumb-delete-button");

        deleteButtonUploadedElements.addEventListener("click", () => {
            let uploadThumb = deleteUploadedElement.closest(".upload-thumb");
            let fileId = uploadThumb.dataset.fileid;

            delete filesToUpload[fileId];
            deleteUploadedElement.closest(".upload-thumb").remove();

        });

    });

    editUploadedElements.forEach(editUploadedElement => {
        let editButtonUploadedElements = editUploadedElement.querySelector(".upload-thumb-edit-button");
        let editPanelUploadedElement = editUploadedElement.querySelector(".upload-edit-panel");

        editButtonUploadedElements.addEventListener("click", () => {
            console.log("CLICK TOGGLE VISIBLE");
            editPanelUploadedElement.classList.toggle("visible");
        });

    });

    editPanelUploadedElements.forEach(editPanelUploadedElement => {

        console.log(editPanelUploadedElement);
        let altUploadedElement = editPanelUploadedElement.querySelector(".upload-edit-panel-alt-input");
        let titleUploadedElement = editPanelUploadedElement.querySelector(".upload-edit-panel-alt-input");
        let saveUploadedElement = editPanelUploadedElement.querySelector(".upload-edit-panel-save");
        let closeUploadedElement = editPanelUploadedElement.querySelector(".upload-edit-panel-close");

        saveUploadedElement.addEventListener("click", () => {
            let uploadThumb = editPanelUploadedElement.closest(".upload-thumb");
            let fileId = uploadThumb.dataset.fileid;

            filesToUpload[fileId].alt = altUploadedElement.value;
            filesToUpload[fileId].title = titleUploadedElement.value;
            console.log(filesToUpload);
        });

        closeUploadedElement.addEventListener("click", () => {
            console.log("CLICK TOGGLE VISIBLE");
            editPanelUploadedElement.classList.toggle("visible");
        });

    });

    return filesToUpload;
}


export let appendInputFiles = (datosFormulario) => {

    let counter = 0;

    for (let files in filesToUpload) {
        counter++;

        let file = filesToUpload[files].file;
        let alt = filesToUpload[files].alt;
        let title = filesToUpload[files].title;

        let alias = files.split(".")[0];
        let content = files.split(".")[1];

        // let fileId = alias + "." + content + "." + fileIdCounter;

        let key = "images[" + content + "." + alias + "][" + alt + "." + (counter) + "." + title + "]";

        console.log();
        datosFormulario.append(key, file);
    }

    return datosFormulario;
}

export let resetDropImage = () => {
    let uploadThumbs = document.querySelectorAll(".upload-thumb");
    uploadThumbs.forEach(uploadThumb => {
        // uploadThumb.remove();
    });

    renderizarDropImage();
}