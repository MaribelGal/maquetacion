let renderFilterProductGroup = () => {
    let variantsArea = document.getElementById("product-variants-area");
    let variantsForm = document.getElementById("product-variants-form");

    let productData = document.getElementById("product-data");
    let productImages = document.getElementById("product-images");

    let variantsItems = variantsForm.querySelectorAll(".product-variant-item");

    let dataFormOld = new FormData(variantsForm);

    let itemChanged;

    variantsItems.forEach(variantItem => {
        let variantItemsData = variantItem.querySelectorAll(".product-variant-item-data");


        variantItemsData.forEach(variantDataItem => {
            variantDataItem.addEventListener("change", () => {
                itemChanged = variantDataItem;
            });
        });

        variantItem.addEventListener("change", () => {
            let url = variantsForm.action;
            let dataForm = new FormData(variantsForm);

            dataForm.append(itemChanged.dataset.variantName, itemChanged.value);

            console.log(itemChanged);

            for (var entrada of dataForm.entries()) {
                console.log(entrada[0] + ": " + entrada[1]);
            }

            let enviarPeticion = async () => {
                try {
                    await axios.post(url, dataForm).then(respuesta => {
                        productData.innerHTML = respuesta.data.productData;
                        productImages.innerHTML = respuesta.data.productImages;
                        variantsArea.innerHTML = respuesta.data.productVariants;

                        renderFilterProductGroup();
                    })
                } catch (error) {
                    console.log(error);
                }
            };

            enviarPeticion();
        });

    });
};

renderFilterProductGroup();

let showDataForm = (datosFormulario) => {
    for (var entrada of datosFormulario.entries()) {
        console.log(entrada[0] + ": " + entrada[1]);
    }
}