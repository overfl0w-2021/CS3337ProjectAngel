const toggle = document.getElementById('dark-mode-toggle');
const body = document.body;

toggle.addEventListener('click', function() {
    body.classList.toggle('dark-mode');
  });