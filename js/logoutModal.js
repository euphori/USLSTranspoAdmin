const logoutMenu = document.querySelector("[openLogout]");
const cancelLogout = document.querySelector("[cancelLogout]");
const logoutConfirm = document.querySelector("[modalLogout]");

      
    logoutMenu.addEventListener("click", () => {
        logoutConfirm.showModal();
        });
      
        cancelLogout.addEventListener("click", () => {
            logoutConfirm.close()
        })