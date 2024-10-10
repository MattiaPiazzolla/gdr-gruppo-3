<!-- Modal -->
<div class="modal fade" id="deleteCharacterModal" tabindex="-1" aria-labelledby="deleteCharacterModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCharacterModalLabel">Conferma Eliminazione</h5>

            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare questo personaggio? L'operazione è irreversibile.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>
