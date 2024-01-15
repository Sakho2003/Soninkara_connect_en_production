document.addEventListener("DOMContentLoaded", function() {
  // Sélection des éléments du DOM
  const toggler = document.querySelector(".hamburger");
  const navLinksContainer = document.querySelector(".navlinks-container");

  // Fonction pour basculer la navigation
  const toggleNav = e => {
    // Animation du bouton
    toggler.classList.toggle("open");

    // Changement de l'attribut aria-expanded
    const ariaToggle =
      toggler.getAttribute("aria-expanded") === "true" ? "false" : "true";
    toggler.setAttribute("aria-expanded", ariaToggle);

    // Animation de l'ouverture/fermeture de la navigation
    navLinksContainer.classList.toggle("open");
  };

  // Ajout d'un écouteur d'événements sur le clic du bouton
  toggler.addEventListener("click", toggleNav);

  // Utilisation de ResizeObserver pour ajuster la transition en fonction de la largeur de la fenêtre
  new ResizeObserver(entries => {
    if (entries[0].contentRect.width <= 900){
      navLinksContainer.style.transition = "transform 0.4s ease-out";
    } else {
      navLinksContainer.style.transition = "none";
    }
  }).observe(document.body);
});

