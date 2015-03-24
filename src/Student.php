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

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO students (name, enroll_date) VALUES ('{$this->getName()}', '{$this->getEnrollDate()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        function addCourse($course)
        {
            $GLOBALS['DB']->exec("INSERT INTO students_courses (student_id, course_id) VALUES ({$this->getId()}, {$course->getId()});");
        }

        function getCourses()
        {
            $returned_results = $GLOBALS['DB']->query("SELECT courses.* FROM students JOIN students_courses ON (students.id = students_courses.student_id) JOIN courses ON (students_courses.course_id = courses.id) WHERE students.id = {$this->getId()};");
            $courses = [];
            foreach($returned_results as $result) {
                $course_name = $result['course_name'];
                $course_number = $result['course_number'];
                $id = $result['id'];
                $new_course = new Course($course_name, $course_number, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }


        // static functions

        static function getAll()
        {
            $returned_results = $GLOBALS['DB']->query("SELECT * FROM students;");
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students *;");
        }
    }

?>
