import TomSelect from 'tom-select';

import http from '../../http';
import notify from '../../notify';

export default (action) => ({
  contact: {
    select: null,
    dirt: false,
  },
  loading: false,
  init() {
    this.contact.select = new TomSelect(this.$refs.contact, {
      onChange: () => {
        this.contact.dirt = true;
      },
    });
  },
  get disabledSubmit() {
    return !this.contact.dirt;
  },
  form: {
    async '@submit.prevent'() {
      this.loading = true;
      try {
        const contact_id = this.contact.select.getValue();
        await http.post(action, { contact_id });
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
