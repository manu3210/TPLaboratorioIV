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
                $valuesArray["studentId"] = $student->getRecordId();
                $valuesArray["firstName"] = $student->getFirstName();
                $valuesArray["lastName"] = $student->getLastName();

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
            }
            else
            {
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://utn-students-api.herokuapp.com/api/Student");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-api-key: 4f3bceed-50ba-4461-a910-518598664c08"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                
                $arrayToDecode = json_decode(curl_exec($ch), true);
                
                curl_close($ch);
            }

            foreach($arrayToDecode as $valuesArray)
            {
                $student = new Student();
                $student->setRecordId($valuesArray["studentId"]);
                $student->setFirstName($valuesArray["firstName"]);
                $student->setLastName($valuesArray["lastName"]);

                array_push($this->studentList, $student);
            }

            $this->SaveData();
            
        }
    }
?>