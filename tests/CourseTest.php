<?php

/**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

   require_once "src/Course.php";

   $DB = new PDO('pgsql:host=localhost;dbname=registrar_test');

   class CourseTest extends PHPUnit_Framework_TestCase {

       protected function tearDown() {
           Course::deleteAll();
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


}

?>
