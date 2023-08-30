document.addEventListener('DOMContentLoaded', function () {
  let formClearButton = document.querySelector('.form-header__clear-button');
  let editButtons = document.querySelectorAll('.buttons__item--edit');

  if (formClearButton) {
    let form = document.getElementById('news-form');
    let formTitle = form.querySelector('[name="title"]');
    let formDescription = form.querySelector('[name="description"]');
    let submitButton = form.querySelector('[type="submit"]');

    editButtons.forEach(function (editButton) {
      editButton.addEventListener('click', function () {
        let newsItem = editButton.closest('.news__item');
        let id = newsItem.querySelector('[data-id]').getAttribute('data-id');
        let title = newsItem.querySelector('.news__item-title').getAttribute('data-title');
        let description = newsItem.querySelector('.news__item-description').getAttribute('data-description');
        updateForm(id, title, description);
      });
    });


  function createIdInputForm(id) {
    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'id';
    input.value = id;

    return input;
  }

  function updateForm(id, title, description) {
    let formHeader = document.querySelector('.form-header__title');
    formHeader.textContent = 'Edit News';
    formClearButton.classList.add('form-header__clear-button--show');

    form.action = '/news/update';
    form.appendChild(createIdInputForm(id));
    formTitle.value = title;
    formDescription.value = description;
    submitButton.textContent = 'Save';
  }

    formClearButton.addEventListener('click', function () {
      let formHeader = document.querySelector('.form-header__title');
      formHeader.textContent = 'Create News';
      this.classList.remove('form-header__clear-button--show');

      let formId = form.querySelector('input[type="hidden"]');

      if (formId) {
        form.removeChild(formId);
      }

      form.action = '/news';
      formTitle.value = '';
      formDescription.value = '';
      submitButton.textContent = 'Create';
    });
  }
});
