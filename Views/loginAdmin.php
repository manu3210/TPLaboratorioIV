<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <h2 style="text-align:center">Ingreso de Administrador</h2>
          <form action="<?php echo FRONT_ROOT ?>User/LoginAdmin" method="post" class="login-form bg-dark-alpha p-5 text-white">
               <div class="form-group">
                    <label for="">Usuario</label>
                    <input type="text" name="email" class="form-control form-control-lg" placeholder="Ingresar usuario">
               </div>
               <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" name="pass" class="form-control form-control-lg" placeholder="Ingresar constraseña">
               </div>
               <button class="btn btn-dark btn-block btn-lg" type="submit">Iniciar Sesión</button>
               <br>
               <div>
               <a href="<?php echo FRONT_ROOT ?>User/ShowLoginView" >Click aca para ingresar como Usuario</a>
               <br>
               <a href="<?php echo FRONT_ROOT ?>Company/ShowLoginCompany" >Click aca para ingresar como Empresa</a>
               </div>
               <div style="color: red; text-align:center;">
                    <?php if(isset($_SESSION["msj"])){echo $_SESSION["msj"];session_destroy();} ?>
               </div>
          </form>
          
     </div>
</main>