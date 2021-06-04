// import {renderTable, renderForm} from './crudTable';
import { renderizarFormulario } from '../form/form';
import { renderizarTabla } from './table';

const topbar = document.getElementById('topbar');
const menuItems = document.querySelectorAll('.menu-item');
const collapseButton = document.getElementById('topbar-collapse-button');
const sectionTitle = document.getElementById('section-title');

menuItems.forEach( menuItem => {

    menuItem.addEventListener("click", () => {

        let url = menuItem.dataset.url;

        let sendEditRequest = async () => {

            try {
                await axios.get(url).then(response => {
        
                    form.innerHTML = response.data.form;
                    table.innerHTML = response.data.table;
                    sectionTitle.textContent = menuItem.textContent;
                    
                    collapseButton.classList.remove("active");
                    topbar.classList.remove("active");

                    window.history.pushState('', '', url);

                    renderizarTabla();
                    renderizarFormulario();
                });
                
            } catch (error) {
                console.error(error);
            }
        };

        sendEditRequest();
    });
});

collapseButton.addEventListener("click", () => {

    collapseButton.classList.toggle("active");
    topbar.classList.toggle("active");

});