const esVisibleEnPantalla = (elemento) => {
    let ubicacion = elemento.getBoundingClientRect();

    //condiciones necesarias para que este en pantalla
    return (
        ubicacion.top >= 0 &&
        ubicacion.left >= 0 &&
        ubicacion.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        ubicacion.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

