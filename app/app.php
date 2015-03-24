<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Student.php";
    require_once __DIR__."/../src/Course.php";

    $app = new Silex\Application();

    $DB = new PDO('pgsql:host=localhost;dbname=registrar;');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
      ));

      use Symfony\Component\HttpFoundation\Request;
      Request::enableHttpMethodParameterOverride();


      $app->get('/', function() use ($app) {

         return $app['twig']->render('home.html.twig');
      });

      $app->get('/students', function() use ($app) {
         $students = Student::getAll();
         return $app['twig']->render('students.html.twig', array('students' => $students));
      });

      $app->post('/add_student', function() use ($app) {
         $new_student = new Student($_POST['name'], $_POST['enroll_date']);
         $new_student->save();
         $students = Student::getAll();
         return $app['twig']->render('students.html.twig', array('students' => $students));
      });

      $app->post('/add_course', function() use ($app) {
         $new_course = new Course($_POST['name'], $_POST['course_number']);
         $new_course->save();
         $courses = Course::getAll();
         return $app['twig']->render('courses.html.twig', array('courses' => $courses));
      });

      $app->get('/courses', function() use ($app) {
          $courses = Course::getAll();
          return $app['twig']->render('courses.html.twig', array('courses' => $courses));
      });

      $app->post('/delete_students', function() use ($app){
         $students = Student::deleteAll();
         return $app['twig']->render('students.html.twig', array('students' => $students));
      });

      return $app;

?>
