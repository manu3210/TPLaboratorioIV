<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Exception;
    use Models\User as User;
    use DAO\Connection as Connection;

    class UserDAO implements IUserDAO
    {
        //private $userList = array();
        private $connection;
        private $tableName = "usuarios";

        public function Add(User $user)
        {
            try
            {
                $query  = "INSERT INTO " . $this->tableName . "(idApi, email, pass, tipo, descripcion, alreadyAplied) VALUES (:idApi, :email, :pass, :tipo, :descripcion, :alreadyAplied);";
                $parameters["idApi"] = $user->getIdApi();
                $parameters["email"] = $user->getEmail();
                $parameters["pass"] = $user->getPassword();
                $parameters["tipo"] = $user->getTypeOfUser();
                $parameters["descripcion"] = $user->getDescription();
                $parameters["alreadyAplied"] = $user->getAlreadyAplied();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        public function GetAll()
        {
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);
                
                foreach ($result as $row)
                {                
                    $user = new User();
                    $user->setId($row["idUsuario"]);
                    $user->setEmail($row["email"]);
                    $user->setTypeOfUser($row["tipo"]);
                    $user->setDescription($row["descripcion"]);
                    $user->setAlreadyAplied($row["alreadyAplied"]);
                    $user->setIdApi($row["idAPI"]);
                    $user->setPassword($row["pass"]);

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetById ($id) // app id
        {
            try
            {
                $user = new User();

                $query = "SELECT * FROM ".$this->tableName . "WHERE idUsuario=" . $id;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                $user->setId($result["idUsuario"]);
                $user->setEmail($result["email"]);
                $user->setTypeOfUser($result["tipo"]);
                $user->setDescription($result["descripcion"]);
                $user->setAlreadyAplied($result["alreadyAplied"]);
                $user->setIdApi($result["idAPI"]);
                $user->setPassword($result["pass"]);

                return $user;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Fetch ($user)
        {
            $data = $this->GetDataFromApi();
            
            foreach($data as $student)
            {
                if($user->GetIdApi() == $student->getIdApi())
                {
                    $user->setidApi($student->getIdApi());
                    $user->setCareerId($student->getCareerId());
                    $user->setFirstName($student->getfirstName());
                    $user->setLastName($student->getLastName());
                    $user->setDni($student->getDni());
                    $user->setFileNumber($student->getFileNumber());
                    $user->setGender($student->getGender());
                    $user->setBirthDate($student->getBirthDate());
                    $user->setEmail($student->getEmail());
                    $user->setPhoneNumber($student->getPhoneNumber());
                    $user->setIsActive($student->getIsActive());
                }
            }
        }

        public function Update($user)
        {
            try
            {
                $query1  = "UPDATE " . $this->tableName . " SET PASS='" . $user->getPassword() . "' where idUsuario=" . $user->getId();
                $query2  = "UPDATE " . $this->tableName . " SET descripcion='" . $user->getDescription() . "' where idUsuario=" . $user->getId();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query1);
                $this->connection->ExecuteNonQuery($query2);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        public function GetDataFromApi()
        {
            $ch = curl_init();
            $studentList = array();

            curl_setopt($ch, CURLOPT_URL, "https://utn-students-api.herokuapp.com/api/Student");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-api-key:4f3bceed-50ba-4461-a910-518598664c08"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $arrayToDecode = json_decode(curl_exec($ch), true);

            foreach($arrayToDecode as $valuesArray)
            {
                $user = new User();
                
                $this->LoadInfo($user, $valuesArray);
                
                array_push($this->studentList, $user);
            }
            
            curl_close($ch);
            return $studentList;
        }

        private function LoadInfo($user, $valuesArray)
        {
            $user->setIdApi($valuesArray["studentId"]);
            $user->setCareerId($valuesArray["careerId"]);
            $user->setFirstName($valuesArray["firstName"]);
            $user->setLastName($valuesArray["lastName"]);
            $user->setDni($valuesArray["dni"]);
            $user->setFileNumber($valuesArray["fileNumber"]);
            $user->setGender($valuesArray["gender"]);
            $user->setBirthDate($valuesArray["birthDate"]);
            $user->setEmail($valuesArray["email"]);
            $user->setPhoneNumber($valuesArray["phoneNumber"]);
            if($valuesArray["active"] == "false" || $valuesArray["active"] == "0")
                $user->setIsActive(0);
            else
                $user->setIsActive(1);
        }

        // --------------------------------------------- JSON -------------------------------------------- //

         /*
        public function Add(User $user)
        {
            $this->RetrieveData();
            
            array_push($this->userList, $user);

            $this->SaveData();
        }
        */

        /*
        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userList;
        }
        */

        /*
        public function GetById ($id) // app id
        {
            $this->RetrieveData();

            foreach($this->userList as $user)
            {
                if($user->getId() == $id)
                {
                    return $user;
                }
            }
        }
        */

        /*
        public function Update($user)
        {
            $toUpdate = $this->GetById($user->getId());

            $toUpdate->setEmail($user->getEmail());
            $toUpdate->setPassword($user->getPassword());
            $toUpdate->setTypeOfUser($user->getTypeOfUser());
            $toUpdate->setDescription($user->getDescription());
            $toUpdate->setAlreadyAplied($user->getAlreadyAplied());

            $this->SaveData();

            return $user;
        }
        */

        /*
        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray["idApi"] = $user->getIdApi();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["typeOfUser"] = $user->getTypeOfUser();
                $valuesArray["description"] = $user->getDescription();
                $valuesArray["alreadyAplied"] = $user->getAlreadyAplied();
                $valuesArray["id"] = $user->getId();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/users.json', $jsonContent);
        }
        */

        /*
        private function RetrieveData()
        {
            $this->userList = array();
            $arrayToDecode = array();

            if(file_exists('Data/users.json'))
            {
                $jsonContent = file_get_contents('Data/users.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $user = new User();
                    $user->setIdApi($valuesArray["idApi"]);
                    $user->setId($valuesArray["id"]);
                    $user->setEmail($valuesArray["email"]);
                    $user->setPassword($valuesArray["password"]);
                    $user->setTypeOfUser($valuesArray["typeOfUser"]);
                    $user->setDescription($valuesArray["description"]);
                    $user->setAlreadyAplied($valuesArray["alreadyAplied"]);

                    array_push($this->userList, $user);
                }
            }

            $this->SaveData();
        }
        */
    }
?>