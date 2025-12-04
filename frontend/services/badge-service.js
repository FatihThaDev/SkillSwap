let BadgeService = {
  getAll: function (onSuccess, onError) {
    RestClient.get(
      "badges",
      function (response) {
        const badges = Array.isArray(response) ? response : (response.data || []);
        if (onSuccess) onSuccess(badges);
      },
      function (jqXHR) {
        if (onError) {
          onError(jqXHR);
        } else {
          toastr.error("Failed to load badges");
        }
      }
    );
  },
};

