<?php

if($_POST['postType'] == 'createLFG') {
  // reCaptcha checking
  $resp = recaptcha_check_answer ('6LfgtPkSAAAAAN1geOO_i9zhn03xxlenfLGY7uKM',
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
  // check the response
  if (!$resp->is_valid) {

    // recatpcha NOT passed
    $data['messageStyle'] = 'danger';
    $data['messageTitle'] = 'ERROR: Anti-Spambot Test Failed';
    $data['message'] = 'The incorrect answer was provided to the anti-spambot test.';

  } else {

    if($lfg->create($_POST)) {
      // recatpcha NOT passed
      $data['messageStyle'] = 'success';
      $data['messageTitle'] = 'SUCCESS: Your request was made!';
      $data['message'] = 'Great, '.$_POST['gamerid'].'! Your LFG notice has been created, good luck in your adventures!';
    } else {
      // recatpcha NOT passed
      $data['messageStyle'] = 'danger';
      $data['messageTitle'] = 'ERROR: Something went wrong!';
      $data['message'] = 'We couldn\'t create your LFG notice for you, please try again!';
    }

  }
}

if($_POST['postType'] == 'login') {
  // login logic
  if($user->validate($_POST)) {
    $data['messageStyle'] = 'success';
    $data['messageTitle'] = 'Welcome back, Guardian!';
    $data['message'] = 'You have now been successfully logged into Oceanic Destiny! Enjoy your stay, Guardian!';

    // set user to be actively logged in
    $data['authenticated'] = true;

    $data['user'] = array(
      'id'            => $_SESSION['id'],
      'joined'        => $_SESSION['joined'],
      'name'          => $_SESSION['name'],
      'gamerid'       => $_SESSION['gamerid'],
      'email'         => $_SESSION['email'],
      'avatar'        => $_SESSION['avatar'],
      'level'         => $_SESSION['level']
    );

    if($_SESSION['level'] <= 100) {
      $data['admin'] = true;
    }
  } else {
    $data['messageStyle'] = 'danger';
    $data['messageTitle'] = 'ERROR: Something went wrong!';
    $data['message'] = 'An error has occured with trying to log you in! Please try again!';
  }
}