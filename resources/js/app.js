import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);

// SEZIONE TOGGLE VISTA CHARACTERS

const showGridButton = document.getElementById('showGrid');
const showTableButton = document.getElementById('showTable');

showTableButton.addEventListener('click', function() {
    document.getElementById('gridView').style.display = 'none';   
    document.getElementById('tableView').style.display = 'block'; 

    showTableButton.classList.add('active');
    showGridButton.classList.remove('active');
});

showGridButton.addEventListener('click', function() {
    document.getElementById('gridView').style.display = 'flex';  
    document.getElementById('tableView').style.display = 'none'; 

    showGridButton.classList.add('active');
    showTableButton.classList.remove('active');
});

// SELEZIONE E CANCELLAZIONE DEI CHARACTERS
const deleteButtons = document.querySelectorAll('.delete-character');

deleteButtons.forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const deleteUrl = button.getAttribute('data-url');
        console.log("URL di eliminazione:", deleteUrl);

        const modal = new bootstrap.Modal(document.getElementById('deleteCharacterModal'));
        modal.show();

        const deleteForm = document.getElementById('deleteCharacterForm');
        deleteForm.setAttribute('action', deleteUrl);
    });
});


// SELEZIONE E CANCELLAZIONE DEI ITEMS
const deleteItemButtons = document.querySelectorAll('.delete-item');

deleteItemButtons.forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const deleteUrl = button.getAttribute('data-url'); // Recupera l'URL di eliminazione
        console.log("URL di eliminazione:", deleteUrl);

        const modal = new bootstrap.Modal(document.getElementById('deleteItemModal')); 
        modal.show();

        const deleteForm = document.getElementById('deleteItemForm');
        deleteForm.setAttribute('action', deleteUrl); // Imposta l'URL nel form della modale
    });
});

// SEZIONE CANCELLAZIONE DEI TYPES
const deleteTypeButtons = document.querySelectorAll('.delete-type');

deleteTypeButtons.forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const deleteUrl = button.getAttribute('data-url'); // Recupera l'URL di eliminazione
        console.log("URL di eliminazione:", deleteUrl);

        const modal = new bootstrap.Modal(document.getElementById('deleteTypeModal')); 
        modal.show();

        const deleteForm = document.getElementById('deleteTypeForm');
        deleteForm.setAttribute('action', deleteUrl); // Imposta l'URL nel form della modale
    });
});
