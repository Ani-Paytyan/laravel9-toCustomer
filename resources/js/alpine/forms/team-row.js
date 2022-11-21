import http from '../../http';
import notify from '../../notify';

export default () => ({
  loading: false,

  // Delete
  async destroy(deleteConfirmMessage) {
    if (confirm(deleteConfirmMessage)) {
      this.loading = true;
      this.$refs.deleteForm.submit();
    }
  },
});
