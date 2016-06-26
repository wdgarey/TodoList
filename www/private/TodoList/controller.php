<?php
require_once ('../../private/TodoList/model.php');
require_once ('../../private/TodoList/classes/task.php');
require_once ('../../private/TodoList/classes/utils.php');

class Controller
{
  public static function ViewTasks ()
  {
    $option = -1;

    if (isset ($_POST['option']))
    {
      $option = $_POST['option'];
    }
    else if (isset ($_GET['option']))
    {
      $option = $_GET['option'];
    }

    $tasks = Model::GetTasks ($option);

    include ('../../private/TodoList/view/view-tasks-form.php');
  }
  public static function DeleteTask ()
  {
    if (isset ($_POST['id']))
    {
      $id = $_POST['id'];
    }
    else if (isset ($_GET['id']))
    {
      $id = $_GET['id'];
    }

    Model::DeleteTask ($id);

    Controller::RequestTo ('ViewTasks');
  }
  public static function EditTask ()
  {
    if (isset ($_POST['id']))
    {
      $id = $_POST['id'];
    }
    else if (isset ($_GET['id']))
    {
      $id = $_GET['id'];
    }

    $task = Model::GetTask ($id);

    include ('../../private/TodoList/view/add-edit-task-form.php');
  }

  public static function ViewTask ()
  {
    if (isset ($_POST['id']))
    {
      $id = $_POST['id'];
    }
    else if (isset ($_GET['id']))
    {
      $id = $_GET['id'];
    }

    $task = Model::GetTask ($id);

    include ('../../private/TodoList/view/view-task-form.php');
  }

  public static function ProcessAddEditTask ()
  {
    $task = new Task ();

    if (isset ($_POST['title']))
    {
      $task->Initialize ($_POST);
    }
    else if (isset ($_GET['title']))
    {
      $task->Initialize ($_GET);
    }

    if ($task->IsIdSet ())
    {
      $id = $task->GetId ();
      Model::UpdateTask ($task);
    }
    else
    {
      if (isset ($_POST['interim']))
      {
        $interim = $_POST['interim'];
      }
      else if (isset ($_GET['interim']))
      {
        $interim = $_GET['interim'];
      }

      if (isset ($interim))
      {
        $task->SetDeadline (date ('Y-m-d', (time() + ($interim * 24 * 60 * 60))));
      }

      $id = Model::AddTask ($task);
    }

    Controller::RequestTo ('ViewTask&id=' . $id);
  }

  public static function AddTask ()
  {
    $task = new Task ();

    include ('../../private/TodoList/view/add-edit-task-form.php');
  }

  public static function Login ()
  {
    $username = '';
    $password = '';

    include ('../../private/TodoList/view/login-form.php');
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

    include ('../../private/TodoList/view/login-form.php');
  }

  public static function Logout ()
  {
    Utils::DestroySession ();

    Controller::RequestTo ('Login');
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

  public static function RequestTo ($action)
  {
    $script = Utils::GetScript ($action);

    Utils::Redirect ($script);
  }
}
?>
