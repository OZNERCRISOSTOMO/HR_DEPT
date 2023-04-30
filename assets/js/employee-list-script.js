const employeeListContainer = document.querySelector(".employeeList-container");
const loadingContainer = document.querySelector(".loading-container");
const logoutBtn = document.querySelector(".logout");
const editModalBtn = document.querySelector("#editModalBtn");

const globalId = {
  id: "",
};

const departmentDropdown = document.querySelector(".department-dropdown");
const sortDropdown = document.querySelector("#byName");

// let showLoading = true;
$(document).ready(function () {
  $(".employeeList-container").on("click", function (e) {
    const employeeId = e.target.closest(".employee-container").dataset
      .employeeId;

    document.querySelector("#employee-id").value = employeeId;

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

departmentDropdown.addEventListener("click", function (e) {
  // Check if the clicked element has an id
  if (e.target.id) {
    // Get the id of the clicked element
    const idName = e.target.id;
    console.log(idName);

    if (idName) {
      $.ajax({
        url: "../Functions/admin-department-dropdown.php",
        type: "POST",
        data: {
          department: idName,
        },

        success: function (data) {
          $(".employee-list-wrapper").html("");
          $(".employee-list-wrapper").html(data);
        },
      });
    }
  }
});

sortDropdown.addEventListener("click", function (e) {
  // Check if the clicked element has an id
  if (e.target.id) {
    // Get the id of the clicked element
    const idName = e.target.id;
    console.log(idName);

    if (idName) {
      $.ajax({
        url: "../Functions/admin-sortByName.php",
        type: "POST",
        data: {
          name: idName,
        },

        success: function (data) {
          $(".employee-list-wrapper").html("");
          $(".employee-list-wrapper").html(data);
        },
      });
    }
  }
});

editModalBtn.addEventListener("click", function () {
  //get the data
  const employeeImagePath = document.querySelector(".employeeImage").src;
  const employeeFirstName = document.querySelector(
    ".employee-first-name"
  ).innerHTML;
  const employeeLastName = document.querySelector(
    ".employee-last-name"
  ).innerHTML;
  const employeeEmail = document.querySelector(".employee-email").innerHTML;
  const employeeDateHired = document.querySelector(
    ".employee-date-hired"
  ).innerHTML;
  const employeeContact = document.querySelector(".employee-contact").innerHTML;
  const employeeDepartmentPosition = document.querySelector(
    ".employee-department-position"
  ).innerHTML;
  const employeeSSS = document.querySelector(".employe-sss").checked;
  const employeePagibig = document.querySelector(".employe-pagibig").checked;
  const employeePhilhealth = document.querySelector(
    ".employe-philhealth"
  ).checked;
  const employeeID = document.querySelector("#employee-ID").value;

  const data = ` <div class="flex-fill p-2">
        <div class="d-flex justify-content-center mb-2">
        <img class="rounded-circle mx-auto d-block" src="${employeeImagePath}" height="150" width="150" alt="Employee Pic" />
        </div>
        <div class="d-flex justify-content-center">
        <div class="btn btn-primary btn-rounded btn-sm p-0 m-0">
            <label class="form-label text-white m-1" for="employee-picture">Tap to Change Profile</label>
            <input type="file" class="form-control d-none" id="employee-picture" name="employee-picture"
                   accept="image/jpeg, image/png"  />
        </div>
      </div>
              <input type="text"  class="form-control fs-2 fw-bold mt-2 text-center border-0 p-0 m-0" name="employee-fname" contenteditable="true" value="${employeeFirstName}"> </input>
              <input type="text"  class="form-control fs-2 fw-bold mt-2  text mt-2 text-center border-0 p-0 m-0" name="employee-lname" contenteditable="true" value="${employeeLastName}"></input>
              <input  type="text" class="form-control border-0 text-center" contenteditable="true" name="employee-department-position" value="${employeeDepartmentPosition}" ></input>

          <div class="rounded ms-3"></div>
        </div>
        <div class="flex-fill p-2">
          <div class="form-floating">
            <h5 style="font-family: Bahnschrift;">Personal Information</h5>
            <table class="table table-borderless mt-2">
              <thead>
                <tr>
                  <th><p class="text" style="opacity: 0.5;">Employee ID </p></th>
                  <th><p class="text" style="opacity: 0.5;">Date Hired </p></th>
                  <th><p class="text" style="opacity: 0.5;">Email </p></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                <td> <input type="text" class="form-control form-control-sm border-0"  value="0001-AAA" ></td>
                <td> <input type="text" class="form-control form-control-sm border-0" value="${employeeDateHired}" disabled></td>
                <td> <input type="text" class="form-control form-control-sm border-0" value="${employeeEmail}" name="employee-email"></td>

                </tr>
                <tr>
                  <th><p class="text" style="opacity: 0.5;">Contact Number </p></th>
                  <th><p class="text" style="opacity: 0.5;">Birthdate </p></th>
                </tr>
                <tr>
                  <td> <input type="text" class="form-control border-0" value="${employeeContact}" name="employee-contact" ></td>
                  <td>21/02/2002</td>
                </tr>
              </tbody>
            </table>
            <h5 style="font-family: Bahnschrift;">Benefits</h5>
            <table class="table table-borderless mt-2">
              <thead>
                <tr>
                  <th><p class="text" style="opacity: 0.5;">SSS </p></th>
                  <th><p class="text" style="opacity: 0.5;">TIN </p></th>
                  <th><p class="text" style="opacity: 0.5;">PhilHealth </p></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td> <input class="form-check-input" name="beneficiaries[]" value="sss" id="sss" type="checkbox" ${
                    employeeSSS ? "checked" : ""
                  }> </td>
                  <td> <input class="form-check-input" name="beneficiaries[]" value="pagibig" id="pagibig" type="checkbox" ${
                    employeePagibig ? "checked" : ""
                  }> </td>
                  <td> <input class="form-check-input" name="beneficiaries[]" value="philhealth" id="philhealth" type="checkbox" ${
                    employeePhilhealth ? "checked" : ""
                  }> </td>
                   <input type="hidden"  name="employee-ID" value="${employeeID}">
            </tr>
          </tbody>
        </table>
      </div>
    </div>`;

  // edit-modal-body
  $(".edit-modal-body").html("");
  $(".edit-modal-body").html(data);
});

// Get the delete form and submit button
const deleteForm = document.querySelector("#delete-employee-form");
const deleteButton = deleteForm.querySelector("#delete-btn");

// Add an event listener to the delete button
deleteButton.addEventListener("click", function (e) {
  // e.preventDefault(); // Prevent the form from submitting

  // Display a Sweet Alert confirmation dialog
  Swal.fire({
    title: "Are you sure?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      // If the user clicks "Yes, delete it", submit the form

      deleteForm.submit(); // submit the form

      console.log(deleteForm);
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
