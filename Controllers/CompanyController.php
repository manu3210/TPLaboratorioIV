<?php  
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class CompanyController
    {
        private $CompanyDAO;

        public function __construct()
        {
            $this->CompanyDAO = new CompanyDAO();
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

        public function editBDD($recordId,$name,$email,$phoneNumber)
        {
            $company = new Company();
            
            $company->setCompanyId($recordId);
            $company->setName($name);
            $company->setEmail($email);
            $company->setPhoneNumber($phoneNumber);
            $company->setIsActive(1);

            $this->CompanyDAO->editBDD($company);

            $this->ShowListView();
        }

        public function deleteFromBDD($recordId)
        {
            $company = new Company();
            
            $company->setCompanyId($recordId);

            $this->CompanyDAO->deleteFromBDD($company);

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

        
    }
?>