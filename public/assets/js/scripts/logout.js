document.addEventListener('DOMContentLoaded', function () {
  let logoutButton = document.querySelector('.btn--logout');

  if (logoutButton) {
    logoutButton.addEventListener('click', function () {
      jQuery.ajax({
        url: '/logout',
        method: 'POST',
      })
        .done(function () {window.location.href = '/login';});
    });
  }
});