import TomSelect from 'tom-select';

import http from '../../http';
import notify from '../../notify';

export default (actionURL) => ({
  workplace: {
    select: null,
    dirt: false,
  },
  loading: false,
  init() {
    this.workplace.select = new TomSelect(this.$refs.workplace, {
      onChange: () => {
        this.workplace.dirt = true;
      },
    });
  },
  get disabledSubmit() {
    return !this.workplace.dirt;
  },
  form: {
    async '@submit.prevent'() {
      this.loading = true;
      try {
        const workplace_id = this.workplace.select.getValue();
        await http.post(actionURL, { workplace_id });
        window.location.reload();
      } catch (error) {
        notify('error', error.message);
        console.error(error);
      } finally {
        this.loading = false;
      }
    },
  },
});
