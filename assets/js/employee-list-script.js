const employeeListContainer = document.querySelector(".employeeList-container");
const loadingContainer = document.querySelector(".loading-container");
const logoutBtn = document.querySelector(".logout");

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

// SEARCH EMPLOYEE
$(document).ready(function () {
  $("#search").keyup(function () {
    var input = $(this).val();

    if (input == "") {
      $.ajax({
        url: "../Functions/admin-employeeList-livesearch.php",
        type: "POST",
        data: {
          search: "all",
        },

        success: function (data) {
          $(".employee-list-wrapper").html(data);
        },
      });
    } else {
      $.ajax({
        url: "../Functions/admin-employeeList-livesearch.php",
        type: "POST",
        data: {
          search: input,
        },

        success: function (data) {
          $(".employee-list-wrapper").html(data);
        },
      });
    }
  });
});

// SWEET ALERT CONFIRMATION FOR LOGOUT
logoutBtn.addEventListener("click", function (e) {
  e.preventDefault();

  Swal.fire({
    title: "Are you sure?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Log me out",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      // e.target.href
      // console.log(e.target.closest(".logout").href)
      window.location.href = `${e.target.closest(".logout").href}`;
    }
  });
});
