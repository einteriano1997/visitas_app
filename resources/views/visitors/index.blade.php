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
                                <h5 class="card-title">CRUD VISITANTES</h5>

                                <a href="{{ route('visitors.index') }}" class="btn btn-primary">Ver VISITANTES</a>


                                <br>
                                <br>
                                <!-- Data Table Menu -->
                                <table id="MenuTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>DUI</th>
                                            <th>TELEFONO</th>
                                            <th>EMAIL</th>
                                            <th>FECHA DE NACIMIENTO</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($visitantes as $visitante)
                                            <tr>
                                                <td>{{ $visitante->nombre }}</td>
                                                <td>{{ $visitante->dui }}</td>
                                                <td>{{ $visitante->telefono }}</td>
                                                <td>{{ $visitante->email }}</td>
                                                <td>{{ $visitante->fecha_nacimiento }}</td>
                                                <td>
                                                    <!-- Botones -->
                                                    <button class="btn btn-primary btn-edit" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $visitante->id }}">Editar</button>
                                                    <button class="btn btn-info btn-view" data-bs-toggle="modal"
                                                        data-bs-target="#viewModal{{ $visitante->id }}">Ver</button>

                                                    <!-- Modales -->
                                                    @include('visitors.edit', [
                                                        'visitante' => $visitante,
                                                    ])
                                                    @include('visitors.show', [
                                                        'visitante' => $visitante,
                                                    ])



                                                </td>

                                            </tr>
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
        $(document).ready(function() {
            $('.btn-save-edit').click(function() {
                console.log('Click en el botón de guardar cambios');
                var visitanteId = $(this).data('visitante-id');
                var nombre = $('#editNombre' + visitanteId).val();
                var email = $('#editEmail' + visitanteId).val();
                var dui = $('#editDui' + visitanteId).val();
                var telefono = $('#editTelefono' + visitanteId).val();
                var fechaNacimiento = $('#editFechaNacimiento' + visitanteId).val();

           
                $.ajax({
                    url: '/api/visitors/' + visitanteId,
                    type: 'PUT',
                    data: {
                        nombre: nombre,
                        email: email,
                        dui: dui,
                        telefono: telefono,
                        fecha_nacimiento: fechaNacimiento,
             
                    },
                    success: function(response) {
                  
                        console.log(response);
                        window.location.href = '{{ route("visitors.index") }}';
                    },
                    error: function(xhr) {
                   
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
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
