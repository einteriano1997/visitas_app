<div class="modal fade" id="editModal{{ $visitante->id }}" tabindex="-1"
    aria-labelledby="editModalLabel{{ $visitante->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $visitante->id }}">Editar Visitante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm{{ $visitante->id }}">
                <div class="modal-body">
                    <!-- Formulario de edición -->

                    <div class="mb-3">
                        <label for="editNombre{{ $visitante->id }}" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editNombre{{ $visitante->id }}"
                            value="{{ $visitante->nombre }}">
                    </div>
                    <div class="mb-3">
                        <label for="editDui{{ $visitante->id }}" class="form-label">DUI</label>
                        <input type="text" class="form-control" id="editDui{{ $visitante->id }}"
                            value="{{ $visitante->dui }}">
                    </div>
                    <div class="mb-3">
                        <label for="editTelefono{{ $visitante->id }}" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="editTelefono{{ $visitante->id }}"
                            value="{{ $visitante->telefono }}">
                    </div>
                    <div class="mb-3">
                        <label for="editFechaNacimiento{{ $visitante->id }}" class="form-label">Fecha de
                            nacimiento</label>
                        <input type="date" class="form-control" id="editFechaNacimiento{{ $visitante->id }}"
                            value="{{ $visitante->fecha_nacimiento }}">
                        <div class="mb-3">
                            <label for="editEmail{{ $visitante->id }}" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail{{ $visitante->id }}"
                                value="{{ $visitante->email }}">
                        </div>
                        <!-- Agrega más campos aquí según sea necesario -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary btn-save-edit"
                            data-visitante-id="{{ $visitante->id }}">Guardar cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
