<div class="container">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">


      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Iniciar Sesión</h4>
        </div>
        <div class="modal-body">

          <div class="container">
            <form action="logueo.php" method="post" class="form-horizontal" role="form">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Correo:</label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control input-sm" id="email" placeholder="Ingresa tu correo">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Contraseña:</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control input-sm" id="pwd" placeholder="Ingresa tu contraseña">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default">Entrar</button>
                </div>
              </div>
            </form>
          </div>
          <!-- container -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
