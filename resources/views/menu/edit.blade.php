<!-- Modales -->
<div class="modal fade" id="editModal{{ $menu->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Menú</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('menu.update', $menu->id) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" value="{{ $menu->nombre }}" name="nombre"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="text" class="form-control" value="{{ $menu->url }}" name="url"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="icono" class="form-label">Padre</label>
                            <select name="id_padre" id="">
                                <option value="">Elejir Menu Padre</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}">
                                        {{ $menu->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary btn-confirm-edit">Guardar
                            Cambios</button>
                    </div>
            </form>
        </div>
    </div>
</div>
