document.addEventListener('DOMContentLoaded', () => {
  const fileInput = document.getElementById('fileInput');
  const fileList = document.querySelector('#fileList ul');

  fileInput.addEventListener('change', () => {
    fileList.innerHTML = ''; // Очистить список перед добавлением

    const files = fileInput.files;
    if (files.length === 0) {
      fileList.innerHTML = '<li>Файлы не выбраны</li>';
      return;
    }

    for (let i = 0; i < files.length; i++) {
      const li = document.createElement('li');
      li.textContent = files[i].name; // Имя файла
      fileList.appendChild(li);
    }
  });
});