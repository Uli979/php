<?php include("template/header.php"); ?>
<?php
    include("conexion.php");

    // Consulta SQL
    $query = "SELECT * FROM employee";

    // Ejecutar la consulta
    $result = $connect->query($query);

    if ($result) {
        $empleados = [];
        
        while ($row = $result->fetch_assoc()) {
            $empleados[] = $row;
        }

        if (isset($_GET['id'])) {
            $txtid = isset($_GET['id']) ? $_GET['id'] : "";
            
            // Consulta SQL para eliminar
            $deleteQuery = "DELETE FROM employee WHERE id = ?";
            $stmt = $connect->prepare($deleteQuery);
            $stmt->bind_param("i", $txtid); // "i" indica que es un entero

            if ($stmt->execute()) {
                header("location: index.php");
            } else {
                echo "Error al eliminar el registro: " . $stmt->error;
            }
            
            // Cerrar la consulta preparada
            $stmt->close();
        }
    } else {
        echo "Error en la consulta: " . $connect->error;
    }
?>
<?php include("modulos/contacto/create.php"); ?>

<div class="row mb-1 mt-3 ms-5 me-5 justify-content-between">
    <h1 class="fw-bold col-4 text-decoration-underline">Employees</h1>
    <div class="col-7">
        <div class="d-flex">
            <div class="flex-grow-1 me-5">
                <div class="input-group border border-dark rounded-pill">
                    <input type="search" class="form-control form-control-search border-0" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary border-0 btn-search" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary rounded-4 d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#createOffcanvas" aria-controls="createOffcanvas">Add <i class="ms-1 bi bi-plus-lg"></i></button>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center"><h2 class="fw-bold">List employees</h2></div>
<div class="table-responsive p-3 mb-2 border border-1  border-dark rounded-4">
    <table class="table">
        <thead class="table table-no-bottom-border text-center">
            <tr>
                <th scope="col">  </th>
                <th scope="col">Employee ID</th>
                <th scope="col">Names</th>
                <th scope="col">Surnames</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Edit</th>
                <th scope="col" class="ps-0">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($empleados)) { ?>
                <?php foreach($empleados as $empleado) { ?>
                    <tr class="table-no-bottom-border text-center">
                        <td scope="row" class="align-middle numberID" data-id="<?php echo $empleado ['id']; ?>"># <?php echo $empleado ['id']; ?></td>
                        <td class="align-middle border-end border-dark border-bottom-0 pt-0 pb-0 employeeID"><?php echo $empleado ['cedula']; ?></td>
                        <td class="align-middle border-end border-dark border-bottom-0 pt-0 pb-0 employeeName"><?php echo $empleado ['nombre']; ?></td>
                        <td class="align-middle border-end border-dark border-bottom-0 pt-0 pb-0 employeeSurnames"><?php echo $empleado ['apellido']; ?></td>
                        <td class="align-middle border-end border-dark border-bottom-0 pt-0 pb-0 employeeAddress"><?php echo $empleado ['direccion']; ?></td>
                        <td class="align-middle pt-0 pb-0 employeePhone"><?php echo $empleado ['telefono']; ?></td>
                        <td class="align-middle pt-0 pb-0">
                            <a href="#" class="btn btn-tabla-edit" data-bs-toggle="offcanvas" data-bs-target="#editarEmpleadoOffcanvas" aria-controls="editarEmpleadoOffcanvas"><i class="bi bi-pencil-fill"></i></a>
                        </td>
                        <td class="align-middle pt-0 pb-0 ps-0">
                            <a href="index.php?id=<?php echo $empleado['id']; ?>" class="btn btn-tabla-delete"><i class="bi bi-trash3-fill"></i></a> 
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr class="table-no-bottom-border">
                    <td colspan="8" class="text-center">No hay empleados disponibles</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("modulos/contacto/editar.php"); ?>
<?php include("template/footer.php"); ?>