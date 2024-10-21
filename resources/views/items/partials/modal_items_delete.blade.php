<!-- Modale di conferma eliminazione Item -->
<div class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="deleteItemModalLabel">Conferma Cancellazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare questo oggetto? Questa operazione è irreversibile.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annulla</button>
                <!-- Form con token CSRF e metodo DELETE -->
                <form id="deleteItemForm" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE') <!-- Questo metodo indica che si sta facendo una richiesta DELETE -->
                    <button type="submit" class="btn btn-outline-danger">
                        Elimina
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
