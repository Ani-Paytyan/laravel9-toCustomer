import './alpine';
import './bootstrap';
import './popper.min';
import './elements';
import 'bootstrap';

// Basic
document.querySelectorAll('.form-control.is-invalid').forEach((control) => {
  control.addEventListener('input', (e) => {
    e.target.classList.remove('is-invalid');
  });
});
