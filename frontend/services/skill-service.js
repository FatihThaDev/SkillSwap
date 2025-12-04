let SkillService = {
  getAll: function (onSuccess, onError) {
    RestClient.get(
      "skills",
      function (response) {
        const skills = Array.isArray(response) ? response : (response.data || []);
        if (onSuccess) onSuccess(skills);
      },
      function (jqXHR) {
        if (onError) {
          onError(jqXHR);
        } else {
          toastr.error("Failed to load skills");
        }
      }
    );
  },
};


