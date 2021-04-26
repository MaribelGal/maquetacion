
export function showNotification(type) {
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

    let notificationItemClose = notificationItem.querySelectorAll(".notification-close");

    let mostrar = () => {
        notificationsContainer.classList.toggle("show");
        notificationItem.classList.toggle("active");
    }

    mostrar();

    setTimeout(() => { mostrar(); }, 3000);

    notificationItemClose.forEach(close => {
        close.addEventListener("click" , () => {
            notificationItem.classList.toggle("active");
            notificationsContainer.classList.toggle("show");
        });
    });
}

