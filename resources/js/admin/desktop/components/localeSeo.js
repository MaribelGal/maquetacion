import {renderizarTabla} from './table';
import {showNotification} from './notifications';
import {startWait, stopWait} from './wait';
import { buttonPress } from "./buttonPress";


export let renderizarLocaleSeo = () => {

    let table = document.getElementById("tabla");
    let importSeo = document.getElementById('import-seo');

    if(importSeo){

        importSeo.addEventListener("click", () => {

            let url = importSeo.dataset.url;
        
            let sendEditRequest = async () => {
    
                try {
                    await axios.get(url).then(response => {
                        table.innerHTML = response.data.table;
                        renderizarTabla();
                        showNotification('success', response.data.message);
                        // stopWait();
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };
    
            sendEditRequest();
        });

        buttonPress(importSeo);

    }
}
