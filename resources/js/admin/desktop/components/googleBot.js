import {renderizarTabla} from './table';
import {showNotification} from './notifications';
import {startWait, stopWait} from './wait';
import { buttonPress } from "./buttonPress";

export let renderGoogleBot = () => {

    let table = document.getElementById("tabla");
    let pingGoogle = document.getElementById('ping-google');

    if(pingGoogle){

        pingGoogle.addEventListener("click", () => {

            let url = pingGoogle.dataset.url;
        
            let sendEditRequest = async () => {
    
                try {
                    await axios.get(url).then(response => {
                        showNotification('success', response.data.message);
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };
    
            sendEditRequest();
        });

        buttonPress(pingGoogle);

    }
}
