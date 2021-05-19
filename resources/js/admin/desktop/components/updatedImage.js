export let renderizarUpdatedImage = () => {
    let uploadedThumbs = document.querySelectorAll(".uploaded-thumb");

    uploadedThumbs.forEach(uploadedThumb => {
        showEditPanel_UpdatedImage(uploadedThumb);
        deleteUploadedImage(uploadedThumb);
        editSeoUploadedImage(uploadedThumb);
        closePanelSeo_UpdatedImage(uploadedThumb);
    });
}

// renderizarUpdatedImage();


let showEditPanel_UpdatedImage = (uploadedThumb) => {

    let editButton_uploadedElement = uploadedThumb.querySelector(".uploaded-thumb-edit-button");

    let editPanelUploadedElement = uploadedThumb.querySelector(".uploaded-edit-panel");

    editButton_uploadedElement.addEventListener("click", () => {
        editPanelUploadedElement.classList.toggle("visible");
    });
}

let deleteUploadedImage = (uploadedThumb) => {

    let uploadedThumb_deleteButton = uploadedThumb.querySelector(".uploaded-thumb-delete-button")

    uploadedThumb_deleteButton.addEventListener("click", () => {
        let url = uploadedThumb_deleteButton.dataset.route;
        let imageId = uploadedThumb.dataset.imageid;

        console.log("click en delete");
        console.log(url);
        console.log(imageId);

        let sendImageDeleteRequest = async () => {
            try {
                axios.get(url, {
                    params: {
                        'image': imageId
                    }
                }).then(response => {
                    // stopWait();
                    // showMessage('success', response.data.message);
                    uploadedThumb.remove();
                });

            } catch (error) { }
        };
        sendImageDeleteRequest();
    });

}

let editSeoUploadedImage = (uploadedThumb) => {
    let uploadedThumb_saveSeoButton = uploadedThumb.querySelector(".uploaded-edit-panel-save")

    uploadedThumb_saveSeoButton.addEventListener("click", () => {

        // console.log("edit seo uploaded image CLICK");
        let imageId = uploadedThumb.dataset.imageid;
        let alt = uploadedThumb.querySelector(".uploaded-edit-panel-alt-input").value;
        let title = uploadedThumb.querySelector(".uploaded-edit-panel-title-input").value;
        let url = uploadedThumb_saveSeoButton.dataset.route;

        let sendImagePostRequest = async () => {
            try {
                axios.post(url, {
                    'image': imageId,
                    'alt': alt,
                    'title': title
                })
                    .then(response => {
                        // modal.classList.remove('modal-active');
                        // stopWait();
                        // showMessage('success', response.data.message);
                    });
            } catch (error) { console.log("error"); }
        };

        sendImagePostRequest();
    });
}

let closePanelSeo_UpdatedImage = (uploadedThumb) => {
    let closeButton_uploadedThumb = uploadedThumb.querySelector(".uploaded-edit-panel-close");
    let editPanelUploadedElement = uploadedThumb.querySelector(".uploaded-edit-panel");

    closeButton_uploadedThumb.addEventListener("click", () => {
        console.log("CLICK TOGGLE VISIBLE");
        editPanelUploadedElement.classList.toggle("visible");
    });
}