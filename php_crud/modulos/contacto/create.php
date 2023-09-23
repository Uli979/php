<?php

if ($_POST){

    $cedula=(isset($_POST["cedula"])?$_POST["cedula"]:"");
    $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
    $apellido=(isset($_POST["apellido"])?$_POST["apellido"]:"");
    $direccion=(isset($_POST["direccion"])?$_POST["direccion"]:"");
    $telefono=(isset($_POST["telefono"])?$_POST["telefono"]:"");

    $stm=$conexion->prepare("INSERT INTO enployee(id,cedula,nombre,apellido,direccion,telefono)
    VALUES(null,:cedula,:nombre,:apellido,:direccion,:telefono)");
    $stm->bindparam(":cedula",$cedula);
    $stm->bindparam(":nombre",$nombre);
    $stm->bindparam(":apellido",$apellido);
    $stm->bindparam(":direccion",$direccion);
    $stm->bindparam(":telefono",$telefono);
    $stm->execute();

    header("Location:index.php");

   
}

?>



<!-- Modal create-->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR EMPLEADO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <label for="">Cedula</label>
        <input type="text" class="form-control" name="cedula" value="" placeholder="Ingrese cedula">

        <label for="">Nombre</label>
        <input type="text" class="form-control" name="nombre" value="" placeholder="Ingrese nombre">

        <label for="">Apellido</label>
        <input type="text" class="form-control" name="apellido" value="" placeholder="Ingrese apellido">

        <label for="">Direccion</label>
        <input type="text" class="form-control" name="direccion" value="" placeholder="Ingrese direccion">

        <label for="">Telefono</label>
        <input type="text" class="form-control" name="telefono" value="" placeholder="Ingrese telefono">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>