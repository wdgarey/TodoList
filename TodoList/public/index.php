<?php
error_reporting (E_ALL);

require_once ('../private/controller.php');
require_once ('../private/classes/utils.php');

Utils::AdjustQuotes ();
Utils::TrackSession ();

$action = 'ViewTasks';

if (isset($_GET['Action']))
{
  $action = $_GET['Action'];
}
else if (isset($_POST['Action']))
{
  $action = $_POST['Action'];
}

$loggedIn = Controller::IsUserLoggedIn ();

if (!$loggedIn && $action != 'Login' && $action != 'ProcessLogin')
{
  Controller::RequestTo ('Login');
}
else if ($loggedIn && ($action == 'Login' || $action == 'ProcessLogin'))
{
  Controller::RequestTo ('ViewTasks');
}

switch ($action)
{
case 'Login':
  Controller::Login ();
  break;
case 'ProcessLogin':
  Controller::ProcessLogin ();
  break;
case 'Logout':
  Controller::Logout ();
  break;
case 'AddTask':
  Controller::AddTask ();
  break;
case 'ProcessAddEditTask':
  Controller::ProcessAddEditTask ();
  break; 
case 'ViewTask':
  Controller::ViewTask ();
  break;
case 'EditTask':
  Controller::EditTask ();
  break;
case 'DeleteTask':
  Controller::DeleteTask ();
  break;
case 'ViewTasks':
default:
  Controller::ViewTasks ();
  break;
}

exit();
?>
