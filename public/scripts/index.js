const searchbar = document.querySelector("#searchbar");
const employees = document.querySelectorAll(".employee");

const array_filter = function (array, string) {
  string = string.toLowerCase();
  array.forEach(function (currentValue) {
    const name = currentValue.textContent.toLowerCase();
    if (!name.includes(string)) {
      currentValue.style.display = "none";
    } else {
      currentValue.style.display = "block";
    }
  });
};

searchbar.addEventListener(
  "input",
  function () {
    array_filter(employees, searchbar.value);
  },
  false
);
