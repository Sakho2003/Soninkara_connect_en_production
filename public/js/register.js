const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
  
  // Ajoutez cette ligne pour détecter la largeur de l'écran
  const screenWidth = window.innerWidth || document.documentElement.clientWidth;

  // Ajoutez une condition pour activer ou désactiver le champ de répétition du mot de passe
  if (screenWidth <= 768) {  // Vous pouvez ajuster la valeur (768) en fonction de vos besoins
      document.getElementById('signup-repeat_password').setAttribute('disabled', 'disabled');
  }
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});