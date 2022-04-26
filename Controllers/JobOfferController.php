<?php  
    namespace Controllers;

    use \Exception as Exception;
    use DAO\JobOfferDAO as JobOfferDAO;
    use Models\JobOffer as JobOffer;
    use Models\Company as Company;
    use Models\OfferXUser as OfferXUser;
    use DAO\OfferXUserDAO as OfferXUserDAO;
    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    //usar JobPositionDAO  y  CarrerDAO
    //agregar boton en la lista individual de empresas para crear jobOffer

    //me traigo el id de la empresa, le muestro los jobPosition, 
    //escoje uno y lo crea con su id de EMPRESA y JOBOFFER en la BDD

    class JobOfferController
    {
        private $JobOfferDAO;
        private $offerXUserDAO;
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->JobOfferDAO = new JobOfferDAO();
            $this->offerXUserDAO = new OfferXUserDAO();

        }

        public function Add($companyId,$JobId,$fechaCaducidad,$file)
        {
            echo "tttttttttt";

            
            try
            {
                
                echo "--------------";
                $fileName = $file["name"];
                $tempFileName = $file["tmp_name"];
                $type = $file["type"];
                
                $filePath = UPLOADS_PATH.basename($fileName);            
                echo "*********";
                $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                $imageSize = getimagesize($tempFileName);

                
                if($imageSize !== false)
                {
                    if (move_uploaded_file($tempFileName, $filePath))
                    {
                        $jobOffer = new JobOffer();
                        
                        $jobOffer->setCompanyId($companyId);
                        $jobOffer->setJobPosition($JobId);
                        $jobOffer->setFechaCaducidad($fechaCaducidad);
                        $jobOffer->setIsActive(1);
                        $jobOffer->setNombreImagen($fileName);
            
                        $this->JobOfferDAO->add($jobOffer);

                        $message = "Imagen subida correctamente";
                    }
                    else
                        $message = "Ocurrió un error al intentar subir la imagen";
                }
                else   
                    $message = "El archivo no corresponde a una imágen";
            }
            catch(Exception $ex)
            {
                $message = $ex->getMessage();
            }
            /*
            $jobOffer = new JobOffer();
                        
            $jobOffer->setCompanyId($companyId);
            $jobOffer->setJobPosition($JobId);
            $jobOffer->setFechaCaducidad($fechaCaducidad);
            $jobOffer->setIsActive(1);
            $jobOffer->setNombreImagen("prueba32.jpg");
            
            $this->JobOfferDAO->add($jobOffer);
            */
            $this->ShowListOffer($companyId);
        }

        public function editBDD($offerId,$companyId ,$JobId,$fechaCaducidad)
        {
            $jobOffer = new JobOffer();
            
            $jobOffer->setCompanyId($companyId);
            $jobOffer->setIdJobOffer($offerId);
            $jobOffer->setJobPosition($JobId);
            $jobOffer->setFechaCaducidad($fechaCaducidad);

            $this->JobOfferDAO->editBDD($jobOffer);

            $this->ShowListOffer($companyId);
        }

        public function DeleteFromBDD($offerId)
        {
            $jobOffer = new JobOffer();
            $jobOffer = $this->JobOfferDAO->GetByIdBDD($offerId);
            $this->sendMails($offerId);
            $this->JobOfferDAO->DeleteFromBDD($jobOffer);

            $this->ShowListOffer($jobOffer->getCompanyId()); 
        }

        private function sendMails($offerId)
        {
            $offerXUserList = $this->offerXUserDAO->getAll();
            $userList = $this->userDAO->getAll();
            $jobPositionList = $this->JobOfferDAO->GetJobPositionFromApi();
            $jobOfferList = $this->JobOfferDAO->GetAllBDD();

            foreach($jobOfferList as $jobOffer)
            {
                if($jobOffer->getIdJobOffer() == $offerId)
                {
                    foreach($jobPositionList as $jp)
                    {
                        if($jp->getJobPositionId() == $jobOffer->getJobPosition())
                        {
                            $jobPosition = $jp->getDescription();
                        }
                    }
                }
            }

            foreach($offerXUserList as $oXu)
            {
                if($oXu->getIdJobOffer() == $offerId)
                {
                    foreach($userList as $user)
                    {
                        if($user->getId() == $oXu->getIdUsuario())
                        {
                            $para = 'sar_sebas@hotmail.com'; //$user->getEmail();
                            $asunto = 'La busqueda para la oferta ha terminado';
                            $descripcion   = 'Le informamos que la busqueda para la oferta laboral '. $jobPosition . ' ha terminado. No te desanimes y continua postulandote!';
                            $de = 'From: paneles.led.mdq@gmail.com';

                            mail($para, $asunto, $descripcion, $de);
                        }
                    }
                }
            }
        }

        public function DeleteOfferXUser($idJobOffer, $careerDescription, $idUsuario)
        {
            $offerXUserDAO = new OfferXUserDAO();
            $offerXUserDAO->DeleteOfferXUserFromBDD($idJobOffer, $idUsuario);
            

            $this->ShowUsersByJobOffer($idJobOffer, $careerDescription); 
        }

        public function ActivateFromBDD($offerId)
        {
            $jobOffer = new JobOffer();
            $jobOffer = $this->JobOfferDAO->GetByIdBDD($offerId);
            $this->JobOfferDAO->ActivateFromBDD($jobOffer);

            $this->ShowListOffer($jobOffer->getCompanyId()); 
        }

        public function ShowReporte($idJobOffer, $careerDescription)
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."reportes.php");
        }

        public function ShowAddJobOffer($companyId)
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."jobOffer-add.php");
            else
            header("location:" .FRONT_ROOT . "User/company-list.php");
        }

        public function ShowListOffer($companyId)
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."company-list-offer.php");
            else
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function ShowEditView($offerId)
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."jobOffer-edit.php");
            else
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }
        
        public function ShowCompanyDetails($companyId)
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."company-details.php");
            else
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }
        
        
        public function AddJobOfferToUser($jobOfferId , $id)//estudiante
        {
            $offerXUser = new OfferXUser();
            $user = new User();
            $user = $this->userDAO->GetById($id);
            
            $offerXUser->setIdJobOffer($jobOfferId);
            $offerXUser->setIdUsuario($id);

            $this->offerXUserDAO->Add($offerXUser);
            
            require_once(VIEWS_PATH."user-home.php");
        }

        public function ShowUsersByJobOffer($idJobOffer, $careerDescription)
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."UsersByJobOffers.php");
            else
            header("location:" .FRONT_ROOT . "User/User-home");
        }

        public function ShowJobOfferByCompany($id)
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."jobOfferByCompany.php");
            else
            header("location:" .FRONT_ROOT . "User/User-home");
        }

        public function ShowDeleteView()
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."company-list.php");
            else
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function ShowListApplied()
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."offer-applied.php");
            else
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        
    }
?>