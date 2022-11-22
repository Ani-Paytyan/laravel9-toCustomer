import http from '../../http';
import notify from '../../notify';

export default () => ({
  loading: false,

  // Delete
  async destroy(url, deleteConfirmMessage) {
    if (confirm(deleteConfirmMessage)) {
      this.loading = true;
      try {
        await http.delete(url);
        window.location.reload();
      } catch (error) {
        notify('error', error.message);
        console.error(error);
      } finally {
        this.loading = false;
      }
    }
  },
});
