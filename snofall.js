
/* fonction pour afficher le texte */

document.addEventListener('DOMContentLoaded', function () {
    const textElement = document.getElementById('typing-text');
    const buttonsContainer = document.querySelector('.buttons');
    const textContent = "HohooHo! Joyeux Noel! Plus besoin de passer par la lettre! Votre pere-noel 2.0 c'est mis à la page.  Venez créer votre liste de cadeaux directement en ligne!";
    let index = 0;

    // Masquer les boutons au chargement de la page
    buttonsContainer.style.opacity = 0;
    
/* fonctions d'affichage du texte */

    function typeText() {
        if (index < textContent.length) {
            textElement.innerHTML += textContent.charAt(index);
            index++;
            setTimeout(typeText,2 ); // Ajustez la vitesse de dactylographie ici
        } else {
            // Fin de l'effet de dactylographie, faire apparaître les boutons
            showButtons();
        }
    }
/*fonction pour afficher les bouton à la fin de l'affichage du texte*/
    function showButtons() {
        buttonsContainer.style.opacity = 1;
        buttonsContainer.classList.add('fade-in'); // Ajoutez cette ligne
    }


    typeText();
});

// js pour faire chuter les objet css rond blanc*/

    const giftContainer = document.querySelector('.gift-container');
    const numberOfGifts = 50; // Nombre total d'éléments cadeaux

    for (let i = 0; i < numberOfGifts; i++) {
        const gift = document.createElement('div');
        gift.className = 'gift';
        gift.style.left = `${Math.random() * 100}vw`; // Position aléatoire sur la largeur de la page
        gift.style.animationDelay = `${Math.random() * 5}s`; // Délai d'animation aléatoire
        giftContainer.appendChild(gift);
    }
