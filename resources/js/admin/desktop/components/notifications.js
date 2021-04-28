
export function showNotification(type, messageText, setTimeOut) {
    let notificationsContainer = document.getElementById('notifications-container');
    let notificationItem  = notificationsContainer.querySelector("#notification-"+ type);

    // switch (type) {
    //     case "success":
    //         notificationItem = notificationsContainer.querySelector("#notification-success");
    //         break;
    //     case "info":
    //         notificationItem = notificationsContainer.querySelector("#notification-info");
    //         break;
    //     case "error":
    //         notificationItem = notificationsContainer.querySelector("#notification-error");
    //         break;
    //     case "reorder":
    //         notificationItem = notificationsContainer.querySelector("#notification-reorder");
    //         break;
    // }

    let notificationDescription = notificationItem.querySelector(".notification-description");



    let mostrar = () => {
        notificationsContainer.classList.add("show");
        notificationItem.classList.add("active");
        notificationDescription.innerHTML = messageText;
    }

    mostrar();

    let ocultar = () => {
        notificationsContainer.classList.remove("show");
        notificationItem.classList.remove("active");
        notificationDescription.innerHTML = '';
    }

    setTimeout(() => { ocultar(); }, setTimeOut);

    let notificationItemClose = notificationItem.querySelectorAll(".notification-close");

    notificationItemClose.forEach(close => {
        close.addEventListener("click" , () => {
            ocultar();
        });
    });
}

