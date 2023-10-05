<?php require_once("template/header.php"); ?>
<?php
    require_once("conexion.php");
    
    $txtEmployeeVacio = "No hay empleados disponibles"; // messsage default of page
    $titlePagues = "List employees"; // title default of page
    $iconSearch = "bi bi-search"; // search icon for employees default

    session_start();
    
    // Obtener el valor a buscar desde el input de tipo search
    $cedula = isset($_GET["cedulaSearch"]) ? $_GET["cedulaSearch"] : "";

    // Verificar si se recibió el valor de la cédula
    if (isset($cedula) && !empty($cedula)) {
        if (isset($_SESSION['lastCedula']) && $cedula == $_SESSION['lastCedula']) {
            header("Location: /");
            unset($_SESSION['lastCedula']);
        } else {
            $_SESSION['lastCedula'] = $cedula;

            $iconSearch = "bi bi-x-lg";
            $cudelaParam = $cedula . "%";
            // Crear la consulta SQL para buscar por cédula
            $sql = "SELECT * FROM employee WHERE cedula LIKE ?";
            $titlePagues = "Search result";
            // Preparar la consulta
            $stmt = $connect->prepare($sql);
            // Asignar el valor de la cédula al marcador de posición con un símbolo % al final
            $stmt->bind_param("s", $cudelaParam);
            // Ejecutar la consulta
            $stmt->execute();
            // Obtener el resultado de la consulta
            $result = $stmt->get_result();
            // Verificar si se encontró algún resultado
            if ($result->num_rows > 0) {
                // Si se encontró algún resultado, asignar los empleados al arreglo
                $empleados = [];
                while ($row = $result->fetch_assoc()) {
                $empleados[] = $row;
                }
            } else {
                $txtEmployeeVacio = "Ningún empleado con esa cédula: " . $cedula;
            }
        }
    } else {
        // Si no se recibió, mostrar todos los empleados
        // Consulta SQL
        $query = "SELECT * FROM employee";
        // Ejecutar la consulta y obtener el resultado
        $result = $connect->query($query);
        $titlePagues = "List employees";
        if ($result) {
            $empleados = [];
            while ($row = $result->fetch_assoc()) {
                $empleados[] = $row;
                $txtEmployeeVacio = "No hay empleados disponibles";
            }
            if (isset($_GET['id'])) {
                $txtid = isset($_GET['id']) ? $_GET['id'] : NULL;
    
                // Validar que el valor sea un número entero usando el filtro FILTER_VALIDATE_INT
                if (filter_var($txtid, FILTER_VALIDATE_INT)) {
                    // Consulta SQL para eliminar
                    $deleteQuery = "DELETE FROM employee WHERE id = ?";
                    $stmt = $connect->prepare($deleteQuery);
                    $stmt->bind_param("i", $txtid); // "i" indica que es un entero
    
                    if ($stmt->execute()) {
                        header("location: /");
                    } else {
                        echo "Error al eliminar el registro: " . $stmt->error;
                    }
                } else {
                    // El valor no es un número entero válido
                    echo "El id no es válido";
                }
                
                // Cerrar la consulta preparada
                $stmt->close();
            }
        } else {
            echo "Error en la consulta: " . $connect->error;
        }
    }
?>
<?php include("modulos/contacto/create.php"); ?>

<div class="row mb-1 mt-3 ms-5 me-5 justify-content-between">
    <h1 class="fw-bold col-4 text-decoration-underline">Employees</h1>
    <div class="col-7">
        <div class="d-flex">
            <div class="flex-grow-1 me-5">
                <form action="/" method="GET">
                    <div class="input-group border border-dark rounded-pill">
                        <input type="number" id="cedulaSearch" name="cedulaSearch" class="form-control form-control-search border-0" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon2" value="<?php echo $cedula ?>" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary border-0 btn-search" type="submit"><i class="<?php echo $iconSearch ?>"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <button class="btn btn-primary rounded-4 d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#createOffcanvas" aria-controls="createOffcanvas">Add <i class="ms-1 bi bi-plus-lg"></i></button>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center"><h2 class="fw-bold"><?php echo $titlePagues ?></h2></div>
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
                            <a href="#" class="btn btn-tabla-delete"><i class="bi bi-trash3-fill"></i></a> 
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr class="table-no-bottom-border">
                    <td colspan="8" class="text-center"><?php echo $txtEmployeeVacio ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once("modulos/contacto/delete.php"); ?>
<?php include("modulos/contacto/editar.php"); ?>
<?php include("template/footer.php"); ?>