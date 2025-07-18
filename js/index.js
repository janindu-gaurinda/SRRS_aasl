const showEye = document.getElementById('show_eye');
const hideEye = document.getElementById('hide_eye');
const passwordField = document.getElementById('password');

showEye.addEventListener('click', function() {
    passwordField.type = 'text';
    showEye.classList.add('d-none');
    hideEye.classList.remove('d-none');
});

hideEye.addEventListener('click', function() {
    passwordField.type = 'password';
    hideEye.classList.add('d-none');
    showEye.classList.remove('d-none');
});