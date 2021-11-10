<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IJobPositionDAO as IJobPositionDAO;
    use Models\JobPosition as JobPosition;

    class JobPositionDAO implements IJobPositionDAO
    {
        private $jobPositionList = array();
        private $connection;
        private $tableName = "jobPosition";

        public function Add(JobPosition $jobPosition)
        {
            $this->RetrieveData();
            
            array_push($this->jobPositionList, $jobPosition);

            $this->SaveData();
        }
        
        public function AddBDD(JobPosition $jobPosition)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (careerId, description) VALUES (:careerId, :description);";
                
                $parameters["careerId"] = $jobPosition->getCareerId();
                $parameters["description"] = $jobPosition->getDescription();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->jobPositionList;
        }

        public function GetById ($id)
        {
            $this->RetrieveData();

            foreach($this->jobPositionList as $jobPosition)
            {
                if($jobPosition->getJobPositionId() == $id)
                {
                    return $jobPosition;
                }
            }
        }

        public function Update($jobPosition)
        {
            $toUpdate = $this->GetById($jobPosition->getJobPositionId());

            $toUpdate->setJobPositionId($jobPosition->getJobPositionId());
            $toUpdate->setCareerId($jobPosition->getCareerId());
            $toUpdate->setDescription($jobPosition->getDescription());
            
            $this->SaveData();

            return $jobPosition;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->jobPositionList as $jobPosition)
            {
                $valuesArray["jobPositionId"] = $jobPosition->getJobPositionId();
                $valuesArray["careerId"] = $jobPosition->getCareerId();
                $valuesArray["description"] = $jobPosition->getDescription();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/jobPosition.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->jobPositionList = array();
            $arrayToDecode = array();

            if(file_exists('Data/jobPosition.json'))
            {
                $jsonContent = file_get_contents('Data/jobPosition.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $jobPosition = new JobPosition();
                    
                    $this->LoadInfo($jobPosition, $valuesArray);

                    array_push($this->jobPositionist, $jobPosition);
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

            curl_setopt($ch, CURLOPT_URL, "https://utn-students-api.herokuapp.com/api/JobPosition");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-api-key: 4f3bceed-50ba-4461-a910-518598664c08"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $arrayToDecode = json_decode(curl_exec($ch), true);

            foreach($arrayToDecode as $valuesArray)
            {
                $jobPosition = new JobPosition();
                
                $this->LoadInfo($jobPosition, $valuesArray);

                array_push($this->jobPositionist, $jobPosition);
            }
            
            curl_close($ch);
        }

        private function LoadInfo($jobPosition, $valuesArray)
        {
            $jobPosition->setJobPositionId($valuesArray["jobPositionId"]);
            $jobPosition->setCareerId($valuesArray["careerId"]);
            $jobPosition->setDescription($valuesArray["description"]);
            
        }
    }
?>