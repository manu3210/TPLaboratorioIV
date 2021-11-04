<main class="d-flex align-items-center justify-content-center height-100">

     <div class="content">
     <h2>Crear Contraseña</h2>
          <form action="<?php echo FRONT_ROOT ?>User/SetPass" method="post" class="login-form bg-dark-alpha p-5 text-white">
               <div>
                    <input type="hidden" name="idApi" value="<?php echo $idApi; ?>">
               </div>
               <div class="form-group">
                    <label for="">Email </label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email">
               </div>
               <div class="form-group">
                    <label for="">Contraseña nueva: </label>
                    <input type="password" name="pass" class="form-control form-control-lg" placeholder="Ingresar constraseña">
               </div>
               <button class="btn btn-dark btn-block btn-lg" type="submit">Cambiar Contraseña</button>
          </form>
     </div>
</main>