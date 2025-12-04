(function() {
  function init() {
    var router = new Router([
      new Route('home', 'home.html', true),
      new Route('courses', 'courses.html'),
      new Route('login', 'login.html'),
      new Route('register', 'register.html'),
      new Route('about', 'about.html'),
      new Route('formsAdmin', 'formsAdmin.html'),
    ]);

    if (typeof UserService !== 'undefined' && UserService.generateMenuItems) {
      UserService.generateMenuItems();
    }
  }

  init();
}());
