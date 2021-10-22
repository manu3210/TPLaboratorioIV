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
               <h2 class="mb-4">Listado de Empresas</h2>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>Id</th>
                         <th>Nombre</th>
                         <th>Email</th>
                         <th>Telefono</th>
                         <th></th>
                         <th></th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($companyList as $company)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $company->getCompanyId() ?></td>
                                             <td><?php echo $company->getName() ?></td>
                                             <td><?php echo $company->getEmail() ?></td>
                                             <td><?php echo $company->getPhoneNumber() ?></td>
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>Company/ShowEditView/<?php echo $company->getCompanyId(); ?>"><i class="far fa-edit text-dark"></i></a></td>
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>Company/delete/<?php echo $company->getCompanyId(); ?>"><i class="fas fa-trash-alt"></i></a></td>
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