<?php
    
    $user = $_SESSION["user"];
    if($user->getTypeOfUser() == 0)
    {
          require_once('nav-user.php');
    }
    else
    {
          require_once('nav.php');
    }
       
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Editar perfil</h2>
               <form action="<?php echo FRONT_ROOT ?>User/Edit" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Contraseña</label>
                                   <input type="password" name="password" value="<?php echo $user->getPassword(); ?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Descripcion</label>
                                   <textarea rows="4" cols="50" name="Description" class="form-control"><?php echo $user->getDescription(); ?></textarea>
                              </div>
                         </div>
                    </div>
                    <a class="btn btn-dark mr-auto" href="<?php echo FRONT_ROOT ?>User/ShowUserHome">Volver</a>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Actualizar</button>
               </form>
          </div>
     </section>
</main>