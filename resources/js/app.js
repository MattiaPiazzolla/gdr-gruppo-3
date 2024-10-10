import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);

// Funzione per aprire una modale
function showModal(modalId, actionUrl, formId) {
    const modal = document.getElementById(modalId);
    const bootstrapModal = new bootstrap.Modal(modal);

    // Seleziona il form all'interno della modale e aggiorna l'azione
    const form = modal.querySelector(`#${formId}`);
    if (form) {
        form.action = actionUrl;
    }

    // Mostra la modale
    bootstrapModal.show();
}

// Gestione della modale per i personaggi (characters)
const buttonsCharacter = document.querySelectorAll('.delete-character');
buttonsCharacter.forEach((button) => {
    button.addEventListener('click', function (e) {
        e.preventDefault();

        // Prendi l'ID del personaggio dal data attribute del bottone
        const characterId = button.getAttribute('data-character-id');
        showModal('deleteCharacterModal', `/characters/${characterId}`, 'deleteForm');
    });
});

// Gestione della modale per gli oggetti (items)
const buttonsItem = document.querySelectorAll('.delete-item');
buttonsItem.forEach((button) => {
    button.addEventListener('click', function (e) {
        e.preventDefault();

        // Prendi l'ID dell'item dal data attribute del bottone
        const itemId = button.getAttribute('data-item-id');
        showModal('deleteItemModal', `/items/${itemId}`, 'deleteForm');
    });
});

// Gestione della modale per i tipi (types)
const buttonsType = document.querySelectorAll('.delete-type');
buttonsType.forEach((button) => {
    button.addEventListener('click', function (e) {
        e.preventDefault();

        // Prendi l'ID del tipo dal data attribute del bottone
        const typeId = button.getAttribute('data-type-id');
        showModal('deleteTypeModal', `/types/${typeId}`, 'deleteTypeForm'); 
    });
});