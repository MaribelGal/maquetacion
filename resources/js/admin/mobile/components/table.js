import { renderizarFormulario } from "./form";
import { renderizarCkeditor } from "../ckeditor";
import { SwipeRevealItem } from "./swipe";
import { startWait, stopWait } from "./wait";

const tabla = document.getElementById("tabla");
const formulario = document.getElementById("formulario");


export let renderizarTabla = () => {
	let leftRight = document.getElementById("tabla-faqs-filas");
	let swipeLeftRightElements = leftRight.querySelectorAll(".swipe-element");


	let swipeRevealItems = [];

	// swipeLeftRightElements.forEach(swipeElement => {
	// 	let swipeConfig = {
	// 		swipeContainer: swipeElement,
	// 		swipeContent: swipeElement.querySelector(".swipe-front"),

	// 		axis: "x",
	// 		swipeMoveActive: true,
	// 		// % del front que se ve
	// 		handleSizeRatio_LeftOrTop: 1,
	// 		handleSizeRatio_RightOrBottom: 1,

	// 		//Limite arrastrando hacia...
	// 		// % del back que se ve  (1 = NO LIMIT)
	// 		limitRatio_LeftOrTop: 1,
	// 		limitRatio_RightOrBottom: 1,

	// 		// Punto de no retorno, aplicable con limit = 1;
	// 		//slopRatio: 2 / 4,
	// 		slopToLeftOrTop: swipeElement.querySelector(".swipe-front").clientWidth * 2/4,
	// 		slopToRigthOrBottom: swipeElement.querySelector(".swipe-front").clientWidth * 2/4,

	// 		actionLeftOrTopState: () => {
	// 			console.log("holi");
	// 		},
	// 		actionRightOrBottomState: () => {
	// 			console.log("deu");
	// 		},
	// 		actionLeftOrTopBackVisible: () => {
	// 			console.log("left me ves");
	// 			editarBackVisible(swipeElement);
	// 		},
	// 		actionRightOrBottomBackVisible: () => {
	// 			console.log("right me ves");
	// 			eliminarBackVisble(swipeElement);
	// 		},
	// 		applyStyle: (currentAxisPosition, element) => {
	// 			// let transformStyle = "translateX(" + currentAxisPosition + "px)";

	// 			// element.style.msTransform = transformStyle;
	// 			// element.style.MozTransform = transformStyle;
	// 			// element.style.webkitTransform = transformStyle;
	// 			// element.style.transform = transformStyle;

	// 			element.style.left = currentAxisPosition + "px";
	// 		},
	// 	};

	// 	swipeRevealItems.push(new SwipeRevealItem(swipeConfig));
	// });


	let topBottomParent = document.getElementById("tabla-faqs");
	let topBottomChild = document.getElementById("tabla-faqs-filas");

	let swipeConfigTopBottom = {
		swipeContainer: topBottomParent,
		swipeContent: topBottomChild,

		axis: "y",
		swipeMoveActive: true,
		// % del front que se ve
		handleSizeRatio_LeftOrTop: 1,
		handleSizeRatio_RightOrBottom: 1,

		//Limite arrastrando hacia...
		// % del back que se ve  (1 = NO LIMIT)
		limitRatio_LeftOrTop: 1,
		limitRatio_RightOrBottom: 1,

		// Punto de no retorno, aplicable con limit = 1;
		slopRatio: 2 / 4,
		slopToLeftOrTop: 5,
		slopToRigthOrBottom: 5,

		actionLeftOrTopState: () => {
			console.log("holi");
		},
		actionRightOrBottomState: () => {
			console.log("deu");
		},
		actionLeftOrTopBackVisible: () => {
			console.log("top me ves");
		},
		actionRightOrBottomBackVisible: () => {
			console.log("bottom me ves");
			pagination();
		},
		applyStyle: (currentAxisPosition, element) => {
			// let transformStyle = "translateX(" + currentAxisPosition + "px)";

			// element.style.msTransform = transformStyle;
			// element.style.MozTransform = transformStyle;
			// element.style.webkitTransform = transformStyle;
			// element.style.transform = transformStyle;

			element.style.top = currentAxisPosition + "px";
		},
	}

	swipeRevealItems.push(new SwipeRevealItem(swipeConfigTopBottom));
}

renderizarTabla();

function editarRegistro(element) {
	let swipeEdit = element.querySelector(".swipe-edit");

	let url = swipeEdit.dataset.url;

	console.log("EDITAR");
	console.log(swipeEdit.dataset.url);

	let enviarPeticion = async () => {

		try {
			await axios.get(url).then(respuesta => {
				console.log(respuesta.data.form);
				formulario.innerHTML = respuesta.data.form;
				renderizarTabla();
				renderizarFormulario();
				renderizarCkeditor();
			});
		} catch (error) {
			console.log(error)
		}
	}

	enviarPeticion();

	document.getElementById("tabla").classList.toggle("disable");
	document.getElementById("formulario").classList.toggle("disable");
	document.getElementById("boton-selectorpanel-formulario").classList.toggle("disable");
	document.getElementById("boton-selectorpanel-tabla").classList.toggle("disable");

}

function eliminarRegistro(element) {
	let swipeDelete = element.querySelector(".swipe-delete");

	let url = swipeDelete.dataset.url;

	console.log("DELETE");
	console.log(swipeDelete.dataset.url);

	let enviarPeticion = async () => {

		try {
			await axios.delete(url).then(respuesta => {
				tabla.innerHTML = respuesta.data.table;
				renderizarTabla();
				renderizarFormulario();
				//formulario.innerHTML = respuesta.data.form;
			});
		} catch (error) {
			console.log(error)
		}
	}

	enviarPeticion();
}


function eliminarBackVisble(element) {
	element.querySelector(".swipe-delete").classList.add("active");
	element.querySelector(".swipe-edit").classList.remove("active");

}

function editarBackVisible(element) {
	element.querySelector(".swipe-delete").classList.remove("active");
	element.querySelector(".swipe-edit").classList.add("active");
}




function pagination() {

	let paginationRequest = async () => {

		try {

			let topBottomChild = document.getElementById("tabla-faqs-filas");
			let url = topBottomChild.dataset.pagination;
			let lastPage = topBottomChild.dataset.lastpage;
			let urlParams = new URL(url);
			let nextPage = parseInt(urlParams.searchParams.get('page'));

			if (nextPage <= lastPage) {

				startWait();

				// let updateMove = {
				// 	"origin": "mobile", 
				// 	"route": window.location.pathname,
				// 	"move": "next_elements",
				// 	"entity": scrollWindowElement.id,
				// 	"page":  nextPage
				// }

				await axios.get(url).then(response => {
					topBottomChild.insertAdjacentHTML('beforeend', response.data.tablerows);
					++nextPage;
					urlParams.searchParams.set('page', nextPage);
					topBottomChild.dataset.pagination = urlParams.toString();

					renderizarTabla();
					stopWait();
					// trackingPagination(updateMove);

				});
			}

		} catch (error) {
			console.error(error);
		}
	};

	paginationRequest();
}