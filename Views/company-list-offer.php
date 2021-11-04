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

    use DAO\CompanyDAO;
    use DAO\JobOfferDAO;
    use Models\Career;
    use Models\JobPosition;

     $jobOffer = new JobOfferDAO();
    $companyDAO = new CompanyDAO();

    $position = new JobPosition();
    $career = new Career();

    $company = $companyDAO->GetByIdBDD($companyId);
    $offerList = $jobOffer->GetAllBDD();
    $jobPositionList = $jobOffer->GetJobPositionFromApi();
    $careerList = $jobOffer->GetCareerFromApi();


?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de ofertas</h2>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>Id</th>
                         <th>posicion</th>
                         <th>carrera</th>
                         <th>fecha de caducidad</th>
                         <?php if($user->getTypeOfUser() == 1) {?>
                         <th></th>
                         <th></th>
                         <?php } ?>
                         <th></th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($offerList as $offer)
                              {
                                   if($offer->getCompanyId() == $company->getCompanyId())
                                   {
                                   ?>
                                        <tr>
                                             <td><?php echo $offer->getIdJobOffer() ?></td>

                                             <td>
                                                 <?php 
                                                    foreach($jobPositionList as $jobPosition)
                                                    {
                                                         
                                                       if($jobPosition->getJobPositionId() == $offer->getJobPosition())
                                                       {
                                                            $position = $jobPosition;
                                                            foreach($careerList as $c)
                                                            {
                                                            if($position->getCareerId() == $c->getCareerId())
                                                            {
                                                                 $career = $c;
                                                            }
                                                            }
                                                            echo $position->getDescription();
                                                       }
                                                  }
                                                ?>
                                             </td>

                                             <td><?php echo $career->getDescription(); ?></td>
                                             <td><?php echo $offer->getFechaCaducidad(); ?></td>
                                             <?php if($user->getTypeOfUser() == 1) {?>
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>JobOffer/ShowEditView/<?php echo $offer->getIdJobOffer(); ?>"><i class="far fa-edit text-dark"></i></a></td>
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>JobOffer/DeleteFromBDD/<?php echo $offer->getIdJobOffer(); ?>"><i class="fas fa-trash-alt"></i></a></td>
                                             <?php } ?>
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>JobOffer/AddJobOfferToUser/<?php echo $offer->getIdJobOffer();  ?>/<?php echo $user->getId(); ?>"><i class="fas fa-plus text-dark"></i></a></td>
                                        </tr>
                                   <?php
                                   }
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
               <div class="row justify-content-between">
                    <div class="col-3">
                         <a href="<?php echo FRONT_ROOT ?>Company/ShowCompanyDetails/<?php echo $companyId; ?>"class="btn btn-dark me-md-2" type="button">Volver</a>
                    </div>
                    <?php
                    if($user->getTypeOfUser() == 1)
                    { ?>
                         <div class="col-3">
                         <a href="<?php echo FRONT_ROOT ?>JobOffer/ShowAddJobOffer/<?php echo $companyId; ?>" class="btn btn-primary me-md-2" type="button">Agregar puesto Laboral</a>
                         </div>
                    <?php }
                    else
                    {}?>
                    
               </div>
          </div>
     </section>
</main>