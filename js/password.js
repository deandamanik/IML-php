function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const eyeSlashIcon = document.getElementById('eyeSlashIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.add('opacity-0');
        eyeSlashIcon.classList.remove('opacity-0');
    } else {
        passwordInput.type = 'password';
        eyeSlashIcon.classList.add('opacity-0');
        eyeIcon.classList.remove('opacity-0');
    }
}