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
                         <th></th>
                         <th></th>
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
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>JobOffer/ShowEditView/<?php echo $offer->getIdJobOffer(); ?>"><i class="far fa-edit text-dark"></i></a></td>
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>JobOffer/DeleteFromBDD/<?php echo $offer->getIdJobOffer(); ?>"><i class="fas fa-trash-alt"></i></a></td>
                                             
                                        </tr>
                                   <?php
                                   }
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>