const action = document.querySelector(".action");
const logoutBtn = document.querySelector(".logout");
const totalEmployees = document.querySelector(".total-employees");
const totalPendingEmployees = document.querySelector(
  ".total-pending-employees"
);

// Get the radio buttons by name
const employeeType = document.getElementsByName("type");
const employeePosition = document.getElementsByName("position");
const rate = document.querySelector("#rate");
const rateHidden = document.querySelector("#rate-hidden");

const employeeRate = {
  regular: "71.25",
  nonRegular: "60",
  admin: "100",
};

const employeeStatus = {
  type: "",
  position: "",
};

// Loop through the radio buttons to add event listeners
for (let i = 0; i < employeeType.length; i++) {
  employeeType[i].addEventListener("change", function () {
    // This code will run whenever the selected radio button changes

    if (this.value === "regular") {
      employeeStatus.type = "regular";

      //check if position is admin
      if (employeeStatus.position === "admin") {
        rate.value = employeeRate.admin;
        rateHidden.value = employeeRate.admin;
      } else {
        rate.value = employeeRate.regular;
        rateHidden.value = employeeRate.regular;
      }

      //enabled admin
      employeePosition[1].disabled = false;
    } else {
      rate.value = employeeRate.nonRegular;
      rateHidden.value = employeeRate.nonRegular;

      //disabled admin
      employeePosition[1].disabled = true;
      employeePosition[0].checked = true;
      employeePosition[1].checked = false;
    }

    console.log(rateHidden.value);
  });
}

// Loop through the radio buttons to add event listeners
for (let i = 0; i < employeePosition.length; i++) {
  employeePosition[i].addEventListener("change", function () {
    // This code will run whenever the selected radio button changes

    if (this.value === "admin") {
      rate.value = employeeRate.admin;
      rateHidden.value = employeeRate.admin;
    } else {
      rate.value = employeeRate.regular;
      rateHidden.value = employeeRate.regular;
    }
  });
  console.log(employeePosition.values);
}

const listOfContainer = [".employee-list", ".pending-employee-list"];
let currentMainContent = listOfContainer[0];

$(document).ready(function () {
  // Initialize select2
  $("#select-employee").select2();

  $("#send-email").prop("disabled", true);

  // Read selected option
  $("#select-employee").on("change", function () {
    var selectedValue = $(this).val();
    console.log(selectedValue);
    if (selectedValue != "0") {
      $("#send-email").prop("disabled", false);
    } else {
      $("#send-email").prop("disabled", true);
    }
  });
});

// SEARCH EMPLOYEE
$(document).ready(function () {
  $("#search").keyup(function () {
    var input = $(this).val();

    if (input == "") {
      $.ajax({
        url: "../Functions/admin-livesearch.php",
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
        url: "../Functions/admin-livesearch.php",
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

//get url
const urlParams = new URLSearchParams(window.location.search);
const successValue = urlParams.get("success");
console.log(successValue);

//SWEET ALERT EMAIL SENT
if (successValue === "emailSent") {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "success",
    title: "Email sent successfully",
  });
}

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

//Accept pending employee
//Accept button function
action.addEventListener("click", function (e) {
  if (e.target.classList.contains("acceptBtn")) {
    $("#acceptModal").modal("show");
    const targetParent = e.target.closest("td");

    const employeeId = targetParent.firstElementChild.value;
    const employeeEmail =
      targetParent.firstElementChild.nextElementSibling.value;
    const employeeLastName =
      targetParent.firstElementChild.nextElementSibling.nextElementSibling
        .value;

    document.querySelector("#employee_id_accept").value = employeeId;
    document.querySelector("#employee_email_accept").value = employeeEmail;
    document.querySelector("#employee_lastname_accept").value =
      employeeLastName;
  }

  if (e.target.classList.contains("declineBtn")) {
    $("#declineModal").modal("show");
  }
});

// const myModal = document.getElementById("exampleModal");
// const myInput = document.getElementById("myModalContent");

// myModal.addEventListener("shown.bs.modal", () => {
//   myInput.focus();
// });
