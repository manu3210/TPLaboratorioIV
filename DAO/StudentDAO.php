<?php
    namespace DAO;

    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;

    class StudentDAO implements IStudentDAO
    {
        private $studentList = array();

        public function Add(Student $student)
        {
            $this->RetrieveData();
            
            array_push($this->studentList, $student);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->studentList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->studentList as $student)
            {
                $valuesArray["studentId"] = $student->getStudentId();
                $valuesArray["careerId"] = $student->getCareerId();
                $valuesArray["firstName"] = $student->getFirstName();
                $valuesArray["lastName"] = $student->getLastName();
                $valuesArray["dni"] = $student->getDni();
                $valuesArray["fileNumber"] = $student->getFileNumber();
                $valuesArray["gender"] = $student->getGender();
                $valuesArray["birthDate"] = $student->getBirthDate();
                $valuesArray["email"] = $student->getEmail();
                $valuesArray["phoneNumber"] = $student->getPhoneNumber();
                $valuesArray["isActive"] = $student->getIsActive();
                $valuesArray["password"] = $student->getPassword();
                $valuesArray["userType"] = $student->getUserType();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/students.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->studentList = array();
            $arrayToDecode = array();

            if(file_exists('Data/students.json'))
            {
                $jsonContent = file_get_contents('Data/students.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $student = new Student();
                    
                    $this->LoadInfo($student, $valuesArray);
                    $student->setIsActive($valuesArray["isActive"]);
                    $student->setPassword($valuesArray["password"]);
                    $student->setUserType($valuesArray["userType"]);

                    array_push($this->studentList, $student);
                }
            }
            else
            {
                $this->GetDataFromApi();
            }

            $this->SaveData();
        }

        private function GetDataFromApi()
        {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://utn-students-api.herokuapp.com/api/Student");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-api-key: 4f3bceed-50ba-4461-a910-518598664c08"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $arrayToDecode = json_decode(curl_exec($ch), true);

            foreach($arrayToDecode as $valuesArray)
            {
                $student = new Student();
                
                $this->LoadInfo($student, $valuesArray);
                $student->setIsActive(1);
                $student->setPassword("");
                $student->setUserType(1);

                array_push($this->studentList, $student);
            }
            
            curl_close($ch);
        }

        private function LoadInfo($student, $valuesArray)
        {
            $student->setStudentId($valuesArray["studentId"]);
            $student->setCareerId($valuesArray["careerId"]);
            $student->setFirstName($valuesArray["firstName"]);
            $student->setLastName($valuesArray["lastName"]);
            $student->setDni($valuesArray["dni"]);
            $student->setFileNumber($valuesArray["fileNumber"]);
            $student->setGender($valuesArray["gender"]);
            $student->setBirthDate($valuesArray["birthDate"]);
            $student->setEmail($valuesArray["email"]);
            $student->setPhoneNumber($valuesArray["phoneNumber"]);
        }
    }
?>