<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar alumno</h2>
               <form action="<?php echo FRONT_ROOT ?>User/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Id</label>
                                   <input type="text" name="id" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                   <label for="">Id Carrera</label>
                                   <input type="text" name="careerId" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                   <label for="">Dni</label>
                                   <input type="text" name="dni" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                   <label for="">Telefono</label>
                                   <input type="text" name="phone" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="firstName" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                   <label for="">File number</label>
                                   <input type="text" name="fileNumber" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                   <label for="">Genero</label><br>
                                   <input type="radio" name="gender" value="1" id="Activar" checked >
                                   <label for="Activar">Hombre</label><br>
                                   <input type="radio" name="gender" value="0" id="Desactivar" >
                                   <label for="Desactivar">Mujer</label><br>
                              </div>
                              <div class="form-group">
                                   <label for="">Tipo de usuario</label><br>
                                   <input type="radio" name="type" value="1" id="admin">
                                   <label for="admin">Administrador</label>
                                   <input type="radio" name="type" value="0" id="user" checked>
                                   <label for="user">usuario</label><br>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Apellido</label>
                                   <input type="text" name="lastName" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="text" name="email" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                   <label for="">Fecha de nacimiento</label>
                                   <input type="date" name="birthdate" value="" class="form-control">
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>