<?php
    namespace DAO;

    use Models\StudentAPI as StudentAPI;

    interface IStudentAPIDAO
    {
        function Add(StudentAPI $studentAPI);
        function GetAll();
    }
?>