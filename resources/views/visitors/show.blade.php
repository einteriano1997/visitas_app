<div class="modal fade" id="viewModal{{$visitante->id}}" tabindex="-1" aria-labelledby="viewModalLabel{{$visitante->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel{{$visitante->id}}">Ver Visitante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
         
                <p><strong>Nombre:</strong> {{$visitante->nombre}}</p>
                <p><strong>Email:</strong> {{$visitante->email}}</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
