<!-- Modale di conferma di cancellazione -->
<div class="modal fade" id="deleteCharacterModal" tabindex="-1" aria-labelledby="deleteCharacterModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCharacterModalLabel">Conferma Eliminazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare definitivamente questo personaggio?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.delete-character').forEach(button => {
        button.addEventListener('click', function() {
            const characterId = this.getAttribute('data-character-id');
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action =
            `/characters/${characterId}/force-delete`; // Aggiorna l'azione del modulo
            const modal = new bootstrap.Modal(document.getElementById('deleteCharacterModal'));
            modal.show(); // Mostra la modale
        });
    });
</script>
