<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <form id="visitorForm">
                        <div class="mb-3">
                            <label for="dui" class="form-label">DUI</label>
                            <input type="text" class="form-control" id="dui" placeholder="XXXXXXXX-X">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="example@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="fechaNacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="fechaNacimiento" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" placeholder="(503) XXXX-XXXX">
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
    <script>
        const menuItems = @json($menus);
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
        document.getElementById('visitorForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = {
                dui: document.getElementById('dui').value,
                nombre: document.getElementById('nombre').value,
                email: document.getElementById('email').value,
                fecha_nacimiento: document.getElementById('fechaNacimiento').value,
                telefono: document.getElementById('telefono').value,
            };

            fetch('/api/visitors', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',

                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(text);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    window.location.href = '{{ route("visitors.index") }}';
                    console.log('Respuesta del servidor:', data);

                })
                .catch(error => {
                    console.error('Error al enviar el formulario:', error);

                });
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/visitors',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Procesar los datos recibidos
                    console.log('Datos de visitantes:', data);
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener datos de visitantes:', error);
                }
            });
        });
    </script>
</body>

</html>
