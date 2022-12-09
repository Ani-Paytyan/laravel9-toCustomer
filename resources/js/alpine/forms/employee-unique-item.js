import TomSelect from 'tom-select';

import http from '../../http';
import notify from '../../notify';

export default (actionURL) => ({
  uniqueItem: {
    select: null,
    dirt: false,
  },
  loading: false,
  init() {
    this.uniqueItem.select = new TomSelect(this.$refs.uniqueItem, {
      onChange: () => {
        this.uniqueItem.dirt = true;
      },
    });
  },
  get disabledSubmit() {
    return !this.uniqueItem.dirt;
  },
  form: {
    async '@submit.prevent'() {
      this.loading = true;
      try {
        const unique_item_id = this.uniqueItem.select.getValue();
        // const contact_id = this.uniqueItem.select.getValue();
        await http.post(actionURL, { unique_item_id });
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
