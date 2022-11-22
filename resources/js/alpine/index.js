import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';
import collapse from '@alpinejs/collapse';

import headerComponent from './components/header';
import selectComponent from './components/select';

import employeeRow from './forms/employee-row';
import teamRow from './forms/team-row';
import teamContactForm from './forms/team-contact';
import teamContactRow from './forms/team-contact-row';
import workplaceRow from './forms/workplace-row';

import additionalWorkingDayForm from './forms/additional-working-day';
import additionalWorkingDayRow from './forms/additional-working-day-row';

import workplaceContactForm from './forms/workplace-contact';
import workplaceContactRow from './forms/workplace-contact-row';

import contactWorkplaceForm from './forms/contact-workplace';
import contactWorkplaceRow from './forms/contact-workplace-row';
import employeeUniqueItemForm from './forms/employee-unique-item';
import employeeUniqueItemRow from './forms/employee-unique-item-row';

window.Alpine = Alpine;

Alpine.plugin(persist);
Alpine.plugin(collapse);

Alpine.data('header', headerComponent);
Alpine.data('select', selectComponent);

Alpine.data('teamRow', teamRow);
Alpine.data('employeeRow', employeeRow);
Alpine.data('teamContactForm', teamContactForm);
Alpine.data('teamContactRow', teamContactRow);
Alpine.data('workplaceRow', workplaceRow);

Alpine.data('additionalWorkingDayForm', additionalWorkingDayForm);
Alpine.data('additionalWorkingDayRow', additionalWorkingDayRow);

Alpine.data('workplaceContactForm', workplaceContactForm);
Alpine.data('workplaceContactRow', workplaceContactRow);

// Employee pages
Alpine.data('contactWorkplaceForm', contactWorkplaceForm);
Alpine.data('contactWorkplaceRow', contactWorkplaceRow);
Alpine.data('employeeUniqueItemForm', employeeUniqueItemForm);
Alpine.data('employeeUniqueItemRow', employeeUniqueItemRow);

Alpine.store('darkMode', {
  on: Alpine.$persist(false).as('darkMode_on'),
  toggle() {
    this.on = !this.on;
  },
});

Alpine.start();
