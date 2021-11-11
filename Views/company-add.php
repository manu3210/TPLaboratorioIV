<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar empresa</h2>
               <hr>
               <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post" class="bg-dark-alpha p-5">
                    <div class="row">
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="name" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="email" value="" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Contraseña</label>
                                   <input type="password" name="pass" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">PhoneNumber</label>
                                   <input type="text" name="phoneNumber" value="" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <div class="row justify-content-between">
                         <div class="col-3">
                              <a href="<?php echo FRONT_ROOT ?>User/ShowUserHome/"class="btn btn-dark me-md-2" type="button">Volver</a>
                         </div>
                         <div class="col-3">
                              <button type="submit" class="btn btn-primary ml-auto d-block">Agregar</button>
                         </div>
                    </div>
               </form>
          </div>
     </section>
</main>