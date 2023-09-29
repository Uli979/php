<?php
    if ($_POST) {
        if (isset($_POST["create_employee"])) {
            // Lógica para crear un nuevo empleado
            $cedula = (isset($_POST["cedula"]) ? $_POST["cedula"] : "");
            $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
            $apellido = (isset($_POST["apellido"]) ? $_POST["apellido"] : "");
            $direccion = (isset($_POST["direccion"]) ? $_POST["direccion"] : "");
            $telefono = (isset($_POST["telefono"]) ? $_POST["telefono"] : "");
    
            // Prepara la consulta SQL para la creación de empleado
            $sql = "INSERT INTO employee (cedula, nombre, apellido, direccion, telefono)
                    VALUES (?, ?, ?, ?, ?)";
    
            $stm = $connect->prepare($sql);
    
            // Enlaza los valores a los marcadores de posición utilizando bind_param
            $stm->bind_param("sssss", $cedula, $nombre, $apellido, $direccion, $telefono);
    
            // Ejecuta la consulta
            $stm->execute();
    
            header("Location: /");
        } elseif (isset($_POST["update_employee"])) {
            // Lógica para actualizar un empleado existente
            $txtid = (isset($_POST["txtid"]) ? $_POST["txtid"] : "");
            $cedula = (isset($_POST["cedula"]) ? $_POST["cedula"] : "");
            $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
            $apellido = (isset($_POST["apellido"]) ? $_POST["apellido"] : "");
            $direccion = (isset($_POST["direccion"]) ? $_POST["direccion"] : "");
            $telefono = (isset($_POST["telefono"]) ? $_POST["telefono"] : "");
    
            // Prepara la consulta SQL para la actualización de empleado
            $sql = "UPDATE employee SET cedula=?, nombre=?, apellido=?, direccion=?, telefono=? WHERE id=?";
    
            $stm = $connect->prepare($sql);
    
            // Enlaza los valores a los marcadores de posición utilizando bind_param
            $stm->bind_param("sssssi", $cedula, $nombre, $apellido, $direccion, $telefono, $txtid);
    
            // Ejecuta la consulta
            $stm->execute();
    
            header("Location: /");
        }
    }
?>

<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="createOffcanvas" aria-labelledby="createOffcanvasLabel">
    <div class="offcanvas-header pt-4 pb-4">
        <h5 class="offcanvas-title" id="createOffcanvasLabel">New Employee</h5>
        <button type="button" class="btn-close-offcanvas border-0 rounded-2 p-1" data-bs-dismiss="offcanvas" aria-label="Cerrar"><i class="bi bi-x-lg pe-1 ps-1"></i></button>
    </div>
    <div class="offcanvas-body">
        <!-- Contenido del offcanvas -->
        <form action="" method="post">
            <div class="mb-3 row">
                <div class="col-md-6 pe-1">
                    <label for="nombre" class="form-label">Name</label>
                    <input type="text" class="form-control rounded-4" id="nombre" name="nombre" placeholder="Enter name">
                </div>
                <div class="col-md-6 ps-1">
                    <label for="apellido" class="form-label">Surnames</label>
                    <input type="text" class="form-control rounded-4" id="apellido" name="apellido" placeholder="Enter Last Name">
                </div>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Address</label>
                <input type="text" class="form-control rounded-4" id="direccion" name="direccion" placeholder="Enter address">
            </div>
            <div class="mb-3 row">
                <div class="col-md-6 pe-1">
                    <label for="telefono" class="form-label">Phone</label>
                    <input type="text" class="form-control rounded-4" id="telefono" name="telefono" placeholder="Enter phone">
                </div>
                <div class="col-md-6 ps-1">
                    <label for="cedula" class="form-label">ID Employee</label>
                    <input type="text" class="form-control rounded-4" id="cedula" name="cedula" placeholder="Enter ID">
                </div>
            </div>
            <div class="modal-footer">
                <button name="create_employee" type="submit" class="btn btn-primary rounded-4">Save <i class="ms-1 bi bi-plus-lg"></i></button>
            </div>
        </form>
    </div>
</div>
