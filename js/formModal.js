const formMenu = document.querySelector("[openForm]");
const cancelForm = document.querySelector("[cancelForm]");
const formConfirm = document.querySelector("[newForm]");

      
    formMenu.addEventListener("click", () => {
        formConfirm.showModal();
        });
      
    cancelForm.addEventListener("click", () =>{
        formConfirm.close()
        })