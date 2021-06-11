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

            let itemActive = selectActiveItem(variantItems, "variant-item_active"); 

            console.log(itemActive);

            itemActive.classList.remove("variant-item_active");
            itemActive.toggleAttribute('hidden');

            if (itemActive.dataset.variant == (variantItems.length-1)) {
                let actualNumber = variantItems.length;
                let newItem = generateItem(templateItem, actualNumber, itemActive);

                newItem.toggleAttribute('hidden');

                infoTotal.textContent = "/" + (actualNumber+1);
                infoActual.textContent = actualNumber+1;    
            } else {
                console.log('else');
                
                let nextItem = itemActive.nextSibling;
                nextItem.classList.add("variant-item_active");
                nextItem.toggleAttribute('hidden');

                console.log(nextItem);

                infoActual.textContent = Number(nextItem.dataset.variant)+1;
            }

        });


        previusButton.addEventListener("click", () => {
            let variantItems = variantsPanel.querySelectorAll(".variant-item");
            
            console.log(variantItems);
            let itemActive = selectActiveItem(variantItems, "variant-item_active");
            itemActive.classList.remove("variant-item_active");
            itemActive.toggleAttribute('hidden');

            if(itemActive.dataset.variant == 0) {
                let lastItem = variantItems[variantItems.length-1];
                lastItem.classList.add("variant-item_active");
                lastItem.toggleAttribute('hidden');

                infoActual.textContent = variantItems.length;

            } else {
                let previousItem = itemActive.previousSibling;
                previousItem.classList.add("variant-item_active");
                previousItem.toggleAttribute('hidden');
                
                infoActual.textContent = Number(previousItem.dataset.variant)+1;
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
