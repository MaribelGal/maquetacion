let renderFilterProductGroup = () => {
    let variantsArea = document.getElementById("products-variants-area");

    let productData = document.getElementById("product-data");
    let productImages = document.getElementById("product-images");


    let variantsItems = document.querySelectorAll(".product-variant-item");

    variantsItems.forEach(variantItem => {

        variantItem.addEventListener("change", () => {

            let url;

            let enviarPeticion = async () => {
                try {
                    await axios.get(url).then(respuesta => {
                        productData.innerHTML = respuesta.data.productData;
                        productImages.innerHTML = respuesta.data.productImages;
                        // variantsArea.innerHTML = respuesta.data.variantsArea;

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