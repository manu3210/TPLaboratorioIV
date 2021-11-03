<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IOfferXUserDAO as IOfferXUserDAO;
    use Models\OfferXUser as OfferXUser;
    use DAO\Connection as Connection;
    use Models\Career as Career;
    use Models\JobPosition as JobPosition;

    class OfferXUserDAO implements IOfferXUserDAO
    {
        private $offerXUserList = array();
        private $connection;
        private $tableName = "postulacionesXUsuarios";

        public function deleteFromBDD($offerXUser)
        {
            try
            {
                $query1  = "DELETE FROM " . $this->tableName . " where idPostulacionesXUsuarios=" . $offerXUser->getIdPostulacionesXUsuarios();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query1);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        public function Add(OfferXUser $offerXUser)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idJobOffer, idUsuario) VALUES (:idJobOffer, :idUsuario);";
                
                $parameters["idJobOffer"] = $offerXUser->getIdJobOffer();
                $parameters["idUsuario"] = $offerXUser->getIdUsuario();
               

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
                $query = "SELECT * FROM ". $this->tableName ." WHERE idPostulacionesXUsuarios = " .$id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
                    $offerXUser = new OfferXUser();
                    $offerXUser->setIdPostulacionesXUsuarios($row["idPostulacionesXUsuarios"]);
                    $offerXUser->setIdJobOffer($row["idJobOffer"]);
                    $offerXUser->setIdUsuario($row["idUsuario"]);
                   

                    return $offerXUser;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

            
        }

        public function GetAll()
        {
            try
            {
                $offerXUserList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $offerXUser = new OfferXUser();
                    $offerXUser->setIdPostulacionesXUsuarios($row["idPostulacionesXUsuarios"]);
                    $offerXUser->setIdJobOffer($row["idJobOffer"]);
                    $offerXUser->setIdUsuario($row["idUsuario"]);
                    
                    array_push($offerXUserList, $offerXUser);
                }

                return $offerXUserList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

    }
?>