const resForm = document.getElementById('resForm');
const confirmBtn = document.querySelector("[openConfirm]");
const buttons = document.querySelectorAll("button");
const modalConfirm = document.querySelector("[modalConfirmation]");
const confirmedModal = document.querySelector("[modalConfirmed]");

      
    confirmBtn.addEventListener("click", () => {
        modalConfirm.showModal();
        });
      
    buttons.forEach((button) => {
        button.addEventListener("click", () => {
        if (button.name === "okButton") {  
            modalConfirm.close();
            confirmedModal.showModal();
        } else if (button.name === "cancelButton") {
            modalConfirm.close();
            }
            });
        });
      
        const closeButtons = document.querySelectorAll("[closeModal]");

        for (let i = 0; i < closeButtons.length; i++) {
            closeButtons[i].addEventListener("click", () => {
            closeButtons[i].closest("dialog").close();
            resForm.submit();
            });
        }