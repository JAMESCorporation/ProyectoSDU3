<div class="container">
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">


      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registro de Usuario</h4>
        </div>
        <div class="modal-body">
            <form action="registro.php" method="post" class="" role="form">
              <div class="form-group">
                <label class="control-label" for="nombre">Nombre:</label>
                  <input type="text" name="nombre" class="form-control" id="email" placeholder="Enter Name">
              </div>
              <div class="form-group">
                <label class="control-label" for="apellidos">Apellidos:</label>
                  <input type="text" name="apellidos" class="form-control" id="email" placeholder="Enter Name">
              </div>
              <div class="form-group">
                <label class="control-label" for="telefono">Telefono:</label>
                  <input type="text" name="telefono" class="form-control" id="email" placeholder="Enter Name">
              </div>
              <div class="form-group">
                <label class="control-label" for="direccion">Direccion:</label>
                  <input type="text" name="direccion" class="form-control" id="email" placeholder="Enter Name">
              </div>
              <div class="form-group">
                <label class="control-label" for="email">Email:</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label class="control-label" for="password">Password:</label>
                  <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
              </div>
              <div class="form-group">
                <label  for="fecha_nacimiento">Fecha de Nacimiento:</label>
                  <input type="text" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento" >
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-default">Registar</button>
              </div>
            </form>
          </div>

      </div>
    </div>
  </div>
</div>
