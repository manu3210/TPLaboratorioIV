<?php

use DAO\JobOfferDAO;
use DAO\OfferXUserDAO;
use Models\Career;
use Models\JobOffer;
use Models\JobPosition;
use Models\OfferXUser;

$user = $_SESSION["user"];
    if($user->getTypeOfUser() == 0)
    {
          require_once('nav-user.php');
    }
    else
    {
          require_once('nav.php');
    }

    $offerXUserDAO = new OfferXUserDAO();
    $offerXuserList = $offerXUserDAO->GetAll();
    $jobOfferDAO = new JobOfferDAO();
    $jobPositionList = $jobOfferDAO->GetJobPositionFromApi();
    $careerList = $jobOfferDAO->GetCareerFromApi();
    $jobOfferList = $jobOfferDAO->GetAllBDD();
    $jobOffer = new JobOffer();
    $jobPosition = new JobPosition();
    $career = new Career();
    $flag = 0;

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
                    </thead>
                    <tbody>

                         <td>
                         <?php 
                         foreach($offerXuserList as $offerXUser)
                         {
                              if($offerXUser->getIdUsuario() == $user->getId())
                              {
                                   $flag = 1;
                                   foreach($jobOfferList as $offer)
                                   {
                                        if($offerXUser->getIdJobOffer() == $offer->getIdJobOffer())
                                        {
                                             $jobOffer = $offer;
                                        }
                                   }
                              }
                              
                              
                         }
                         echo $jobOffer->getIdJobOffer();
                         ?>
                         </td>

                         <td>
                         <?php 
                         if($flag == 1)
                         {
                              foreach($jobPositionList as $position)
                              {
                                   if($position->getJobPositionId() == $jobOffer->getJobPosition())
                                   {
                                        $jobPosition = $position;
                                   }
                              }
                              echo $jobPosition->getDescription();
                         }
                         
                         ?>
                         </td>

                         <td>
                         <?php 
                         if($flag == 1)
                         {
                              foreach($careerList as $c)
                              {
                                   if($jobPosition->getCareerId() == $c->getCareerId())
                                   {
                                        $career = $c;
                                   }
                              }
                              echo $career->getDescription();
                         }
                         ?>
                         </td>

                         <td><?php echo $jobOffer->getFechaCaducidad(); ?></td>

                              
                         
                    </tbody>
               </table>
               <div class="row justify-content-between">
                    <div class="col-3">
                         <a href="<?php echo FRONT_ROOT ?>User/ShowUserHome/"class="btn btn-dark me-md-2" type="button">Volver</a>
                    </div>
               </div>
          </div>
     </section>
</main>