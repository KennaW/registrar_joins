<?php

/**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

   require_once "src/Student.php";

   $DB = new PDO('pgsql:host=localhost;dbname=registrar_test');

   class StudentTest extends PHPUnit_Framework_TestCase {

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
   }

?>
