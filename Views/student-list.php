<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div class="row justify-content-between">
                    <div class="col-6">
                         <h2 class="mb-4">Listado de Usuarios</h2>
                    </div>
                    <div class="col-4">
                         <form class="d-flex" action="<?php echo FRONT_ROOT?>User/ShowListfilteredView" method="post">
                              <input class="form-control me-2" type="search" name="email" placeholder="email del usuario" aria-label="Search">
                              <button class="btn btn-outline-success" type="submit">Buscar</button>
                         </form>
                    </div>
               </div>
               <hr>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>Legajo</th>
                         <th>Email</th>
                         <th>Tipo de usuario</th>
                         <th>Editar usuario</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($studentList as $user)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $user->getId() ?></td>
                                             <td><?php echo $user->getEmail() ?></td>
                                             <td>
                                                  <?php 
                                                       if($user->getTypeOfUser() == 1) 
                                                            echo "Administrador";
                                                       else
                                                            echo "Usuario";
                                                  ?>
                                             </td>
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>User/ShowEditFullView/<?php echo $user->getId(); ?>"><i class="far fa-edit text-dark"></i></a></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
               <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?php echo FRONT_ROOT ?>User/ShowUserHome/"class="btn btn-primary me-md-2" type="button">Volver</a>
               </div>
          </div>
     </section>
</main>