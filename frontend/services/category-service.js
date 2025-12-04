let CategoryService = {
  getAll: function (onSuccess, onError) {
    RestClient.get(
      "categories/public",
      function (response) {
        const categories = Array.isArray(response) ? response : (response.data || []);
        if (onSuccess) onSuccess(categories);
      },
      function (jqXHR) {
        if (onError) {
          onError(jqXHR);
        } else {
          toastr.error("Failed to load categories");
        }
      }
    );
  },
};

