<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <form action="<?php echo FRONT_ROOT ?>Home/login" method="post" class="login-form bg-dark-alpha p-5 text-white">
               <div class="form-group">
                    <label for="">Usuario</label>
                    <input type="text" name="user" class="form-control form-control-lg" placeholder="Ingresar usuario">
               </div>
               <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="text" name="pass" class="form-control form-control-lg" placeholder="Ingresar constraseña">
               </div>
               <button class="btn btn-dark btn-block btn-lg" type="submit">Iniciar Sesión</button>
          </form>
     </div>
</main>