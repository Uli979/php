<?php 

include("../../conexion.php");

if(isset($_GET['id'])){

    $txtid=(isset($_GET['id'])?$_GET['id']:"");
    $stm=$conexion->prepare("SELECT * FROM enployee WHERE id=:txtid");
    $stm->bindparam(":txtid",$txtid);    
    $stm->execute();
    $registro=$stm->fetch(PDO::FETCH_LAZY);
    $cedula=$registro['cedula'];
    $nombre=$registro['nombre'];
    $apellido=$registro['apellido'];
    $direccion=$registro['direccion'];
    $telefono=$registro['telefono'];

    }

    if ($_POST){

        $txtid=(isset($_POST["txtid"])?$_POST["txtid"]:"");
        $cedula=(isset($_POST["cedula"])?$_POST["cedula"]:"");
        $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
        $apellido=(isset($_POST["apellido"])?$_POST["apellido"]:"");
        $direccion=(isset($_POST["direccion"])?$_POST["direccion"]:"");
        $telefono=(isset($_POST["telefono"])?$_POST["telefono"]:"");
    
        $stm=$conexion->prepare("UPDATE enployee SET cedula=:cedula,nombre=:nombre,apellido=:apellido,direccion=:direccion,telefono=:telefono WHERE id=:txtid");
        $stm->bindparam(":txtid",$txtid);
        $stm->bindparam(":cedula",$cedula);
        $stm->bindparam(":nombre",$nombre);
        $stm->bindparam(":apellido",$apellido);
        $stm->bindparam(":direccion",$direccion);
        $stm->bindparam(":telefono",$telefono);
        $stm->execute();
    
        header("Location:index.php");
    
       
    }


?>

<?php include("../../template/header.php"); ?>

<form action="" method="post">
      
       
        <input type="hidden" class="form-control" name="txtid" value="<?php echo $txtid?>" placeholder="Ingrese cedula">
        <label for="">Cedula</label>
        <input type="text" class="form-control" name="cedula" value="<?php echo $cedula?>" placeholder="Ingrese cedula">

        <label for="">Nombre</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $nombre?>" placeholder="Ingrese nombre">

        <label for="">Apellido</label>
        <input type="text" class="form-control" name="apellido" value="<?php echo $apellido?>" placeholder="Ingrese apellido">

        <label for="">Direccion</label>
        <input type="text" class="form-control" name="direccion" value="<?php echo $direccion?>" placeholder="Ingrese direccion">

        <label for="">Telefono</label>
        <input type="text" class="form-control" name="telefono" value="<?php echo $telefono?>" placeholder="Ingrese telefono">

      </div>
      <div class="modal-footer">
         <a href="index.php"class="btn btn-danger">Cancelar</a> 
         <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      </form>

      <?php include("../../template/footer.php"); ?>