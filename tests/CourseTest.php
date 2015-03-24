<?php

/**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

   require_once "src/Course.php";
   require_once "src/Student.php";

   $DB = new PDO('pgsql:host=localhost;dbname=registrar_test');

   class CourseTest extends PHPUnit_Framework_TestCase {

       protected function tearDown() {
           Course::deleteAll();
           Student::deleteAll();
       }

       function test_setName() {
           //Arrange
           $name = "History of the World Part 1";
           $course_number = "HIST 101";
           $test_course = new Course($name, $course_number);

           //Act
           $test_course->setName("World History");
           $result = $test_course->getName();

           //Assert
           $this->assertEquals("World History", $result);
       }

       function test_getName() {
           //Arrange
           $name = "History of the World Part 1";
           $course_number = "HIST 101";
           $test_course = new Course($name, $course_number);

           //Act
           $result = $test_course->getName();

           //Assert
           $this->assertEquals($name, $result);
       }

       function test_setCourseNumber() {
           //Arrange
           $name = "History of the World Part 1";
           $course_number = "HIST 101";
           $test_course = new Course($name, $course_number);

           //Act
           $test_course->setCourseNumber("RHIST003");
           $result = $test_course->getCourseNumber();

           //Assert
           $this->assertEquals("RHIST003", $result);
       }

       function test_getCourseNumber() {
           //Arrange
           $name = "History of the World Part 1";
           $course_number = "HIST 101";
           $test_course = new Course($name, $course_number);

           //Act
           $result = $test_course->getCourseNumber();

           //Assert
           $this->assertEquals("HIST 101", $result);
       }

       function test_setId() {
           //Arrange
           $name = "History of the World Part 1";
           $course_number = "HIST 101";
           $test_course = new Course($name, $course_number, 1);

           //Act
           $test_course->setId(2);
           $result = $test_course->getId();

           //Assert
           $this->assertEquals(2, $result);
       }

       function test_getId() {
           //Arrange
           $name = "History of the World Part 1";
           $course_number = "HIST 101";
           $test_course = new Course($name, $course_number, 1);

           //Act
           $result = $test_course->getId();

           //Assert
           $this->assertEquals(1, $result);
       }

       function test_save() {
           //Arrange
           $name = "History of the World Part 1";
           $course_number = "HIST101";
           $test_course = new Course($name, $course_number);
           $test_course->save();

           //Act
           $result = Course::getAll();

           //Assert
           $this->assertEquals([$test_course], $result);
       }

       function test_deleteAll() {
           //Arrange
           $name = "History of the World Part 1";
           $course_number = "HIST101";
           $test_course = new Course($name, $course_number);
           $test_course->save();

           //Act
           Course::deleteAll();
           $result = Course::getAll();

           //Assert
           $this->assertEquals([], $result);
       }

       function test_addStudent()
       {
           //Arrange
           $course_name = "History of the World Part 1";
           $course_number = "HIST101";
           $test_course = new Course($course_name, $course_number);
           $test_course->save();

           $name = "Wudge";
           $enroll_date = "2015/01/01";
           $test_student = new Student($name, $enroll_date);
           $test_student->save();

           $name2 = "Sinheim";
           $enroll_date2 = "2014/07/07";
           $test_student2 = new Student($name2, $enroll_date2);
           $test_student2->save();

           //Act
           $test_course->addStudent($test_student);
           $test_course->addStudent($test_student2);
           $result = $test_course->getStudents();


           //Assert
           $this->assertEquals([$test_student, $test_student2], $result);
       }


}

?>
