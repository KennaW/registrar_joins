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

        function addStudent($student)
        {
            $GLOBALS['DB']->exec("INSERT INTO students_courses (student_id, course_id) VALUES ({$student->getId()}, {$this->getId()});");
        }

        function getStudents()
        {
            $returned_results = $GLOBALS['DB']->query("SELECT students.* FROM courses JOIN students_courses ON (courses.id = students_courses.course_id) JOIN students ON (students_courses.student_id = students.id) WHERE courses.id = {$this->getId()};");
            $students = [];
            foreach($returned_results as $result) {
                $name = $result['name'];
                $enroll_date = $result['enroll_date'];
                $id = $result['id'];
                $new_student = new Student($name, $enroll_date, $id);
                array_push($students, $new_student);
            }
            return $students;
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

        static function find($id)
        {
            $statement = $GLOBALS['DB']->query("SELECT * FROM courses WHERE id = {$id};");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $found_course = new Course($result['name'], $result['course_number'], $result['id']);
            return $found_course;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses *;");
        }
    }


?>
