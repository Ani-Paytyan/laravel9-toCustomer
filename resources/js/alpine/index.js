import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';
import collapse from '@alpinejs/collapse';

import headerComponent from './components/header';
import selectComponent from './components/select';

import teamRow from './forms/team-row';
import teamContactForm from './forms/team-contact';
import teamContactRow from './forms/team-contact-row';

window.Alpine = Alpine;

Alpine.plugin(persist);
Alpine.plugin(collapse);

Alpine.data('header', headerComponent);
Alpine.data('select', selectComponent);

Alpine.data('teamRow', teamRow);
Alpine.data('teamContactForm', teamContactForm);
Alpine.data('teamContactRow', teamContactRow);

Alpine.store('darkMode', {
  on: Alpine.$persist(false).as('darkMode_on'),
  toggle() {
    this.on = !this.on;
  },
});

Alpine.start();
