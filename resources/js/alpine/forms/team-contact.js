import TomSelect from 'tom-select';

import http from '../../http';
import notify from '../../notify';

export default (action, teamId) => ({
  contactSelect: null,
  roleSelect: null,
  loading: false,
  init() {
    this.contactSelect = new TomSelect(this.$refs.contact, {});
    this.roleSelect = new TomSelect(this.$refs.role, {});
  },
  form: {
    async '@submit.prevent'() {
      this.loading = true;
      try {
        await http.post(action, {
          team_id: teamId,
          contact_id: this.contactSelect.getValue(),
          role: this.roleSelect.getValue(),
        });
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
