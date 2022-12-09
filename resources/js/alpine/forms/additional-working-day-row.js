import http from '../../http';
import notify from '../../notify';

export default () => ({
  loading: false,

  // Update
  async update(url) {
    this.loading = true;
    try {
      const date = this.$refs.date.value;
      const from = this.$refs.from.value;
      const to = this.$refs.to.value;
      await http.put(url, { date, from, to });
      window.location.reload();
    } catch (error) {
      notify('error', error.message);
      console.error(error);
    } finally {
      this.loading = false;
    }
  },

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
