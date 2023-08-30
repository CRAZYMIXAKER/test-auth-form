function notify(message = '', type = '') {
  const cookieNotifications = JSON.parse(getCookie('notifications'));

  if (cookieNotifications) {
    let messages = cookieNotifications.messages;

    for (let i = 0; i < messages.length; i++) {
      showNotification(messages[i], cookieNotifications.type);
    }
  }

  if ((message.length > 0 && type.length > 0)) {
    showNotification(message, type);
  }

  deleteCookie('notifications');
}

function showNotification(message, type) {
  const notificationContainer = document.getElementById('notification');
  notificationContainer.classList.add('notification--show');

  const notification = document.createElement('span');
  notification.className = `notification__text notification__text--${type}`;
  notification.textContent = message;
  notificationContainer.appendChild(notification);
}