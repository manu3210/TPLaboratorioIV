<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Empresas</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Id</th>
                         <th>Nombre</th>
                         <th>Email</th>
                         <th>Telefono</th>
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
                                             <td><a class="btn btn-warning" href="<?php echo FRONT_ROOT ?>Company/ShowEditView/<?php echo $company->getCompanyId() ?>"  >Editar</a></td>
                                             <td><a class="btn btn-danger" href="<?php echo FRONT_ROOT ?>Company/delete/<?php echo $company->getCompanyId() ?>">Eliminar</a></td>
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