<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IStudentAPIDAO as IStudentAPIDAO;
    use Models\StudentAPI as StudentAPI;

    class StudentAPIDAO implements IStudentAPIDAO
    {
        private $studentAPIList = array();
        private $connection;
        private $tableName = "student";

        public function Add(StudentAPI $studentAPI)
        {
            $this->RetrieveData();
            
            array_push($this->studentAPIList, $studentAPI);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->studentAPIList;
        }

        public function GetById ($id)
        {
            $this->RetrieveData();

            foreach($this->studentAPIList as $studentAPI)
            {
                if($studentAPI->getStudentId() == $id)
                {
                    return $studentAPI;
                }
            }
        }

        public function AddBDD(StudentAPI $studentAPI)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (careerId, firstName, lastName, dni, fileNumber, gender, birthDate, email, phoneNumber, active) 
                                        VALUES (:careerId, :firstName, :lastName, :dni, :fileNumber, :gender, :birthDate, :email, :phoneNumber, :active);";
                
                $parameters["careerId"] = $studentAPI->getCareerId();
                $parameters["firstName"] = $studentAPI->getFirstName();
                $parameters["lastName"] = $studentAPI->getLastName();
                $parameters["dni"] = $studentAPI->getDni();
                $parameters["fileNumber"] = $studentAPI->getFileNumber();
                $parameters["gender"] = $studentAPI->getGender();
                $parameters["birthDate"] = $studentAPI->getBirthDate();
                $parameters["email"] = $studentAPI->getEmail();
                $parameters["phoneNumber"] = $studentAPI->getPhoneNumber();
                $parameters["active"] = $studentAPI->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray["careerId"] = $user->getCareerId();
                $valuesArray["description"] = $user->getDescription();
                $valuesArray["active"] = $user->getActive();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/students.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->careerList = array();
            $arrayToDecode = array();

            if(file_exists('Data/students.json'))
            {
                $jsonContent = file_get_contents('Data/students.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $studentAPI = new StudentAPI();
                    
                    $this->LoadInfo($studentAPI, $valuesArray);

                    array_push($this->studentAPIList, $studentAPI);
                }
            }
            else
            {
                $this->GetDataFromApi();
            }

            $this->SaveData();
        }

        public function GetDataFromApi()
        {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://utn-students-api.herokuapp.com/api/Student");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-api-key: 4f3bceed-50ba-4461-a910-518598664c08"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $arrayToDecode = json_decode(curl_exec($ch), true);

            foreach($arrayToDecode as $valuesArray)
            {
                $studentAPI = new StudentAPI();
                
                $this->LoadInfo($studentAPI, $valuesArray);

                //ya se cargaron los datos
                //$this->AddBDD($studentAPI);
            }
            
            curl_close($ch);
        }

        private function LoadInfo($studentAPI, $valuesArray)
        {
            $studentAPI->setCareerId($valuesArray["careerId"]);
            $studentAPI->setCareerId($valuesArray["careerId"]);
            $studentAPI->setFirstName($valuesArray["firstName"]);
            $studentAPI->setLastName($valuesArray["lastName"]);
            $studentAPI->setDni($valuesArray["dni"]);
            $studentAPI->setFileNumber($valuesArray["fileNumber"]);
            $studentAPI->setGender($valuesArray["gender"]);
            $studentAPI->setBirthDate($valuesArray["birthDate"]);
            $studentAPI->setEmail($valuesArray["email"]);
            $studentAPI->setPhoneNumber($valuesArray["phoneNumber"]);
            $studentAPI->setActive($valuesArray["active"]);
            
            if($valuesArray["active"] == "false")
                $studentAPI->setActive(0);
            else
                $studentAPI->setActive(1);
        }
    }
?>