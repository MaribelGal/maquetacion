import {renderizarTabla} from './table';
import {showNotification} from './notifications';
import { buttonPress } from "./buttonPress";

export let renderizarLocaleTags = () => {

    let table = document.getElementById("tabla");
    let importTags = document.getElementById('import-tags');

    if(importTags){

        importTags.addEventListener("click", () => {

            let url = importTags.dataset.url;
        
            let sendImportTagsRequest = async () => {
    
                try {
                    await axios.get(url).then(response => {
                        table.innerHTML = response.data.table;
                        renderizarTabla();
                        showNotification('success', response.data.message);
                        console.log(response.data.table);
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };
    
            sendImportTagsRequest();
        });

        buttonPress(importTags);

    }
}
