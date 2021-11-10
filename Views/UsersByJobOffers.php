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
    use DAO\CareerDAO;
    use DAO\JobOfferDAO;
    use DAO\UserDAO;
    use Models\Career;
    use Models\JobPosition;
    

    $jobOffer = new JobOfferDAO();
    $companyDAO = new CompanyDAO();
    $userDAO = new UserDAO();
    $careerDAO = new CareerDAO();

    
    

    
    $studentList = $userDAO->GetListByIdJobOffer($idJobOffer);
    
    
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de alumnos para la busqueda de <?php echo $jobOffer->getCareerByIdJobOffer($idJobOffer) ?></h2>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>FirstName</th>
                         <th>LastName</th>
                         <th>DNI</th>
                         <th>Email</th>
                         
                    </thead>
                    <tbody>
                         <?php
                            foreach($studentList as $student)
                            { ?>
                                <tr>
                                    <td><?php echo $student->getFirstName(); ?></td>
                                    <td><?php echo $student->getLastName(); ?></td>
                                    <td><?php echo $student->getDni(); ?></td>
                                    <td><?php echo $student->getEmail(); ?></td>
                                        
                                </tr> 
                      <?php } ?>
                         
                    </tbody>
               </table>
          </div>
     </section>
</main>