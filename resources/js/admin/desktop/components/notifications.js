
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
        notificationsContainer.classList.toggle("show");
        notificationItem.classList.toggle("active");
        notificationDescription.innerHTML = messageText;
    }

    mostrar();

    setTimeout(() => { mostrar(); }, setTimeOut);

    let notificationItemClose = notificationItem.querySelectorAll(".notification-close");

    notificationItemClose.forEach(close => {
        close.addEventListener("click" , () => {
            notificationItem.classList.toggle("active");
            notificationsContainer.classList.toggle("show");
        });
    });
}

