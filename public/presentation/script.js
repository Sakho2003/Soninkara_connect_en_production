// Fonction pour afficher ou masquer le bloc correspondant
function toggleBlock(blockId) {
    var selectedBlock = document.getElementById(blockId);
    if (selectedBlock) {
        if (selectedBlock.style.display === 'none' || selectedBlock.style.display === '') {
            // Si le bloc est masqué, l'afficher
            selectedBlock.style.display = 'block';
        } else {
            // Si le bloc est affiché, le masquer
            selectedBlock.style.display = 'none';
        }
    }
}

// Fonction pour basculer le bouton correspondant
function toggleButton(btnId) {
    var selectedButton = document.getElementById(btnId);
    if (selectedButton) {
        selectedButton.classList.toggle('active');
    }
}

// Fonction pour basculer le contenu et modifier le texte du bouton
function toggleContent(elementId, buttonId) {
    var element = document.getElementById(elementId);
    var button = document.getElementById(buttonId);

    if (element && button) {
        if (element.style.display === "none" || element.style.display === "") {
            element.style.display = "block";
            button.innerText = "Masquer le contenu";
        } else {
            element.style.display = "none";
            button.innerText = "Découvrir";
        }
    }
}

// Attacher des écouteurs d'événements aux boutons avec la fonction toggle
document.getElementById('presentationBtn').addEventListener('click', function() {
    toggleContent('presentationBlock', 'presentationBtn');
});

document.getElementById('imageBtn').addEventListener('click', function() {
    toggleBlock('imageBlock');
    toggleButton('imageBtn');
});

document.getElementById('meansBtn').addEventListener('click', function() {
    toggleBlock('meansBlock');
    toggleButton('meansBtn');
});

document.getElementById('soninkaraBtn').addEventListener('click', function() {
    toggleContent('soninkaraText', 'soninkaraBtn');
});
