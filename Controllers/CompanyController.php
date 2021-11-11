<?php  
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    use DAO\JobOfferDAO as JobOfferDAO;

    class CompanyController
    {
        private $CompanyDAO;

        public function __construct()
        {
            $this->CompanyDAO = new CompanyDAO();
            $this->JobOfferDAO = new JobOfferDAO();
        }

        public function deleteFromBDD($recordId)
        {
            $company = new Company();
            
            $company->setCompanyId($recordId);

            if( $this->JobOfferDAO->countJobOffers($recordId ) == 0 )
                $this->CompanyDAO->deleteFromBDD($company);
            
                //no se pudo borrar porque tiene al menos un JobOffer creado

            $this->ShowListView();
        }

        public function add($name,$email,$phoneNumber)
        {
            $company = new Company();
            
            $company->setName($name);
            $company->setEmail($email);
            $company->setPhoneNumber($phoneNumber);
            $company->setIsActive(1);

            $this->CompanyDAO->add($company);

            $this->ShowAddCompanyView();
        }

        public function edit($recordId,$name,$email,$phoneNumber)
        {
            $company = new Company();
            
            $company->setCompanyId($recordId);
            $company->setName($name);
            $company->setEmail($email);
            $company->setPhoneNumber($phoneNumber);
            $company->setIsActive(1);

            $this->CompanyDAO->editJSON($company);

            $this->ShowListView();
        }

        public function editBDD($recordId,$name,$email,$phoneNumber,$pass)
        {
            $company = new Company();
            
            $company->setCompanyId($recordId);
            $company->setName($name);
            $company->setEmail($email);
            $company->setPhoneNumber($phoneNumber);
            $company->setIsActive(1);
            $company->setPass($pass);

            $this->CompanyDAO->editBDD($company);

            $this->ShowListView();
        }

        public function activateCompany($recordId)
        {
            $company = new Company();
            
            $company->setCompanyId($recordId);

            $this->CompanyDAO->activateFromBDD($company);

            $this->ShowListView();
        }

        public function delete($recordId)
        {
            $company = new Company();
            
            $company->setCompanyId($recordId);

            $this->CompanyDAO->delete($company);

            $this->ShowListView();
        }

        public function ShowAddCompanyView()
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."company-add.php");
            else
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function ShowListView()//admin
        {
            $companyList = $this->CompanyDAO->GetAllBDD();

            require_once(VIEWS_PATH."company-list.php");
        }

        public function ShowListfilteredView($name)//admin
        {
            if(isset($_SESSION["user"]))
            {
                $companyList = array();
                $company = $this->CompanyDAO->GetByName($name);
                if($company)
                    array_push($companyList, $company);
                    
                require_once(VIEWS_PATH."company-list.php");
            }
            else
                header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function ShowEditView($companyId)
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."company-edit.php");
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

        public function ShowDeleteView()
        {
            if(isset($_SESSION["user"]))
                require_once(VIEWS_PATH."company-list.php");
            else
            header("location:" .FRONT_ROOT . "User/ShowLoginView");
        }

        public function LoginCompany($email, $pass)
        {
            $data = $this->CompanyDAO->GetAllBDD();
            $flag = 0;

            foreach($data as $company)
            {
                if($email == $company->getEmail())
                {
                    $flag = 1;
                    if($company->getPass() == "")
                    {
                        $_SESSION["user"] = $company;
                        header("location:" .FRONT_ROOT . "User/ShowEditView");
                    }
                    else if($company->getPass() == $pass)
                    {
                        $_SESSION["user"] = $company;
                        header("location:" .FRONT_ROOT . "Company/ShowCompanyHome");
                    }
                    else
                    {
                        $_SESSION["msj"] = "Contraseña incorrecta";
                        header("location:" .FRONT_ROOT . "Company/ShowLoginCompany");
                    }
                }
            }

            if($flag == 0)
            {
                $_SESSION["msj"] = "Error de ingreso";
                header("location:" .FRONT_ROOT . "User/ShowLoginAdmin");
            }
        }

        public function ShowCompanyHome()//estudiante
        {
            require_once(VIEWS_PATH."company-home.php");
            //require_once(VIEWS_PATH."company-home.php");
        }

        public function ShowLoginCompany()
        {
            require_once(VIEWS_PATH."loginCompany.php");
        }

        public function Logout()
        {
            session_destroy();
            header("location:" .FRONT_ROOT . "Company/ShowLoginCompany");
        }

    }
?>