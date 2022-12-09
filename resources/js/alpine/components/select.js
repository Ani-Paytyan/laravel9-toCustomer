import TomSelect from 'tom-select';

export default (settings = {}) => ({
  init() {
    console.log(settings, this.$root);
    new TomSelect(this.$root, settings);
  },
});
