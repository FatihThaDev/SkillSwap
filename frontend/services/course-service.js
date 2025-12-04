let CourseService = {
  getAll: function (onSuccess, onError) {
    RestClient.get(
      "courses/public",
      function (response) {
        const courses = Array.isArray(response) ? response : (response.data || []);
        if (onSuccess) onSuccess(courses);
      },
      function (jqXHR) {
        if (onError) {
          onError(jqXHR);
        } else {
          toastr.error("Failed to load courses");
        }
      }
    );
  },
  
  getAllAdmin: function (onSuccess, onError) {
    RestClient.get(
      "courses",
      function (response) {
        const courses = Array.isArray(response) ? response : (response.data || []);
        if (onSuccess) onSuccess(courses);
      },
      function (jqXHR) {
        if (onError) {
          onError(jqXHR);
        } else {
          toastr.error("Create an account and log in to view courses.");
        }
      }
    );
  },
  
  create: function (courseData, onSuccess, onError) {
    RestClient.post(
      "courses",
      courseData,
      function (response) {
        if (onSuccess) onSuccess(response);
      },
      function (jqXHR) {
        if (onError) {
          onError(jqXHR);
        } else {
          toastr.error("Failed to create course");
        }
      }
    );
  },
  
  delete: function (courseId, onSuccess, onError) {
    RestClient.delete(
      "courses/" + courseId,
      null,
      function (response) {
        if (onSuccess) onSuccess(response);
      },
      function (jqXHR) {
        if (onError) {
          onError(jqXHR);
        } else {
          toastr.error("Failed to delete course");
        }
      }
    );
  }
};


