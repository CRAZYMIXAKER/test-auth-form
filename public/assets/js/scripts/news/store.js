document.addEventListener('DOMContentLoaded', function () {
  let newsForm = document.getElementById('news-form');
  
  if (newsForm) {
    document.getElementById('news-form').addEventListener(
      'submit',
      function (event) {
        event.preventDefault();

        let form = this;
        let title = form.querySelector('input[name="title"]').value;
        let description = form.querySelector('textarea[name="description"]').value;

        if (title.length < 3 || title.length > 255) {
          notify(
            'Title must be at least 3 characters long and no more than 255!',
            'error',
          );

          return false;
        }

        if (description.length < 3 || description.length > 1000) {
          notify(
            'Description must be at least 3 characters long and ' +
            'no more than 1000!',
            'error',
          );

          return false;
        }

        form.submit();
      },
    );
  }
});