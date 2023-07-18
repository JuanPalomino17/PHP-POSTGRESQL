<?php
require_once "vistas/parte_superior.php";
?>

<!--INICIO del cont principal-->
<div class="container">
  <?php
  include_once 'bd/conexion.php';
  $objeto = new Conexion();
  $conexion = $objeto->Conectar();

  $consulta = "SELECT id, nombre, telefono, correo FROM usuarios";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class='btn-group'><button class='btn btn-primary' id="btnNuevo" type="button" data-toggle="modal">Nuevo</button></div>
      </div>
    </div>
  </div>
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
            <thead class="text-center">
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($data as $dat) {
              ?>
                <tr>
                  <td><?php echo $dat['id'] ?></td>
                  <td><?php echo $dat['nombre'] ?></td>
                  <td><?php echo $dat['telefono'] ?></td>
                  <td><?php echo $dat['correo'] ?></td>
                  <td></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!--Modal para CRUD-->
  <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form id="formPersonas">
          <div class="modal-body">
              <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" required>
              </div>
              <div class="form-group">
                <label for="apellido" class="col-form-label">telefono:</label>
                <input type="input" class="form-control" id="telefono" required>
              </div>
              <div class="form-group">
                <label for="apellido" class="col-form-label">Correo:</label>
                <input type="mail" class="form-control" id="correo" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <!--Modal de confirmación de borrado-->
  <div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Eliminar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p style="color:black;">¿Está seguro de eliminar este registro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" id="btnConfirmarEliminar" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
  <!--FIN del cont principal-->
  <?php require_once "vistas/parte_inferior.php" ?>
  <script src="js/sweetalert.js"></script>