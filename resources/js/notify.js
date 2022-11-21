/*
import { Notyf } from 'notyf';

const notyf = new Notyf({
  duration: 6000,
  position: {
    x: 'right',
    y: 'bottom',
  },
});

const notify = {
  success(message) {
    notyf.success(message);
  },
  error(message) {
    notyf.error(message);
  },
};

export default notify;
*/
export default function notify(status, message, toast = true, position = 'top-right') {
  Swal.fire({
    toast: toast,
    icon: status,
    title: message,
    position: position,
    animation: true,
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
  });
}
