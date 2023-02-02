button = document.querySelector("#password-btn");
passwordInputs = document.querySelectorAll(".edit-password");

passwordInputs.forEach(function (currentValue) {
  currentValue.classList.toggle("hidden");
});

button.addEventListener(
  "click",
  function () {
    button.style.display = "none";
    passwordInputs.forEach(function (currentValue) {
      currentValue.classList.toggle("hidden");
    });
  },
  false
);
