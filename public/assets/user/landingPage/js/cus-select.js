// SELECT 1 START
$(document).ready(function() {
      const selectedAll = document.querySelectorAll(".selected");

        selectedAll.forEach((selected) => {
          const optionsContainer = selected.previousElementSibling;
          const searchBox = selected.nextElementSibling;

          const optionsList = optionsContainer.querySelectorAll(".option");

          selected.addEventListener("click", () => {
            if (optionsContainer.classList.contains("active")) {
              optionsContainer.classList.remove("active");
            } else {
              let currentActive = document.querySelector(".options-container.active");
              if (currentActive) {
                currentActive.classList.remove("active");
              }

              optionsContainer.classList.add("active");
            }

            searchBox.value = "";
            filterList("");

            if (optionsContainer.classList.contains("active")) {
              searchBox.focus();
            }
          });

          optionsList.forEach((o) => {
            o.addEventListener("click", () => {
              selected.innerHTML = o.querySelector("label").innerHTML;
              optionsContainer.classList.remove("active");
              
            });

          });

          searchBox.addEventListener("keyup", function (e) {
            filterList(e.target.value);
          });

          const filterList = (searchTerm) => {
            searchTerm = searchTerm.toLowerCase();
            optionsList.forEach((option) => {
              let label = option.firstElementChild.nextElementSibling.innerText.toLowerCase();
              if (label.indexOf(searchTerm) != -1) {
                option.style.display = "block";
              } else {
                option.style.display = "none";
              }
            });
          };
        });
      });
// SELECT 1 END

// SELECT 2 START 
$(document).ready(function() {
      const selectedAll2 = document.querySelectorAll(".selected2");

        selectedAll2.forEach((selected2) => {
          const optionsContainer = selected2.previousElementSibling;
          const searchBox = selected2.nextElementSibling;

          const optionsList = optionsContainer.querySelectorAll(".option");

          selected2.addEventListener("click", () => {
            if (optionsContainer.classList.contains("active")) {
              optionsContainer.classList.remove("active");
            } else {
              let currentActive = document.querySelector(".options-container.active");
              if (currentActive) {
                currentActive.classList.remove("active");
              }

              optionsContainer.classList.add("active");
            }

            searchBox.value = "";
            filterList("");

            if (optionsContainer.classList.contains("active")) {
              searchBox.focus();
            }
          });

          optionsList.forEach((o) => {
            o.addEventListener("click", () => {
              selected2.innerHTML = o.querySelector("label").innerHTML;
              optionsContainer.classList.remove("active");
              
            });

          });

          searchBox.addEventListener("keyup", function (e) {
            filterList(e.target.value);
          });

          const filterList = (searchTerm) => {
            searchTerm = searchTerm.toLowerCase();
            optionsList.forEach((option) => {
              let label = option.firstElementChild.nextElementSibling.innerText.toLowerCase();
              if (label.indexOf(searchTerm) != -1) {
                option.style.display = "block";
              } else {
                option.style.display = "none";
              }
            });
          };
        });
        });
 // SELECT 2 END