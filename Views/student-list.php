<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Usuarios</h2>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>Legajo</th>
                         <th>Apellido</th>
                         <th>Nombre</th>
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
                                             <td><?php echo $user->getLastName() ?></td>
                                             <td><?php echo $user->getFirstName() ?></td>
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
          </div>
     </section>
</main>