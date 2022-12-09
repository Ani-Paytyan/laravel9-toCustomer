import http from '../../http';
import notify from '../../notify';

export default (action) => ({
  loading: false,
  form: {
    async '@submit.prevent'() {
      this.loading = true;
      try {
        const date = this.$refs.date.value;
        const to = this.$refs.to.value;
        const from = this.$refs.from.value;
        await http.post(action, { date, to, from });
        window.location.reload();
      } catch (error) {
        notify('error', error.response?.data?.message || error.message);
        console.error(error);
      } finally {
        this.loading = false;
      }
    },
  },
});
