const closeRules = document.querySelector("[closeRulesModal]")
const rulesModal = document.querySelector("[modalRules]")
const rulesContent = document.querySelector(".rulesContainer");

    window.addEventListener("DOMContentLoaded", () => {
        rulesModal.showModal()
        rulesContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    closeRules.addEventListener("click", () => {
        rulesModal.close()
        });