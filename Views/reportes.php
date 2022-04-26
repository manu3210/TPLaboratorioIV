<?php
    ob_start();
?>

<?php
    use DAO\CompanyDAO;
    use DAO\CareerDAO;
    use DAO\JobOfferDAO;
    use DAO\UserDAO;
    use Models\Career;
    use Models\JobPosition;
    use DAO\OfferXUserDAO;
    use Models\OfferXUser;
    USE PDF\FPDF as FPDF;

    $offerXUserList = new JobOfferDAO();
    $companyDAO = new CompanyDAO();
    $userDAO = new UserDAO();
    $careerDAO = new CareerDAO();
    $offerXUserDAO = new OfferXUserDAO();
    $offerXUser = new OfferXUser();

    $offerXUserList = $offerXUserDAO->GetListByIdJobOffer($idJobOffer);

    $studentList = $userDAO->GetListByofferXUserList($offerXUserList);
    $userDAO->MatchInfoWithAPI($studentList);
    //$studentList = $offerXUserDAO->GetListByIdJobOffer($idJobOffer);

    
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(0,10, utf8_decode('Lista de postulantes'),0,0,'C');
        $pdf->Ln(10);
        $pdf->Cell(30,10, utf8_decode('Nombre'),1,0,'C');
        $pdf->Cell(30,10, utf8_decode('Apellido'),1,0,'C');
        $pdf->Cell(30,10, utf8_decode('DNI'),1,0,'C');
        $pdf->Cell(35,10, utf8_decode('Legajo'),1,0,'C');
        $pdf->Cell(55,10, utf8_decode('Email'),1,0,'C');
        $pdf->ln();
    
?>

<h2 class="mb-4">Listado de alumnos para la busqueda de " <?php echo $careerDescription ?> "</h2>
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
                              <?php 
                            } ?>
                         
                    </tbody>
</table>
<?php
    $html=ob_get_clean();
    

    
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(0,10, utf8_decode('Lista de postulantes para '. $careerDescription),0,0,'C');
        $pdf->Ln(10);
        $pdf->Cell(30,10, utf8_decode('Nombre'),1,0,'C');
        $pdf->Cell(30,10, utf8_decode('Apellido'),1,0,'C');
        $pdf->Cell(30,10, utf8_decode('DNI'),1,0,'C');
        $pdf->Cell(55,10, utf8_decode('Email'),1,0,'C');
        $pdf->ln();
        foreach($studentList as $student){

            $pdf->Cell(30,10, utf8_decode($student->getFirstName()),1,0,'C');
            $pdf->Cell(30,10, utf8_decode($student->getLastName()),1,0,'C');
            $pdf->Cell(30,10, utf8_decode($student->getDni()),1,0,'C');
            $pdf->Cell(55,10, utf8_decode($student->getEmail()),1,0,'C');

            $pdf->Ln();
        }
       
        $pdf->Output();
    
?>