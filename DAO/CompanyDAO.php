<?php
    namespace DAO;

    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;

    class CompanyDAO implements ICompanyDAO
    {
        private $companyList = array();

        public function Add(Company $company)
        {
            $this->RetrieveData();
            
            array_push($this->companyList, $company);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->companyList;
        }

        public function GetById ($id)
        {
            $this->RetrieveData();

            foreach($this->companyList as $company)
            {
                if($company->getCompanyId() == $id)
                {
                    return $company;
                }
            }
        }

        public function Update($company)
        {
            $toUpdate = $this->GetById($company->getCompanyId());

            $toUpdate->setCompanyId($company->getCompanyId());
            $toUpdate->setName($company->getName());
            $toUpdate->setEmail($company->getEmail());
            $toUpdate->setPhoneNumber($company->getPhoneNumber());
            $toUpdate->setIsActive($company->getIsActive());
            
            $this->SaveData();

            return $company;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->companyList as $company)
            {
                $valuesArray["companyId"] = $company->getCompanyId();
                $valuesArray["name"] = $company->getName();
                $valuesArray["email"] = $company->getEmail();
                $valuesArray["phoneNumber"] = $company->getPhoneNumber();
                $valuesArray["active"] = $company->getIsActive();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/companys.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->companyList = array();
            $arrayToDecode = array();

            if(file_exists('Data/companys.json'))
            {
                $jsonContent = file_get_contents('Data/companys.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $company = new Company();
                    
                    $this->LoadInfo($company, $valuesArray);

                    array_push($this->companyList, $company);
                }
            }
            $this->SaveData();
        }

        private function LoadInfo($company, $valuesArray)
        {
            $company->setCompanyId($valuesArray["companyId"]);
            $company->setName($valuesArray["name"]);
            $company->setEmail($valuesArray["email"]);
            $company->setPhoneNumber($valuesArray["phoneNumber"]);
            $company->setIsActive($valuesArray["active"]);
            
        }
    }
?>