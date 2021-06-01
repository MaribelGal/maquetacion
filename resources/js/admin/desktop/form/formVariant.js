export let renderizarFormVariant = () => {
    let panelsVariants = document.querySelectorAll(".panel-variants");

    panelsVariants.forEach((panelVariants) => {

        let templatePanelVariant =
            panelVariants.querySelector("#variant-template");

        
        let nextButton = panelVariants.querySelector(
            ".panel-variant-navigate-next"
        );
        let previusButton = panelVariants.querySelector(
            ".panel-variant-navigate-previus"
        );

        let infoTotal = panelVariants.querySelector(".panel-variant-navigate-total");
        let infoActual = panelVariants.querySelector(".panel-variant-navigate-actual");

        nextButton.addEventListener("click", () => {
            let itemsPanelVariant = panelVariants.querySelectorAll(
                ".panel-variant-item"
            );

            let itemActive = selectActiveItem(itemsPanelVariant, "variant-item_active");

            if (itemActive.dataset.variant == itemsPanelVariant.length) {
                itemActive.classList.remove("variant-item_active");

                let newItemPanelVariant = templatePanelVariant.cloneNode(true);
                let actualNumber = itemsPanelVariant.length + 1;
                
                actualizeNames(newItemPanelVariant, actualNumber);
                newItemPanelVariant.removeAttribute("id");
                newItemPanelVariant.classList.remove("hidden");
                newItemPanelVariant.classList.add("panel-variant-item");
                newItemPanelVariant.classList.add("grid");
                newItemPanelVariant.classList.add("variant-item_active");
                let att = document.createAttribute("data-variant");
                att.value = actualNumber;

                newItemPanelVariant.setAttributeNode(att);

                itemActive.after(newItemPanelVariant);
                infoTotal.textContent = "/" + (actualNumber);
                infoActual.textContent = actualNumber;
            } else {
                let nextItem = itemActive.nextSibling;
                nextItem.classList.add("variant-item_active");
                itemActive.classList.remove("variant-item_active");
                infoActual.textContent = nextItem.dataset.variant;
            }
        });

        previusButton.addEventListener("click", () => {

            let itemsPanelVariant = panelVariants.querySelectorAll(
                ".panel-variant-item"
            );

            let itemActive = selectActiveItem(itemsPanelVariant, "variant-item_active");

            if(itemActive.dataset.variant == 1) {
                itemActive.classList.remove("variant-item_active");
                let lastItem = itemsPanelVariant[itemsPanelVariant.length-1];   
                lastItem.classList.add("variant-item_active");

                infoActual.textContent = lastItem.dataset.variant;
            } else {
                let previousItem = itemActive.previousSibling;
                previousItem.classList.add("variant-item_active");
                itemActive.classList.remove("variant-item_active");
                infoActual.textContent = previousItem.dataset.variant;
            }
        });
    });
};

let selectActiveItem = (itemsPanelVariant, classActive) => {
    let active;
    itemsPanelVariant.forEach((itemPanelVariant) => {
        if (itemPanelVariant.classList.contains(classActive)) {
            active = itemPanelVariant;
        }
    });
    return active;
};


let actualizeNames = (newItemPanelVariant, number) => {
    let itemsForRename = newItemPanelVariant.querySelectorAll(".rename-variant-item");

    itemsForRename.forEach(itemForRename => {
        let actualName = itemForRename.name;
        let newName = actualName+"["+number+"]";

        itemForRename.setAttribute("name",newName);

        itemForRename.classList.remove("rename-variant-item");
    });

}