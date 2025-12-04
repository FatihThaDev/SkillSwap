let UserService = {
  init: function() {
    const token = localStorage.getItem("user_token");
    if (token && token !== undefined) {
      if (typeof UserService !== "undefined" && UserService.generateMenuItems) {
        UserService.generateMenuItems();
      }
      window.location.hash = "#courses";
      return;
    }

    const $form = $("form").first();
    if ($form.length) {
      $form.on("submit", function(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        let entity = Object.fromEntries(formData.entries());

        if (entity.username && !entity.email) {
          entity.email = entity.username;
        }

        UserService.login(entity);
      });
    }
  },

  initRegister: function () {
    const $form = $("form").first();
    if (!$form.length) return;

    $form.on("submit", function (e) {
      e.preventDefault();
      const formData = new FormData(e.target);
      let entity = Object.fromEntries(formData.entries());

      if (!entity.name) {
        const first = entity["first-name"] || "";
        const last = entity["last-name"] || "";
        const fullName = (first + " " + last).trim();
        if (fullName) {
          entity.name = fullName;
        }
      }

      if (!entity.email || !entity.password) {
        toastr.error("Email and password are required.");
        return;
      }

      RestClient.post(
        "auth/register",
        entity,
        function () {
          toastr.success("Registration successful! Please log in.");
          window.location.hash = "#login";
        },
        function (XMLHttpRequest) {
          const message =
            (XMLHttpRequest &&
              (XMLHttpRequest.responseJSON &&
                XMLHttpRequest.responseJSON.message)) ||
            XMLHttpRequest?.responseText ||
            "Error";
          toastr.error(message);
        }
      );
    });
  },
  login: function(entity) {
    RestClient.post(
      "auth/login",
      entity,
      function (result) {
        console.log(result);
        if (result && result.data && result.data.token) {
          localStorage.setItem("user_token", result.data.token);

          if (typeof UserService !== "undefined" && UserService.generateMenuItems) {
            UserService.generateMenuItems();
          }
          window.location.hash = "#courses";
        } 
        
        else {
          toastr.error("Invalid login response from server");
        }
      },
      function (XMLHttpRequest) {
        const message =
          (XMLHttpRequest &&
            (XMLHttpRequest.responseJSON &&
              XMLHttpRequest.responseJSON.message)) ||
          XMLHttpRequest?.responseText ||
          "Error";
        toastr.error(message);
      }
    );
  },

  logout: function() {
    localStorage.removeItem("user_token");

    $("#tabs").html(
      '<li class="nav-item text-center"><a class="nav-link hover:text-gray-400 transition-all" href="#home">Home</a></li>' +
      '<li class="nav-item text-center"><a class="nav-link hover:text-gray-400 transition-all" href="#courses">Courses</a></li>' +
      '<li class="nav-item text-center"><a class="nav-link hover:text-gray-400 transition-all" href="#login">Login</a></li>' +
      '<li class="nav-item text-center"><a class="nav-link hover:text-gray-400 transition-all" href="#register">Register</a></li>' +
      '<li class="nav-item text-center"><a class="nav-link hover:text-gray-400 transition-all" href="#about">About Us</a></li>'
    );

    window.location.hash = "#home";
  },

  initAdminPanel: function () {
    if (typeof Utils === "undefined") return;

    if ($("#courses-table").length) {
      CourseService.getAllAdmin(
        function (courses) {
          if (!Array.isArray(courses)) courses = [];
          const columns = [
            { title: "ID", data: "id" },
            { title: "Title", data: "title" },
            { title: "Category", data: "category" },
            { title: "Instructor", data: "instructor_name" },
          ];
          Utils.datatable("courses-table", columns, courses);
        },
        function (error) {
          toastr.error("Failed to load courses.");
          const columns = [
            { title: "ID", data: "id" },
            { title: "Title", data: "title" },
            { title: "Category", data: "category" },
            { title: "Instructor", data: "instructor_name" },
          ];
          Utils.datatable("courses-table", columns, []);
        }
      );
    }

    if ($("#skills-table").length) {
      SkillService.getAll(
        function (skills) {
          if (!Array.isArray(skills)) skills = [];
          const columns = [
            { title: "ID", data: "id" },
            { title: "Name", data: "name" },
            { title: "Level", data: "level" },
            { title: "User", data: "user_name" },
          ];
          Utils.datatable("skills-table", columns, skills);
        },
        function (error) {
          toastr.error("Failed to load skills.");
          const columns = [
            { title: "ID", data: "id" },
            { title: "Name", data: "name" },
            { title: "Level", data: "level" },
            { title: "User", data: "user_name" },
          ];
          Utils.datatable("skills-table", columns, []);
        }
      );
    }

    if ($("#badges-table").length) {
      BadgeService.getAll(
        function (badges) {
          if (!Array.isArray(badges)) badges = [];
          const columns = [
            { title: "ID", data: "id" },
            { title: "Name", data: "name" },
            { title: "Course", data: "course_name" },
            { title: "Description", data: "description" },
          ];
          Utils.datatable("badges-table", columns, badges);
        },
        function (error) {
          toastr.error("Failed to load badges.");
          const columns = [
            { title: "ID", data: "id" },
            { title: "Name", data: "name" },
            { title: "Course", data: "course_name" },
            { title: "Description", data: "description" },
          ];
          Utils.datatable("badges-table", columns, []);
        }
      );
    }
  },

  generateMenuItems: function() {
    const token = localStorage.getItem("user_token");
    const parsed = Utils.parseJwt(token);
    const user = parsed && parsed.user;

    let nav = "";

    nav =
      '<li class="nav-item text-center">' +
      '<a class="nav-link hover:text-gray-400 transition-all" href="#home">Home</a>' +
      "</li>" +
      '<li class="nav-item text-center">' +
      '<a class="nav-link hover:text-gray-400 transition-all" href="#courses">Courses</a>' +
      "</li>";

    if (user && user.role === Constants.ADMIN_ROLE) {
      nav +=
        '<li class="nav-item text-center">' +
        '<a class="nav-link hover:text-gray-400 transition-all" href="#formsAdmin">Admin Panel</a>' +
        "</li>";
    }

    nav +=
      '<li class="nav-item text-center">' +
      '<a class="nav-link hover:text-gray-400 transition-all" href="#about">About Us</a>' +
      "</li>" +
      "<li>" +
      '<button class="bg-blue-500 hover:bg-blue-600 cursor-pointer text-white py-2 px-6 rounded-md" onclick="UserService.logout()">Logout</button>' +
      "</li>";

    $("#tabs").html(nav);
  },

  initCourses: function() {
    const token = localStorage.getItem("user_token");
    const parsed = Utils.parseJwt(token);
    const user = parsed && parsed.user;
    const isAdmin = user && user.role === Constants.ADMIN_ROLE;
    const isUser = user && user.role === Constants.USER_ROLE;

    if (isUser) {
      $("#show-create-course").show();
    }

    CategoryService.getAll(function(categories) {
      const categoryFilter = $("#category-filter");
      const createCategorySelect = $("#create-course-category");
      
      categories.forEach(function(cat) {
        categoryFilter.append(`<option value="${cat.id}">${cat.name}</option>`);
        createCategorySelect.append(`<option value="${cat.id}">${cat.name}</option>`);
      });
    });

    function renderCourses(courses) {
      const container = $("#courses-container");
      container.empty();

      if (courses.length === 0) {
        container.html('<p class="text-center text-gray-400 col-span-full">No courses found.</p>');
        return;
      }

      courses.forEach(function(course) {
        const canDelete = isAdmin || (isUser && course.instructor_id == user.id);
        const deleteBtn = canDelete 
          ? `<button onclick="UserService.deleteCourse(${course.id})" class="mt-2 bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded-md text-sm">Delete</button>`
          : '';

        const card = `
          <div class="bg-gray-800 rounded-lg p-6 flex flex-col">
            <h3 class="text-xl font-bold mb-2 text-blue-400 flex-grow">${course.title || 'Untitled'}</h3>
            <p class="text-gray-300 mb-4 flex-grow">${course.description || ''}</p>
            <div class="pt-4 border-t border-gray-600">
              <div class="mb-2"><span class="font-semibold text-gray-400">Category:</span> ${course.category || 'N/A'}</div>
              <div class="mb-2"><span class="font-semibold text-gray-400">Instructor:</span> ${course.instructor_name || 'N/A'}</div>
              ${deleteBtn}
            </div>
          </div>
        `;
        container.append(card);
      });
    }

    CourseService.getAll(
      function(courses) {
        if (!Array.isArray(courses)) courses = [];
        renderCourses(courses);

        $("#course-search").on("input", function() {
          const search = $(this).val().toLowerCase();
          const filtered = courses.filter(function(c) {
            return (c.title && c.title.toLowerCase().includes(search)) ||
                   (c.description && c.description.toLowerCase().includes(search));
          });
          renderCourses(filtered);
        });

        $("#category-filter").on("change", function() {
          const categoryId = $(this).val();
          const search = $("#course-search").val().toLowerCase();
          let filtered = courses;

          if (categoryId) {
            filtered = filtered.filter(function(c) {
              return c.category_id == categoryId;
            });
          }

          if (search) {
            filtered = filtered.filter(function(c) {
              return (c.title && c.title.toLowerCase().includes(search)) ||
                     (c.description && c.description.toLowerCase().includes(search));
            });
          }

          renderCourses(filtered);
        });
      },
      function(error) {
        toastr.error("Failed to load courses.");
      }
    );

    $("#show-create-course").on("click", function() {
      $("#create-course-section").show();
      $(this).hide();
    });

    $("#cancel-create-course").on("click", function() {
      $("#create-course-section").hide();
      $("#show-create-course").show();
      $("#create-course-form")[0].reset();
    });

    $("#create-course-form").on("submit", function(e) {
      e.preventDefault();
      const formData = new FormData(e.target);
      const courseData = {
        title: formData.get("title"),
        description: formData.get("description"),
        category_id: parseInt(formData.get("category_id")),
        instructor_id: user.id
      };

      CourseService.create(
        courseData,
        function(response) {
          toastr.success("Course created successfully!");
          $("#create-course-section").hide();
          $("#show-create-course").show();
          $("#create-course-form")[0].reset();
          UserService.initCourses();
        },
        function(error) {
          const msg = error.responseJSON && error.responseJSON.message 
            ? error.responseJSON.message 
            : "Failed to create course.";
          toastr.error(msg);
        }
      );
    });
  },

  deleteCourse: function(courseId) {
    if (!confirm("Are you sure you want to delete this course?")) return;

    CourseService.delete(
      courseId,
      function(response) {
        toastr.success("Course deleted successfully!");
        UserService.initCourses();
      },
      function(error) {
        const msg = error.responseJSON && error.responseJSON.message 
          ? error.responseJSON.message 
          : "Failed to delete course.";
        toastr.error(msg);
      }
    );
  }
};
