<?php
    $user = $_SESSION["user"];
    if($user->getTypeOfUser() == 0)
    {
        require_once('nav-user.php');
    }else if($user->getTypeOfUser() == 1)
    {
        require_once('nav.php');
    }else 
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

    $companyList = $companyDAO->GetAllBDD();
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
                         <th>Compania</th>
                         <th>posicion</th>
                         <th>carrera</th>
                         <th>fecha de caducidad</th>
                         <?php if($user->getTypeOfUser() == 0) { ?>
                         <th>agregar</th>
                         <?php  } else {
                                    if($user->getTypeOfUser() == 1 || $user->getTypeOfUser() == 2) ?>
                                        <th>Ver</th>
                         <?php } ?>
                         
                    </thead>
                    <tbody>
                         <?php
                            foreach($offerList as $offer)
                            { ?>
                                <tr>
                                <td><?php echo $offer->getIdJobOffer(); ?></td>
                                
                                    <?php

                                    foreach($companyList as $company)
                                    {
                                        if($offer->getCompanyId() == $company->getCompanyId())
                                        {
                                        ?>
                                            <td><?php echo $company->getName(); ?></td>
                                    <?php
                                        }
                                    } ?>

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
                                    <?php if($user->getTypeOfUser() == 0) { ?>
                                        <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>JobOffer/AddJobOfferToUser/<?php echo $offer->getIdJobOffer();  ?>/<?php echo $user->getId(); ?>"><i class="fas fa-plus text-dark"></i></a></td>
                                    <?php  }else{
                                                if($user->getTypeOfUser() == 1 || $user->getTypeOfUser() == 2) ?>
                                                    <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>JobOffer/ShowUsersByJobOffer/<?php echo $offer->getIdJobOffer() ?>"><i class="fas fa-search"></i></a></td>
                                                <?php } ?>
                                    </td>       
                                    </tr>       
                                                
                                        
                                </tr>
                      <?php }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>