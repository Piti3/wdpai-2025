function togglePassword(el) {
  const wrapper = el.closest('.password, .password_confirm');
  if (!wrapper) return;

  const passwordInput = wrapper.querySelector('input[type="password"], input[type="text"]');
  if (!passwordInput) return;

  const newType = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordInput.setAttribute('type', newType);

  el.classList.toggle('fa-eye-slash');
  el.classList.toggle('fa-eye');
}