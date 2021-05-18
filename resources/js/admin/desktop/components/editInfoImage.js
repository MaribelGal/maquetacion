let deleteUploadedElements = document.querySelectorAll(".uploaded-thumb-delete");
let editUploadedElements = document.querySelectorAll(".uploaded-thumb-edit");
let editPanelUploadedElements = document.querySelectorAll(".uploaded-edit-panel");

let uploadedElements = document.querySelectorAll(".uploaded-thumb");

export let renderizarEditInfoImage = () => {
    uploadedElements.forEach(uploadedElement => {
        let editButton_uploadedElement = uploadedElement.querySelector(".uploaded-thumb-edit-button");

        let editPanelUploadedElement = uploadedElement.querySelector(".upload-edit-panel");

        editButton_uploadedElement.addEventListener("click", () => {
            editPanelUploadedElement.classList.toggle("visible");
        });
    });
}
