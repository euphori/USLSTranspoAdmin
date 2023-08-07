const showButtons = document.querySelectorAll(".showButton");

        showButtons.forEach(button => {
            button.addEventListener("click", () => {
                const targetId = button.getAttribute("data-target");
                const targetDiv = document.getElementById(targetId);

                if (targetDiv.classList.contains("hidden")) {
                    targetDiv.classList.remove("hidden");
                } else {
                    targetDiv.classList.add("hidden");
                }
            });
        });