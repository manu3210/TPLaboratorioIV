<?php
    namespace DAO;

    use DAO\ICareerDAO as ICareerDAO;
    use Models\Career as Career;

    class CareerDAO implements ICareerDAO
    {
        private $careerList = array();

        public function Add(Career $career)
        {
            $this->RetrieveData();
            
            array_push($this->careerList, $career);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->careerList;
        }

        public function GetById ($id)
        {
            $this->RetrieveData();

            foreach($this->careerList as $carrer)
            {
                if($carrer->getCareerId() == $id)
                {
                    return $carrer;
                }
            }
        }

        public function Update($carrer)
        {
            $toUpdate = $this->GetById($carrer->getCareerId());

            $toUpdate->setCareerId($carrer->getCareerId());
            $toUpdate->setDescription($carrer->getDescription());
            $toUpdate->setActive($carrer->getActive());
            
            $this->SaveData();

            return $carrer;
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
            
            file_put_contents('Data/careers.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->careerList = array();
            $arrayToDecode = array();

            if(file_exists('Data/careers.json'))
            {
                $jsonContent = file_get_contents('Data/careers.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $career = new Career();
                    
                    $this->LoadInfo($career, $valuesArray);

                    array_push($this->careerList, $career);
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

            curl_setopt($ch, CURLOPT_URL, "https://utn-students-api.herokuapp.com/api/Career");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-api-key: 4f3bceed-50ba-4461-a910-518598664c08"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $arrayToDecode = json_decode(curl_exec($ch), true);

            foreach($arrayToDecode as $valuesArray)
            {
                $career = new Career();
                
                $this->LoadInfo($career, $valuesArray);

                array_push($this->careerList, $career);
            }
            
            curl_close($ch);
        }

        private function LoadInfo($career, $valuesArray)
        {
            $career->setId($valuesArray["studentId"]);
            $career->setCareerId($valuesArray["careerId"]);
            
            if($valuesArray["active"] == "false")
                $career->setIsActive(0);
            else
                $career->setIsActive(1);
        }
    }
?>