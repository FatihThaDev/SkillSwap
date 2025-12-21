class Router {
  constructor(routes) {
    if (!routes) {
      throw 'error: routes param is mandatory';
    }
    this.routes = routes;
    this.rootElem = document.getElementById('app');
    this.init();
  }

  init() {
    window.addEventListener('hashchange', () => this.hasChanged());
    this.hasChanged();
  }

  hasChanged() {
    const hash = window.location.hash.substr(1);
    const matchedRoute = this.routes.find((route) => route.isActiveRoute(hash));

    if (matchedRoute) {
      this.goToRoute(matchedRoute.htmlName);
    } else {
      const defaultRoute = this.routes.find((route) => route.default);
      if (defaultRoute) {
        this.goToRoute(defaultRoute.htmlName);
      }
    }
  }

  goToRoute(htmlName) {
    const basePath = window.location.hostname === 'localhost' ? '' : '/frontend';
    const url = basePath + '/pages/' + htmlName;
    fetch(url)
      .then((response) => response.text())
      .then((html) => {
        this.rootElem.innerHTML = html;
        const hash = htmlName.replace('.html', '');
        if (typeof UserService !== 'undefined') {
          if (hash === 'login') {
            UserService.init();
          } else if (hash === 'register') {
            UserService.initRegister();
          } else if (hash === 'formsAdmin') {
            UserService.initAdminPanel();
          } else if (hash === 'courses') {
            UserService.initCourses();
          }
        }
      })
      .catch((error) => console.error('Error loading route:', error));
  }
}
