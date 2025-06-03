<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar usuarios</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <?php
            if($_SESSION["perfil"] == "Administrador"){
              echo '<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar Administradores</button>';
            }
          ?>        
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered table-striped tablaUsuarios" width="100%">
            <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Teléfono</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
            </thead>
            
            <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!--=====================================
MODAL AGREGAR ADMINISTRADOR
======================================-->
<div class="modal fade" id="modalAgregarUsuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar Administrador</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA EL NOMBRE -->            
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-users"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Ingresa el nombre" name="nuevoNombre" required>
                </div>
              </div>

            <!-- ENTRADA PARA EL USUARIO -->            
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Ingresa el usuario" id="nuevoUsuario" name="nuevoUsuario" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL EMAIL -->            
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" placeholder="Ingresa el email" name="nuevoEmail" required>
              </div>
            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->            
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Ingresa la contraseña" name="nuevoPassword" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div>
                <input type="number" class="form-control" name="nuevoTelefono" placeholder="Ingresar teléfono" value="57" required>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
            <div class="form-group">          
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-users"></i></span>
                </div>
                <select class="form-control input-lg" name="nuevoPerfil">
                  <option value="">Selecionar perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Revendedor">Revendedor</option>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group">              
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso máximo de la foto 5 MB</p>
              <img src="public/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div> 
      </form>
      <?php
        $crearUsuario = new ControladorUsuarios();
        $crearUsuario -> ctrRegistroUsuario();
      ?>     
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--=====================================
MODAL EDITAR USUARIO
======================================-->
<div class="modal fade" id="modalEditarUsuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Administradores</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="box-body">
              <!-- ENTRADA PARA EL NOMBRE -->            
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-users"></i></span>
                  </div>
                    <input type="text" class="form-control" placeholder="Editar el nombre" name="editarNombre" id="editarNombre" required>
                    <input type="hidden" class="form-control" name="editarId" id="editarId">
                </div>
              </div>

              <!-- ENTRADA PARA EL USUARIO -->            
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                  </div>
                  <?php
                    if($_SESSION["perfil"] == "Administrador"){
                      echo '<input type="text" class="form-control" placeholder="Editar el usuario" name="editarUsuario" id="editarUsuario">';
                    }else{
                     echo '<input type="text" class="form-control" placeholder="Editar el usuario" name="editarUsuario" id="editarUsuario" readonly>';
                    }
                  ?>                  
                  <input type="hidden" class="form-control" name="editarCarpeta" id="editarCarpeta">
                </div>
              </div>

              <!-- ENTRADA PARA EL EMAIL -->
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                  </div>
                  <input type="email" class="form-control" placeholder="Editar el E-mail" id="editarEmail" name="editarEmail" required>
                </div>
              </div>

              <!-- ENTRADA PARA LA CONTRASEÑA -->            
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                  </div>
                  <input type="password" class="form-control" placeholder="Cambiar la contraseña" name="editarPassword">
                  <input type="hidden" id="passwordActual" name="passwordActual">
                </div>
              </div>

              <!-- ENTRADA PARA EL TELÉFONO -->
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                  </div>
                  <input type="number" class="form-control" name="editarTelefono" id="editarTelefono" placeholder="Ingresar teléfono" value="57" required>
                </div>
              </div>

              <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
              <div class="form-group">          
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-users"></i></span>
                  </div>
                  <?php
                    if($_SESSION["perfil"] == "Administrador"){
                      echo '<select class="form-control input-lg" name="editarPerfil">                  
                          <option value="" id="editarPerfil"></option>
                          <option value="Administrador">Administrador</option>
                          <option value="Revendedor">Revendedor</option>
                        </select>';
                    }else{
                      echo '<select class="form-control input-lg" name="editarPerfil" readonly>                  
                          <option value="" id="editarPerfil"></option>
                        </select>';
                    }
                  ?>                  
                </div>
              </div>

              <!-- ENTRADA PARA SUBIR FOTO -->
              <div class="form-group">
                <div class="panel">SUBIR FOTO</div>
                <input type="file" class="nuevaFoto" name="editarFoto">
                <p class="help-block">Peso máximo de la foto 5 MB</p>      
                <img src="public/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">
                <input type="hidden" name="fotoActual" id="fotoActual">
              </div>
            </div>
        </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      </div>
      </form>
      <?php
        $editarUsuario = new ControladorUsuarios();
        $editarUsuario -> ctrEditarUsuario();
      ?>  
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--=====================================
MODAL EDITAR USUARIO
======================================-->
<div class="modal fade" id="modalEditarUsuarioR">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Administradores</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="box-body">
              <!-- ENTRADA PARA EL NOMBRE -->            
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-users"></i></span>
                  </div>
                    <input type="text" class="form-control" placeholder="Editar el nombre" name="editarNombre" id="editarNombreR" readonly>
                    <input type="hidden" class="form-control" name="editarId" id="editarIdR">
                </div>
              </div>

              <!-- ENTRADA PARA EL USUARIO -->            
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                  </div>
                    <input type="text" class="form-control" placeholder="Editar el usuario" name="editarUsuario" id="editarUsuarioR" readonly>
                  <input type="hidden" class="form-control" name="editarCarpeta" id="editarCarpetaR">
                </div>
              </div>

              <!-- ENTRADA PARA EL EMAIL -->
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                  </div>
                  <input type="email" class="form-control" placeholder="Editar el E-mail" id="editarEmailR" name="editarEmail" required>
                </div>
              </div>

              <!-- ENTRADA PARA LA CONTRASEÑA -->            
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                  </div>
                  <input type="password" class="form-control" placeholder="Cambiar la contraseña" name="editarPassword">
                  <input type="hidden" id="passwordActualR" name="passwordActual">
                </div>
              </div>

              <!-- ENTRADA PARA EL TELÉFONO -->
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                  </div>
                  <input type="number" class="form-control" name="editarTelefono" id="editarTelefonoR" placeholder="Ingresar teléfono" value="+57" required>
                </div>
              </div>

              <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
              <div class="form-group">          
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-users"></i></span>
                  </div>
                  <?php
                    if($_SESSION["perfil"] == "Administrador"){
                      echo '<select class="form-control input-lg" name="editarPerfil">                  
                          <option value="" id="editarPerfilR"></option>
                          <option value="Administrador">Administrador</option>
                          <option value="Revendedor">Revendedor</option>
                        </select>';
                    }else{
                      echo '<select class="form-control input-lg" name="editarPerfil" readonly>                  
                          <option value="" id="editarPerfilR"></option>
                        </select>';
                    }
                  ?>                  
                </div>
              </div>

              <!-- ENTRADA PARA SUBIR FOTO -->
              <div class="form-group">
                <div class="panel">SUBIR FOTO</div>
                <input type="file" class="nuevaFoto" name="editarFoto">
                <p class="help-block">Peso máximo de la foto 5 MB</p>      
                <img src="public/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">
                <input type="hidden" name="fotoActual" id="fotoActualR">
              </div>
            </div>
        </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      </div>
      </form>
      <?php
        $editarUsuario = new ControladorUsuarios();
        $editarUsuario -> ctrEditarUsuario();
      ?>  
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();
?>