<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;
    use DAO\Connection as Connection;

    class CompanyDAO implements ICompanyDAO
    {
        private $companyList = array();
        private $connection;
        private $tableName = "companias";

        function removeElementWithValue($array, $key, $value){
            foreach($array as $subKey => $subArray){
                 if($subArray[$key] == $value){
                      unset($array[$subKey]);
                 }
            }
            return $array;
       }

       //! implementar
       public function deleteFromBDD($company)
        {
            try
            {
                $query1  = "DELETE FROM " . $this->tableName . " where companyId=" . $company->getCompanyId();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query1);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        //!comentar json
        public function delete(Company $company2)
        {
            $i=0;
            $this->RetrieveData();
            foreach($this->companyList as $company)
            {
                if($company->getCompanyId() == $company2->getCompanyId())
                {
                    echo var_dump($company2->getCompanyId());
                    unset($this->companyList[$i]);
                }
                $i++;
            }
            $this->SaveData();
        }

        public function editBDD(Company $company)
        {
            try
            {
                $query1  = "UPDATE " . $this->tableName . " SET name='" . $company->getName() . "' where companyId = " . $company->getCompanyId();
                $query2  = "UPDATE " . $this->tableName . " SET email ='" . $company->getEmail() . "' where companyId =" . $company->getCompanyId();
                $query3  = "UPDATE " . $this->tableName . " SET phoneNumber ='" . $company->getPhoneNumber() . "' where companyId =" . $company->getCompanyId();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query1);
                $this->connection->ExecuteNonQuery($query2);
                $this->connection->ExecuteNonQuery($query3);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        public function editJSON(Company $company2)
        {
            $this->RetrieveData();
            
            foreach($this->companyList as $company)
            {
                if($company->getCompanyId() == $company2->getCompanyId())
                {
                    echo var_dump($company2->getCompanyId());
                    $company->setName($company2->getName());
                    $company->setEmail($company2->getEmail());
                    $company->setPhoneNumber($company2->getPhoneNumber());
                    $company->setIsActive($company2->getIsActive());
                }
            }
            
            $this->SaveData();
        }
        
        public function Add(Company $company)
        {
            $this->RetrieveData();

            try
            {
                $query = "INSERT INTO ".$this->tableName." (name, email, isActive, phoneNumber) VALUES (:name, :email, :isActive, :phoneNumber);";
                
                $parameters["name"] = $company->getName();
                $parameters["email"] = $company->getEmail();
                $parameters["isActive"] = $company->getIsActive();
                $parameters["phoneNumber"] = $company->getPhoneNumber();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

            array_push($this->companyList, $company);

            array_multisort($this->companyList);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->companyList;
        }

        //funciona
        public function GetByIdBDD($id)
        {

            try
            {
                $query = "SELECT * FROM ". $this->tableName ." WHERE companyId = " .$id." ; ";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
                    $company = new Company();
                    $company->setCompanyId($row["companyId"]);
                    $company->setName($row["name"]);
                    $company->setEmail($row["email"]);
                    $company->setIsActive($row["isActive"]);
                    $company->setPhoneNumber($row["phoneNumber"]);

                    return $company;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

            
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

        //!comentar
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
                $valuesArray["isActive"] = $company->getIsActive();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/companys.json', $jsonContent);
        }

        public function GetAllBDD()
        {
            try
            {
                $companyList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $company = new Company();
                    $company->setCompanyId($row["companyId"]);
                    $company->setName($row["name"]);
                    $company->setIsActive($row["isActive"]);
                    $company->setPhoneNumber($row["phoneNumber"]);
                    $company->setEmail($row["email"]);


                    array_push($companyList, $company);
                }

                return $companyList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
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
            $company->setIsActive($valuesArray["isActive"]);
            
        }
    }
?>