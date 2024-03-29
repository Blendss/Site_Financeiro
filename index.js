const $html = document.querySelector('html')
const $checkbox = document.querySelector('#switch')
let darkMode = localStorage.getItem("dark-mode");

const enableDarkMode = () => {
    $html.classList.add('dark-mode');
    $checkbox.checked = true;
    localStorage.setItem("dark-mode", "enabled");
};

const disableDarkMode = () => {
    $html.classList.remove('dark-mode');
    $checkbox.checked = false;
    localStorage.setItem("dark-mode", "disabled");
};

if (darkMode === "enabled") {
  enableDarkMode(); // set state of darkMode on page load
}

$checkbox.addEventListener("change", (e) => {
  darkMode = localStorage.getItem("dark-mode"); // update darkMode when clicked
  if (darkMode === "disabled") {
    enableDarkMode();
  } else {
    disableDarkMode();
  }
});

function show(){
    document.querySelector('.hamburger').classList.toggle('open')
    document.querySelector('.navigation').classList.toggle('active')
}

// Abrir modal ao clicar na tag <a>
document.getElementById('openModal').addEventListener('click', function() {
  document.getElementById('myModal').style.display = 'block';
});

// Fechar modal ao clicar no botão 'X'
document.getElementsByClassName('close')[0].addEventListener('click', function() {
  document.getElementById('myModal').style.display = 'none';
});

// Fechar modal ao clicar fora da área do modal
window.addEventListener('click', function(event) {
  var modal = document.getElementById('myModal');
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});

// Verifica se há uma imagem salva no localStorage ao carregar a página
window.onload = function() {
  const savedImage = localStorage.getItem('userImage');
  if (savedImage) {
    document.getElementById('upload-img').src = savedImage;
  }
};

document.getElementById('file-input').addEventListener('change', function(e) {
  const file = e.target.files[0];
  const reader = new FileReader();

  reader.onload = function(event) {
    const base64Image = event.target.result;

    // Salvando a imagem no localStorage com uma chave específica
    localStorage.setItem('userImage', base64Image);

    // Define a imagem selecionada como src da tag img
    document.getElementById('upload-img').src = base64Image;
  };

  reader.readAsDataURL(file);
});
