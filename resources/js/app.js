import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);

// Seleziona tutti i bottoni di eliminazione
const buttons = document.querySelectorAll('.delete-character');

// Aggiungi un event listener a ciascun bottone di eliminazione
buttons.forEach((button) => {
    button.addEventListener('click', function (e) {
        e.preventDefault();

        // Seleziona la modale
        const modal = document.getElementById('deleteCharacterModal');
        const bootstrapModal = new bootstrap.Modal(modal);

        // Prendi l'ID del personaggio dal data attribute del bottone
        const characterId = button.getAttribute('data-character-id');

        // Seleziona il form all'interno della modale
        const form = document.getElementById('deleteForm');

        // Aggiorna l'azione del form con l'URL corretto per eliminare il personaggio
        form.action = `/characters/${characterId}`;

        // Mostra la modale
        bootstrapModal.show();
    });
});