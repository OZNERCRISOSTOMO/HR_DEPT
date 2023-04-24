const action = document.querySelector(".action");
const logoutBtn = document.querySelector(".logout");
const totalEmployees = document.querySelector(".total-employees");
const totalPendingEmployees = document.querySelector(
  ".total-pending-employees"
);

const benefitsContainer = document.querySelector(".benefits-container");

//department
const selectDepartment = document.querySelector("#department");

//department position
const selectDepartmentPosition = document.querySelector("#department-position");

// Get the radio buttons by name
const employeeType = document.getElementsByName("type");
const employeePosition = document.getElementsByName("position");
const rate = document.querySelector("#rate");
const rateHidden = document.querySelector("#rate-hidden");

const companyEmployeeRate = {
  humanResource: {
    admin: {
      "HR Manager": 443,
      "HR Assistant": 183,
      "HR Administrator": 200,
      "HR Director": 1071,
    },
    employee: {
      "HR Analyst": 265,
      "HR Associate": 200,
      "Staffing Coordinator": 211,
      "Staffing Specialist": 227,
      Recruiter: 253,
      "Employee Relations Manager": 701,
      "HR Representative": 196,
      "Personal Manager": 248,
      "Safety Manager": 425,
    },
  },
  warehouse: {
    admin: {
      "Warehouse specialist": 550,
      "Warehouse manager": 550,
      "Forklift operator": 550,
    },
    employee: {
      "Stocking associate": 220,
      Stocker: 220,
      "Warehouse worker": 220,
      Laborer: 220,
      "Material handler": 250,
      "Receiving associate": 250,
      "Warehouse clerk": 250,
      Loader: 270,
      Receiver: 270,
      "Shipping and receiving clerk": 270,
    },
  },

  purchaser: {
    admin: {
      "Procurement Manager": 443,
      "Program Manager": 500,
      "Operations Manager": 600,
    },
    employee: {
      "Procurement Clerk": 100,
      "Purchasing Clerk": 75,
      "Purchasing Assistant": 100,
      "Purchasing Agent": 100,
      "Purchasing Associate": 100,
      "Procurement Clerk": 100,
      "Purchasing Associate": 100,
      "Purchasing Associate": 100,
      "Purchasing Clerk": 75,
    },
  },

  sales: {
    admin: {
      "Sales Manager": 83,
      Manager: 200,
      "Data Analyst 1": 150,
      "Data Analyst 2": 150,
    },
    employee: {
      "Customer Service Manager": 52,
      "Customer Service Representative 1": 45,
      "Customer Service Representative 2": 45,
      "Customer Service Representative 3": 45,
      "Cash Registry Operator Manager": 52,
      "Cash Registry Operator 1": 45,
      "Cash Registry Operator 2": 45,
      "Cash Registry Operator 3": 45,
      "Cash Registry Operator 4": 45,
    },
  },
};

let selectedDepartment = "";

selectDepartment.addEventListener("change", function (e) {
  const department = e.target.value;
  const formattedDepartment = department.replace(/-([a-z])/g, (match, letter) =>
    letter.toUpperCase()
  );
  console.log(formattedDepartment);

  // Clear the department position dropdown
  selectDepartmentPosition.innerHTML =
    "<option selected>Select position</option>";

  selectedDepartment = formattedDepartment;

  //set rate to 0
  rate.value = "0";
  rateHidden.value = "0";

  //unchecked employe type
  for (let i = 0; i < employeeType.length; i++) {
    if (employeeType[i].checked) {
      employeeType[i].checked = false;
      break;
    }
  }

  //unchecked employee position
  for (let i = 0; i < employeePosition.length; i++) {
    if (employeePosition[i].checked) {
      employeePosition[i].checked = false;
      break;
    }
  }
  console.log(selectedDepartment);
});

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

      //set sick leave to
      $(".sick-leave").val("60");

      // set vacation leave to 0
      $(".vacation-leave").val("15");

      //set health insurance to unchecked
      $("#health-insurance").prop("checked", true);

      //set christmas bonus to unchecked
      $("#christmas-bonus").prop("checked", true);

      //set food allowance to unchecked
      $("#food-allowances").prop("checked", true);

      //set transpo allowance to unchecked
      $("#transpo-allowance").prop("checked", true);

      //add benefits
      benefitsContainer.classList.remove("d-none");

      //enabled admin
      employeePosition[1].disabled = false;
    } else {
      // rate.value = employeeRate.nonRegular;
      // rateHidden.value = employeeRate.nonRegular;

      //disabled admin
      employeePosition[1].disabled = true;
      employeePosition[0].checked = true;
      employeePosition[1].checked = false;

      //set sick leave to 0
      $(".sick-leave").val("0");

      // set vacation leave to 0
      $(".vacation-leave").val("0");

      //set health insurance to unchecked
      $("#health-insurance").prop("checked", false);

      //set christmas bonus to unchecked
      $("#christmas-bonus").prop("checked", false);

      //set food allowance to unchecked
      $("#food-allowances").prop("checked", false);

      //set transpo allowance to unchecked
      $("#transpo-allowance").prop("checked", false);

      //remove benefits
      benefitsContainer.classList.add("d-none");
    }

    console.log(rateHidden.value);
  });
}

// Loop through the radio buttons to add event listeners
for (let i = 0; i < employeePosition.length; i++) {
  employeePosition[i].addEventListener("change", function () {
    // This code will run whenever the selected radio button changes

    if (this.value === "admin" && selectedDepartment !== "Select department") {
      // Clear the position dropdown
      selectDepartmentPosition.innerHTML =
        "<option selected>Select position</option>";

      //populate department position
      const positions = companyEmployeeRate[selectedDepartment].admin;
      Object.keys(positions).forEach((position) => {
        const option = document.createElement("option");
        option.value = position;
        option.textContent = `${position}`;
        option.setAttribute("data-position-rate", positions[position]);
        selectDepartmentPosition.appendChild(option);
      });
    }

    if (
      this.value == "employee" &&
      selectedDepartment !== "Select department"
    ) {
      // Clear the position dropdown
      selectDepartmentPosition.innerHTML =
        "<option selected>Select position</option>";

      //populate department position
      const positions = companyEmployeeRate[selectedDepartment].employee;
      Object.keys(positions).forEach((position) => {
        const option = document.createElement("option");
        option.value = position;
        option.textContent = `${position}`;
        option.setAttribute("data-position-rate", positions[position]);
        selectDepartmentPosition.appendChild(option);
      });
    }
  });
}

selectDepartmentPosition.addEventListener("change", function (e) {
  const selectedOption =
    selectDepartmentPosition.options[selectDepartmentPosition.selectedIndex];
  const positionRate = selectedOption.getAttribute("data-position-rate");

  rate.value = positionRate;
  rateHidden.value = positionRate;
});

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
