let renderFilterProductGroup = () => {
    let variantsArea = document.getElementById("products-variants-area");

    let productData = document.getElementById("product-data");
    let productImages = document.getElementById("product-images");


    let variantsItems = document.querySelectorAll(".product-variant-item");

    let variants = [];
    let productGroup_id;


    variantsItems.forEach(variantItem => {

        let nameVariant , valueVariant;
        variants = [nameVariant, valueVariant] = [variantItem.dataset.variant.name, variantItem.value];

        variantItem.addEventListener("change", () => {

            let url = variantsArea.dataset.url;

            let enviarPeticion = async () => {
                try {
                    await axios.get(url, {
                        params: {
                            variants,
                            productGroup_id
                        } } 
                        ).then(respuesta => {
                        productData.innerHTML = respuesta.data.productData;
                        productImages.innerHTML = respuesta.data.productImages;
                        // variantsArea.innerHTML = respuesta.data.productVariants;

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