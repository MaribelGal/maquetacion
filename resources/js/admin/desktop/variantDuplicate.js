import { generateItem } from "./generateOnLoad";

export let renderVariantNavigate = () => {
    let variantsPanels = document.querySelectorAll(".variants-panel");

    variantsPanels.forEach(variantsPanel => {
        let templateItem = document.querySelector(".variant-template");

        
        let nextButton = variantsPanel.querySelector(".variant-navigate-next");
        let previusButton = variantsPanel.querySelector(".variant-navigate-previus");

        let infoTotal = variantsPanel.querySelector(".variant-navigate-total");
        let infoActual = variantsPanel.querySelector(".variant-navigate-actual");


        nextButton.addEventListener("click", () => {
            let variantItems = variantsPanel.querySelectorAll(".variant-item");


            console.log(variantItems);
            let itemActive = selectActiveItem(variantItems, "variant-item_active"); 

            console.log(itemActive);
            itemActive.classList.remove("variant-item_active");
            
            if (itemActive.dataset.variant == (variantItems.length-1)) {
                let actualNumber = variantItems.length;
                let newItem = generateItem(templateItem, actualNumber, itemActive);

                newItem.removeAttribute('hidden');
                newItem.classList.add("variant-item_active");

                infoTotal.textContent = "/" + (actualNumber);
                infoActual.textContent = actualNumber;    
            } else {
                let nextItem = itemActive.nextSibling;
                nextItem.classList.add("variant-item_active");
                infoActual.textContent = nextItem.dataset.variant;
            }

        });


        previusButton.addEventListener("click", () => {
            let variantItems = variantsPanel.querySelectorAll(".variant-item");

            let itemActive = selectActiveItem(variantItems, "variant-item_active");
            itemActive.classList.remove("variant-item_active");

   
            if(itemActive.dataset.variant == 0) {
                let lastItem = variantItems[variantItems.length-1];
                lastItem.classList.add("variant-item_active");
                infoActual.textContent = lastItem.dataset.variant+1;

            } else {
                let previousItem = itemActive.previousSibling;
                previousItem.classList.add("variant-item_active");
                infoActual.textContent = previousItem.dataset.variant+1;
            }


        });
    });
}

let selectActiveItem = (variantItems, classActive) => {
    let active;
    variantItems.forEach((itemPanelVariant) => {
        if (itemPanelVariant.classList.contains(classActive)) {
            active = itemPanelVariant;
        }
    });
    return active;
};