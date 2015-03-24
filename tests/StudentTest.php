<?php

/**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

   require_once "src/Student.php";
   require_once "src/Course.php";

   $DB = new PDO('pgsql:host=localhost;dbname=registrar_test');

   class StudentTest extends PHPUnit_Framework_TestCase {

       protected function tearDown() {
           Course::deleteAll();
           Student::deleteAll();
       }

       function test_setName() {
           //Arrange
           $name = "Beldar";
           $enroll_date = "2015/01/01";
           $test_name = new Student($name, $enroll_date);

           //Act
           $test_name->setName("Prymatt");
           $result = $test_name->getName();

           //Assert
           $this->assertEquals("Prymatt", $result);
       }

       function test_getName() {
           //Arrange
           $name = "Sinheim";
           $enroll_date = "2015/01/01";
           $test_name = new Student($name, $enroll_date);

           //Act
           $result = $test_name->getName();

           //Assert
           $this->assertEquals($name, $result);
       }

       function test_setEnrollDate() {
           //Arrange
           $name = "Wudge";
           $enroll_date = "2015/01/01";
           $test_student = new Student($name, $enroll_date);

           //Act
           $test_student->setEnrollDate("3456/02/02");
           $result = $test_student->getEnrollDate();

           //Assert
           $this->assertEquals("3456/02/02", $result);
       }

       function test_getEnrollDate() {
           //Arrange
           $name = "Wudge";
           $enroll_date = "2015/01/01";
           $test_student = new Student($name, $enroll_date);

           //Act
           $result = $test_student->getEnrollDate();

           //Assert
           $this->assertEquals("2015/01/01", $result);
       }

       function test_setId() {
           //Arrange
           $name = "Wudge";
           $enroll_date = "2015/01/01";
           $test_student = new Student($name, $enroll_date, 1);

           //Act
           $test_student->setId(2);
           $result = $test_student->getId();

           //Assert
           $this->assertEquals(2, $result);
       }

       function test_getId() {
           //Arrange
           $name = "Wudge";
           $enroll_date = "2015/01/01";
           $test_student = new Student($name, $enroll_date, 1);

           //Act
           $result = $test_student->getId();

           //Assert
           $this->assertEquals(1, $result);
       }

       function test_save() {
           //Arrange
           $name = "Wudge";
           $enroll_date = "2015/01/01";
           $test_student = new Student($name, $enroll_date);

           //Act
           $test_student->save();
           $result = Student::getAll();

           //Assert
           $this->assertEquals([$test_student], $result);
       }

       function test_deleteAll() {
           //Arrange
           $name = "Wudge";
           $enroll_date = "2015/01/01";
           $test_student = new Student($name, $enroll_date);
           $test_student->save();
           $name2 = "Dwight";
           $enroll_date2 = "2016/07/02";
           $test_student2 = new Student($name2, $enroll_date2);
           $test_student2->save();

           //Act
           Student::deleteAll();
           $result = Student::getAll();

           //Assert
           $this->assertEquals([], $result);
       }

       function test_addCourse() {
           //Arrange
           $name = "Wudge";
           $enroll_date = "2015/01/01";
           $test_student = new Student($name, $enroll_date);
           $test_student->save();

           $course_name = "History 101";
           $course_number = "HIST101";
           $new_course = new Course($course_name, $course_number);
           $new_course->save();

           //Act
           $test_student->addCourse($new_course);
           $result = $test_student->getCourses();

           //Assert
           $this->assertEquals([$new_course], $result);
       }
   }

?>
