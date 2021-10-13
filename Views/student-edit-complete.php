<?php
     use Models\User;
     use DAO\UserDAO;
    
    require_once('nav.php');

    $userDao = new UserDAO();
    $userToModify = $userDao->GetById($userId);
    
       
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Editar perfil</h2>
               <form action="<?php echo FRONT_ROOT ?>User/EditAdmin" method="post" class="bg-light-alpha p-5">
                    <div class="row">   
                        <input type="hidden" name="id" value="<?php echo $userToModify->getId(); ?>">                      
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Career Id</label>
                                   <input type="text" name="careerId" value="<?php echo $userToModify->getCareerId(); ?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Activar/Desactivar</label> <br>
                                   <input type="radio" name="isActive" value="1" id="Activar" checked >
                                   <label for="Activar">Activar</label>
                                   <input type="radio" name="isActive" value="0" id="Desactivar" >
                                   <label for="Desactivar">Desactivar</label><br>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="firstName" value="<?php echo $userToModify->getFirstName(); ?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Apellido</label>
                                   <input type="text" name="lastName" value="<?php echo $userToModify->getLastName(); ?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Tipo de usuario</label><br>
                                   <input type="radio" name="type" value="1" id="admin">
                                   <label for="admin">Administrador</label>
                                   <input type="radio" name="type" value="0" id="user" checked>
                                   <label for="user">usuario</label><br>
                              </div>
                         </div>
                    </div>
                    <a class="btn btn-dark mr-auto" href="<?php echo FRONT_ROOT ?>User/ShowListView">Volver</a>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Actualizar</button>
               </form>
          </div>
     </section>
</main>