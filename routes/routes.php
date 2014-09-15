<?php

/**
 * GET REQUESTS
 */

// ABOUT PAGE
$base->get("/about",function() use ($m) {
  include(ROOT.'/app/common.php');
  include(ROOT.'/app/controllers/get/about.php');
});

$base->get("/changelog", function() use ($m) {
  echo $m->render("public/changelog", []);
});

// GUARDIAN INDEX PAGE
$base->get("/guardians",function() use ($m) {
  include(ROOT.'/app/common.php');
  include(ROOT.'/app/controllers/get/guardians.php');
});


// LOGIN PAGE
$base->get("/login",function() use ($m) {
  include(ROOT.'/app/common.php');
  include(ROOT.'/app/controllers/get/login.php');
});

// LOGOUT PAGE
$base->get("/logout",function() use ($m) {
  $_SESSION = [];
  if(isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
  }
  session_destroy();

  header('Location: http://oceanicdestiny.com/');
});

// REGISTER PAGE
$base->get("/register", function() use ($m) {
  include(ROOT.'/app/common.php');
  include(ROOT.'/app/controllers/get/register.php');
});

/////

// HOME PAGE
$base->get("/", function() use ($m) {
  include(ROOT.'/app/common.php');
  include(ROOT.'/app/controllers/get/index.php');
});

/**
 * POST REQUESTS
 */

// REGISTER PAGE
$base->post("/register", function() use ($m) {
  include(ROOT.'/app/common.php');
  include(ROOT.'/app/controllers/post/register.php');
  include(ROOT.'/app/controllers/get/index.php');
});

// HOME PAGE - unsigned LFG submitted
$base->post("/", function() use ($m) {
  include(ROOT.'/app/common.php');
  include(ROOT.'/app/controllers/post/index.php');
  include(ROOT.'/app/controllers/get/index.php');
});

// 404 page
$base->notFound(function() use ($m){ echo $m->render("404",[]); });

?>