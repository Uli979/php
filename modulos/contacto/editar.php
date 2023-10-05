<!-- HTML para el offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="editarEmpleadoOffcanvas" aria-labelledby="editarEmpleadoOffcanvasLabel">
    <div class="offcanvas-header pt-4 pb-4">
        <h5 class="offcanvas-title" id="editarEmpleadoOffcanvasLabel">Edit employee</h5>
        <button type="button" class="btn-close-offcanvas border-0 rounded-2 p-1" data-bs-dismiss="offcanvas" aria-label="Cerrar"><i class="bi bi-x-lg pe-1 ps-1"></i></button>
    </div>
    <div class="offcanvas-body">
        <form action="" method="post">
            <input type="hidden" class="form-control rounded-4" name="txtid" value="" id="txtidEdit">
            <div class="mb-3 row">
                <div class="col-md-6 pe-1">
                    <label for="nombreEdit">Name</label>
                    <input type="text" class="form-control rounded-4" name="nombre" value="" placeholder="Ingrese nombre" id="nombreEdit" required>
                </div>
                <div class="col-md-6 ps-1">
                    <label for="apellidoEdit">Surnames</label>
                    <input type="text" class="form-control rounded-4" name="apellido" value="" placeholder="Ingrese apellido" id="apellidoEdit" required>
                </div>
            </div>
            <label for="direccionEdit">Address</label>
            <input type="text" class="form-control rounded-4  mb-3" name="direccion" value="" placeholder="Ingrese direccion" id="direccionEdit" required>
            <div class="mb-3 row">
                <div class="col-md-6 pe-1">
                    <label for="cedulaEdit">ID Employee</label>
                    <input type="text" class="form-control rounded-4" name="cedula" value="" placeholder="Ingrese cedula" id="cedulaEdit" required>
                </div>
                <div class="col-md-6 ps-1">
                    <label for="TelefonoEdit">Phone</label>
                    <input type="text" class="form-control rounded-4" name="telefono" value="" placeholder="Ingrese telefono" id="telefonoEdit" required>
                </div>
            </div>
            <div class="modal-footer">
                <button name="update_employee"  type="submit" class="btn btn-primary rounded-4">Update <i class="bi bi-floppy-fill ms-3"></i></button>
            </div>
        </form>
    </div>
</div>
