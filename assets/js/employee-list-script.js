const employeeListContainer = document.querySelector(".employeeList-container");
const loadingContainer = document.querySelector(".loading-container");

const globalId = {
  id: "",
};

// let showLoading = true;
$(document).ready(function () {
  $(".employeeList-container").on("click", function (e) {
    const employeeId = e.target.closest(".employee-container").dataset
      .employeeId;

    if (globalId.id != employeeId) {
      $(".employee-modal-body").html("");
      loadingContainer.classList.remove("hide-container");
    }

    $.ajax({
      url: "../Functions/admin-employeeInfo-modal.php",
      type: "POST",
      data: {
        id: employeeId,
      },

      success: function (data) {
        // Hide the loader spinner
        loadingContainer.classList.add("hide-container");

        $(".employee-modal-body").html(data);
      },
      error: function () {
        // Hide the loader spinner and show an error message
        alert("An error occurred while loading the employee information.");
      },
      complete: function () {
        globalId.id = employeeId;
      },
    });
  });
});
