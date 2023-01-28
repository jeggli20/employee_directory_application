const inputFields = document.querySelectorAll("input");

inputFields.forEach(function (currentValue) {
  currentValue.addEventListener(
    "input",
    function () {
      if (this.classList.contains("invalid")) {
        this.classList.remove("invalid");
      }
    },
    false
  );
});
