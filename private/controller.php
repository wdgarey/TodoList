<?php
require_once ('../private/model.php');
require_once ('../private/classes/task.php');
require_once ('../private/classes/utils.php');

class Controller
{
  public static function RequestTo ($action)
  {
    $script = Utils::GetScript ($action);

    Utils::Redirect ($script);
  }

  public static function IsUserLoggedIn ()
  {
    $loggedIn = isset ($_SESSION['username']);

    return $loggedIn;
  }

  public static function GetUsername ()
  {
    $username = '';
    
    if (Controller::IsUserLoggedIn ())
    {
      $username = $_SESSION['username'];
    }

    return $username;
  }

  public static function SetUsername ($username)
  {
    $_SESSION['username'] = $username;
  }

  public static function Login ()
  {
    $username = '';
    $password = '';

    include ('../private/view/login-form.php');
  }

  public static function ProcessLogin ()
  {
    $username = '';
    $password = '';

    if (isset ($_POST['username']))
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
    }
    else if (isset ($_GET['username']))
    {
      $username = $_GET['username'];
      $password = $_GET['password'];
    }

    $username = Model::Authenticate ($username, $password);

    if ($username != false)
    {
      Controller::SetUserName ($username);

      Controller::RequestTo ('ViewTasks');

      die ();
    }

    $message = 'Invalid login';
    $password = '';

    include ('../private/view/login-form.php');
  }

  public static function ViewTasks()
  {
    $selectedId = 0;

    if (isset($_POST['ProjectId']))
    {
      $selectedId = $_POST['ProjectId'];
    }
    else if (isset($_GET['ProjectId']))
    {
      $selectedId = $_GET['ProjectId'];
    }

    $projects = GetProjects ();

    include ('./private/view-project.php');
  }

  public static function Logout ()
  {
    Utils::DestroySession ();

    Controller::RequestTo ('Login');
  }
}
?>
