document.getElementById('urfu-form').addEventListener('submit', function(event) {
  event.preventDefault();

  const nameInput = document.getElementById('name');

  if (nameInput.value.trim() === '') {
    nameInput.classList.add('error');
  } else {
    nameInput.classList.remove('error');
  }
});