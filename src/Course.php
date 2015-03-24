<?php

    class Course
    {
        private $name;
        private $course_number;
        private $id;

        function __construct($name, $course_number, $id = null)
        {
            $this->name = $name;
            $this->course_number = $course_number;
            $this->id = $id;
        }

        // getters

        function getName()
        {
            return $this->name;
        }

        function getCourseNumber()
        {
            return $this->course_number;
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

        function setCourseNumber($course_number)
        {
            $this->course_number = $course_number;
        }

        function setId($id)
        {
            $this->id = $id;
        }

        // DB functions

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO courses (course_name, course_number) VALUES ('{$this->getName()}', '{$this->getCourseNumber()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }


        // static functions

        static function getAll()
        {
            $returned_results = $GLOBALS['DB']->query("SELECT * FROM courses;");
            $courses = [];

            foreach($returned_results as $result) {
                $name = $result['course_name'];
                $course_number = $result['course_number'];
                $id = $result['id'];
                $new_course = new Course($name, $course_number, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses *;");
        }
    }


?>
