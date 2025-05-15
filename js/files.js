let allFiles = []; // Здесь будут храниться все выбранные файлы

document.getElementById('addFileBtn').addEventListener('click', function () {
  const fileContainer = document.getElementById('fileInput');

  // Создаем новый input каждый раз, чтобы можно было снова выбрать файл
  const newInput = document.createElement('input');
  newInput.type = 'file';
  newInput.style.display = 'none';
  newInput.id = 'fileInput'; // Можно без id

  // Добавляем обработчик
  newInput.addEventListener('change', function () {
    const files = this.files;
    if (files.length > 0) {
      const file = files[0];

      // Сохраняем файл в массив
      allFiles.push(file);

      // Отображаем имя файла
      const list = document.querySelector('#fileList ul');
      const li = document.createElement('li');
      li.style.width = 'fit-content';  
      li.style.text_align = 'center'   
      li.textContent = file.name;
      list.appendChild(li);
    }

    // Убираем текущий input и заменяем на новый (для следующего выбора)
    newInput.remove();
  });

  // Добавляем временный input в DOM и вызываем "клик"
  document.body.appendChild(newInput);
  newInput.click();
});