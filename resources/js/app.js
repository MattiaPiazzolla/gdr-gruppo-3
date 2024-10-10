import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);

// Gestione della modale per i personaggi (characters)
const buttonsCharacter = document.querySelectorAll('.delete-character');
buttonsCharacter.forEach((button) => {
    button.addEventListener('click', function (e) {
        e.preventDefault();

        // Seleziona la modale per i personaggi
        const modal = document.getElementById('deleteCharacterModal');
        const bootstrapModal = new bootstrap.Modal(modal);

        // Prendi l'ID del personaggio dal data attribute del bottone
        const characterId = button.getAttribute('data-character-id');

        // Seleziona il form all'interno della modale e aggiorna l'azione
        const form = document.getElementById('deleteForm');
        form.action = `/characters/${characterId}`;

        // Mostra la modale
        bootstrapModal.show();
    });
});

// Gestione della modale per gli oggetti (items)
const buttonsItem = document.querySelectorAll('.delete-item');
buttonsItem.forEach((button) => {
    button.addEventListener('click', function (e) {
        e.preventDefault();

        // Seleziona la modale per gli oggetti
        const modal = document.getElementById('deleteItemModal');
        const bootstrapModal = new bootstrap.Modal(modal);

        // Prendi l'ID dell'item dal data attribute del bottone
        const itemId = button.getAttribute('data-item-id');

        // Seleziona il form all'interno della modale e aggiorna l'azione
        const form = document.getElementById('deleteForm');
        form.action = `/items/${itemId}`;

        // Mostra la modale
        bootstrapModal.show();
    });
});