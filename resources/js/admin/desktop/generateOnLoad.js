export let generateItem_OnLoad = () => {
    const templateItems = document.querySelectorAll(".generate-item-onload");

    templateItems.forEach(templateItem => {
        
        templateItem.classList.remove("generate-item-onload");
        let newItem = generateItem(templateItem, 0, templateItem);

        newItem.removeAttribute('hidden');
        
        if(templateItem.dataset.tag){
            newItem.classList.add(templateItem.dataset.tag);
        }
    
    });
    
}


export let generateItem = (elementToDuplicate, itemNumber, elementBeforeLocation) => {

    let newItem = elementToDuplicate.cloneNode(true);

    if(elementToDuplicate.dataset.tag){
        newItem.classList.add(elementToDuplicate.dataset.tag);
    }

    actualizeNames(newItem, itemNumber);
    newItem.removeAttribute("id");
    newItem.classList.remove("variant-template");
    let att = document.createAttribute("data-variant");
    att.value = itemNumber;
    newItem.setAttributeNode(att);

    elementBeforeLocation.after(newItem);

    return newItem;
};


export let actualizeNames = (duplicatedElement, itemNumber) => {
    let itemsForRename = duplicatedElement.querySelectorAll(".rename-variant-item");

    itemsForRename.forEach(itemForRename => {
        let actualName = itemForRename.name;
        let newName = actualName+"["+itemNumber+"]";

        itemForRename.setAttribute("name",newName);

        itemForRename.classList.remove("rename-variant-item");
    });

}