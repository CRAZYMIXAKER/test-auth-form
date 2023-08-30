document.addEventListener('DOMContentLoaded', function () {
  let deleteButtons = document.querySelectorAll('.buttons__item--delete');

  deleteButtons.forEach(function (deleteButton) {
    deleteButton.addEventListener('click', function () {
      let newsId = deleteButton.getAttribute('data-id');

      jQuery.ajax({
        url: '/news/delete',
        method: 'DELETE',
        data: { id: newsId },
      })
        .done(function () {window.location.href = '/news';});
    });
  });
});