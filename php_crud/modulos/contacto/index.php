<?php 

include("../../conexion.php");

$stm=$conexion->prepare("SELECT * FROM enployee");
$stm->execute();
$empleados=$stm->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['id'])){

$txtid=(isset($_GET['id'])?$_GET['id']:"");
$stm=$conexion->prepare("DELETE FROM enployee WHERE id=:txtid");    
$stm->bindparam(":txtid",$txtid);
$stm->execute();
header("location:index.php");

}

?>


<?php include("../../template/header.php"); ?>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
Agregar Empleado
</button>
<br><br>
<div class="table-responsive">
    <table class="table">
        <thead class="table table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Cedula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Direccion</th>
                <th scope="col">Telefono</th>
                

            </tr>
        </thead>
        <tbody>
            <?php foreach($empleados as $empleado) {?>
            <tr class="">
                <td scope="row"><?php echo $empleado ['id']; ?></td>
                <td><?php echo $empleado ['cedula']; ?></td>
                <td><?php echo $empleado ['nombre']; ?></td>
                <td><?php echo $empleado ['apellido']; ?></td>
                <td><?php echo $empleado ['direccion']; ?></td>
                <td><?php echo $empleado ['telefono']; ?></td>
                <td>
                <a href="editar.php?id=<?php echo $empleado ['id']; ?>" class="btn btn-success">Editar</a> 
                <a href="index.php?id=<?php echo $empleado ['id']; ?>" class="btn btn-danger">Eliminar</a>    


                </td>
                
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php include("create.php"); ?>

<?php include("../../template/footer.php"); ?>