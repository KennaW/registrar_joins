<?php

    class Student
    {
        private $name;
        private $enroll_date;
        private $id;

        function __construct($name, $enroll_date, $id = null)
        {
            $this->name = $name;
            $this->enroll_date = $enroll_date;
            $this->id = $id;
        }

        // getters

        function getName()
        {
            return $this->name;
        }

        function getEnrollDate()
        {
            return $this->enroll_date;
        }

        function getId()
        {
            return $this->id;
        }

        // setters

        function setName($name)
        {
            $this->name = $name;
        }

        function setEnrollDate($enroll_date)
        {
            $this->enroll_date = $enroll_date;
        }

        function setId($id)
        {
            $this->id = $id;
        }

        // DB functions


        // static functions
    }

?>
