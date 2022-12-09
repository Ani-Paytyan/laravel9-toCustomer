export default () => ({
  mobileNavActive: false,
  darkTheme: false,
  init() {
    this.$watch('mobileNavActive', (value) => {
      document.body.style.overflowY = value ? 'hidden' : 'visible';
    });
  },

  openMobileNav() {
    this.mobileNavActive = true;
  },
  closeMobileNav() {
    this.mobileNavActive = false;
  },
  toggleMobileNav() {
    this.mobileNavActive = !this.mobileNavActive;
  },

  bars: {
    'x-show'() {
      return !this.mobileNavActive;
    },
  },
  xMark: {
    'x-show'() {
      return this.mobileNavActive;
    },
  },

  mobileNav: {
    'x-show'() {
      return this.mobileNavActive;
    },
    '@keyup.escape.window'() {
      this.closeMobileNav();
    },
  },
});
