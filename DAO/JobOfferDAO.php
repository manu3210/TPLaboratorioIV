<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IJobOfferDAO as IJobOfferyDAO;
    use Models\JobOffer as JobOffer;
    use DAO\Connection as Connection;

    class JobOfferDAO implements IJobOfferDAO
    {
        private $jobOfferList = array();
        private $connection;
        private $tableName = "ofertasLaborales";

        //!hace falta??
        function removeElementWithValue($array, $key, $value){
            foreach($array as $subKey => $subArray){
                 if($subArray[$key] == $value){
                      unset($array[$subKey]);
                 }
            }
            return $array;
       }

       //!no se usaria creo...
       public function deleteFromBDD($jobOffer)
        {
            try
            {
                $query1  = "DELETE FROM " . $this->tableName . " where idJobOffer=" . $jobOffer->getIdJobOffer();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query1);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        //!tampoco se usaria creo... pero puede ser para "estirar" un poco la fecha de cacucidad
        public function editBDD(JobOffer $jobOffer)
        {
            try
            {
                $query  = "UPDATE " . $this->tableName . " SET fechaCaducidad='" . $jobOffer->getFechaCaducidad() . "' where idJobOffer = " . $jobOffer->getIdJobOffer();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }
        
        public function Add(JobOffer $jobOffer)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (companyId, jobPosition, fechaCaducidad) VALUES (:companyId, :jobPosition, :fechaCaducidad);";
                
                $parameters["companyId"] = $jobOffer->getCompanyId();
                $parameters["jobPosition"] = $jobOffer->getJobPosition();
                $parameters["fechaCaducidad"] = $jobOffer->getFechaCaducidad();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //funciona
        public function GetByIdBDD($id)
        {
            try
            {
                $query = "SELECT * FROM ". $this->tableName ." WHERE idJobOffer = " .$id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
                    $jobOffer = new JobOffer();
                    $jobOffer->setIdJobOffer($row["idJobOffer"]);
                    $jobOffer->setCompanyId($row["companyId"]);
                    $jobOffer->setJobPosition($row["jobPosition"]);
                    $jobOffer->setFechaCaducidad($row["fechaCaducidad"]);

                    return $jobOffer;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

            
        }

        public function GetAllBDD()
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobOffer = new JobOffer();
                    $jobOffer->setIdJobOffer($row["idJobOffer"]);
                    $jobOffer->setCompanyId($row["companyId"]);
                    $jobOffer->setJobPosition($row["jobPosition"]);
                    $jobOffer->setFechaCaducidad($row["fechaCaducidad"]);
                    
                    array_push($jobOfferList, $jobOffer);
                }

                return $jobOfferList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

    }
?>