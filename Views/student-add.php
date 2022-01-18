<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar usuario</h2>
               <hr>
               <form action="<?php echo FRONT_ROOT ?>User/AddUser" method="post" class="bg-dark-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <input type="radio" id="user" name="type" value="user">
                              <label for="user">Usuario</label>
                              <br>
                              <input type="radio" id="admin" name="type" value="admin">
                              <label for="admin">Administrador</label>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="text" name="email" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Contraseña</label>
                                   <input type="password" name="pass" value="" class="form-control">
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-lg-4">
                              <label for="idApi">Id Api (para admin = 0)</label>
                              <input type="number" min="0" max="200" name="idApi" required>
                         </div>
                         <div class="col-lg-4">
                              <label for="description">Descripcion</label>
                              <textarea id="description" name="description" rows="4" cols="50"></textarea>
                         </div>
                    </div>
                    <button type="submit" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>