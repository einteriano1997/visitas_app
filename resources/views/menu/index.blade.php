<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-light">
                <div class="d-flex flex-column align-items-center p-3">
                    <h5>Menú dinámico</h5>
                    <div id="menuItems" class="mt-3">

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="p-3">
                    <h1>Dashboard</h1>
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">CRUD MENU</h5>

                                <a href="{{ route('menu.index') }}" class="btn btn-primary">Ver Menús</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Crear nuevo elemento del menu
                                </button>
                                <br>
                                <br>
                                <!-- Data Table Menu -->
                                <table id="MenuTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>URL</th>
                                            <th>Item Padre</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                            <tr>
                                                <td>{{ $menu->nombre }}</td>
                                                <td>{{ $menu->url }}</td>
                                                <td>{{ optional($menu->padre)->nombre }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-edit" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $menu->id }}">Editar</button>
                                                    <button class="btn btn-info btn-view" data-bs-toggle="modal"
                                                        data-bs-target="#viewMenuModal{{ $menu->id }}">Ver</button>
                                                </td>
                                            </tr>
                                            

                                            <div class="modal fade" id="viewMenuModal{{ $menu->id }}" tabindex="-1"
                                                aria-labelledby="viewModalLabel{{ $menu->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="viewModalLabel{{ $menu->id }}">Ver Item de menu
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                            <p><strong>Nombre:</strong> {{ $menu->nombre }}</p>
                                                            <p><strong>Url:</strong> {{ $menu->url }}</p>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @include('menu.edit', ['menu' => $menu])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <!-- JS de DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        const menuItems = @json($menusItems);
    </script>
    <script>
        const menuItemsContainer = document.getElementById('menuItems');

        menuItems.forEach(item => {
            const menuItem = document.createElement('a');
            menuItem.classList.add('card', 'mb-3');
            menuItem.href = item.url;
            menuItem.innerHTML = `
            <div class="card-body">
                <h5 class="card-title">${item.nombre}</h5>
                <div id="children-${item.id}" class="ml-3"></div>
            </div>
        `;
            menuItemsContainer.appendChild(menuItem);

            if (item.children && item.children.length > 0) {
                const childrenContainer = document.getElementById(`children-${item.id}`);
                item.children.forEach(child => {
                    const childItem = document.createElement('a');
                    childItem.classList.add('card', 'mb-3');
                    childItem.href = child.url;
                    childItem.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title">${child.nombre}</h5>
                    </div>
                `;
                    childrenContainer.appendChild(childItem);
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#MenuTable').DataTable();
        });
    </script>
</body>

</html>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nuevo elemento de
                    menú</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('menu.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="text" class="form-control" id="url" name="url" required>
                    </div>

                    <div class="mb-3">
                        <label for="icono" class="form-label">Padre</label>
                        <select name="id_padre" id="">
                            <option value="">Elejir Menu Padre</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
