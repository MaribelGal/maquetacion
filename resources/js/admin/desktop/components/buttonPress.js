
export let buttonPress =( element ) => {
    element.addEventListener("mousedown", () => {
        element.parentElement.classList.add("mousedown");
    });

    element.addEventListener("mouseup", () => {
        element.parentElement.classList.remove("mousedown");
    });
}