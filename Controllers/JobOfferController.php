<?php  
    namespace Controllers;

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

        public function add($companyId,$JobId,$fechaCaducidad)
        {
            $jobOffer = new JobOffer();
            
            $jobOffer->setCompanyId($companyId);
            $jobOffer->setJobPosition($JobId);
            $jobOffer->setFechaCaducidad($fechaCaducidad);

            $this->JobOfferDAO->add($jobOffer);

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
            $this->JobOfferDAO->DeleteFromBDD($jobOffer);

            $this->ShowListOffer($jobOffer->getCompanyId());
            
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
            $user->setAlreadyAplied(1);
            $this->userDAO->Update($user);

            $this->offerXUserDAO->Add($offerXUser);
            
            

            require_once(VIEWS_PATH."user-home.php");
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