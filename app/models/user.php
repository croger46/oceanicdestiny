<?php
/**
 * Class: user
 *
 * Handles all the user related functions and conversions to/from Bungie platform
 * @author Johnathan Tiong <johnathan.tiong@gmail.com>
 * @version  v1.0.20140912
 * @since  v1.0.20140906
 */
class user {
  /**
   * creates a user with the $data provided in local DB
   *
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  function create($data = array(), &$errorMessage) {
    // require password hashing library
    require_once(ROOT.'/lib/passwordHash.php');

    $bungieData = file_get_contents('http://www.bungie.net/Platform/User/SearchUsersPaged/'.$data['gamerid'].'/1/');
    $bungie = json_decode($bungieData, true);

    // provided we get results
    if($bungie['Response']['totalResults'] > 0) {
      // get user from bungie
      $buser = $bungie['Response']['results'][0];

      // create user in ocd
      $user = R::dispense('users');

      // collate data
      $user['bungie'] = $buser['membershipId'];
      $user['gamerid'] = $data['gamerid'];
      $user['platform'] = $data['platform'];
      $user['email'] = $data['email'];
      $user['password'] = lib\PasswordHash::create_hash($data['password']);
      $user['level'] = 100;
      $user['avatar'] = 'https://www.bungie.net' . $buser['profilePicturePath'];
      $uid = R::store($user);

      if($uid != null) {
        return true;
      }
    } else {
      $errorMessage = "We couldn't find you in Bungie's Destiny DB - there may be an update to the DB in progress, please try again later!";
    }

    return false;
  }

  /**
   * returns a platform code number based on the platform string a player is on
   * based on codes in Bungie API. 1 = XBox Live, 2 = Playstation Network
   *
   * @param  string $platform the shortcode of the console the player is on
   * @return int              the short int code of the platform 1 = xbl, 2 = psn
   */
  public function getPlatformCode($platform) {
    switch($platform) {
      case 'ps3':
      case 'ps4':
        return 2;
        break;
      case 'xb360':
      case 'xbone':
        return 1;
        break;

      default:
      break;
    }
  }

  /**
   * returns the unique user id (UUID) of a player in bungie's platform - the membershipID is
   * used to track all the guardian characters that belong to one person
   *
   * @param  [type] $name     [description]
   * @param  [type] $platform [description]
   * @return [type]           [description]
   */
  function getMembershipID($name, $platform) {
    $bungiePage = file_get_contents('http://www.bungie.net/platform/Destiny/SearchDestinyPlayer/'.$this->getPlatformCode($platform).'/'.$name.'/');
    $bungie = json_decode($bungiePage, true);

    return $bungie['Response'][0]['membershipId'];
  }

  /**
   * returns an array of account details (and characters tied to the account)
   *
   * @param int $id the $id number (from getMembershipID) of the account we're looking at
   * @param string $platform the platform shortcode of the account's player
   * @return array $bArray an array of account details
   */
  function getAccountDetails($id, $platform) {
    $bData = file_get_contents('http://www.bungie.net/platform/Destiny/'.$this->getPlatformCode($platform).'/Account/'.$id.'/');
    $bArray = json_decode($bData, true);

    return $bArray;
  }

  /**
   * Validates a user login attempt and sets session data to the oceanicdestiny.com site
   *
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  function validate($data = array()) {
    // require password hashing library
    require_once(ROOT.'/lib/passwordHash.php');

    $userCheck = R::findOne('users', ' gamerid = :gamerid OR email = :email ', [ 'gamerid' => $data['login'], 'email' => $data['login'] ] );

    if($userCheck == null) {
      $data['errorTitle'] = "Error: User not Found";
      $data['errorMsg'] = "We have no record of a user with the details you've provided in our system! Please <a href=\"/login\">try again</a>, or <a href=\"/register\">Sign up</a>";
    } else {
      if($userCheck['banned'] == 1) {
        $data['errorTitle'] = "Error: You're banned!";
        $data['errorMsg'] = "Our records show that you've been banned from Oceanic Destiny, sorry!";
      } else {
        if(lib\PasswordHash::validate_password($data['password'], $userCheck['password'])) {
          $user = R::load('users', $userCheck['id']);
          $_SESSION = array(
            'authenticated' => true,
            'id'            => $user['id'],
            'joined'        => $user['joined'],
            'name'          => $user['name'],
            'gamerid'       => $user['gamerid'],
            'email'         => $user['email'],
            'avatar'        => $user['avatar'],
            'level'         => $user['level']
          );

          return true;
        } else {
          $data['errorTitle'] = "Error: Bad Login!";
          $data['errorMsg'] = "You appear to have entered in a bad login combination! Please <a href=\"/login\">try again</a>.";
        }
      }
    }

    return false;
  }
}