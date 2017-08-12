<?php
require_once ('../private/classes/task.php');

class Model
{
  public static function SearchTasks ($text)
  {
    $tasks = false;

    try
    {
      $db = Model::GetDbConnection ();

      $query = "SELECT * ";
      $query .= "FROM todolist.task ";
      $query .= "WHERE title LIKE :text ";
      $query .= "OR description LIKE :text;";

      $statement = $db->prepare ($query);

      $statement->bindValue (':text', '&' . $text . '&', PDO::PARAM_STR);

      $statement->execute ();

      $results = $statement->fetchAll ();

      $statement->closeCursor ();

      $tasks = array ();

      foreach ($results as $result)
      {
        $task = new Task ();

        $task->Initialize ($result);

        $tasks[] = $task;
      }

    }
    catch (PDOException $e)
    {
      Model::LogError ($e->errorMessage ());

      die ();
    }

    return $tasks;
  }

  public static function GetTasks ($option = 0)
  {
    $tasks = false;

    try
    {
      $db = Model::GetDbConnection ();

      $query = "SELECT * ";
      $query .= "FROM todolist.task ";

      if ($option != 0)
      {
        $query .= "WHERE completed IS ";

        if ($option == 1)
        {
          $query .= "NOT ";
        }

        $query .= "NULL ";
      }

      $query .= "ORDER BY deadline ASC;";

      $statement = $db->prepare ($query);

      $statement->execute ();

      $results = $statement->fetchAll ();

      $statement->closeCursor ();

      $tasks = array ();

      foreach ($results as $result)
      {
        $task = new Task ();

        $task->Initialize ($result);

        $tasks[] = $task;
      }

    }
    catch (PDOException $e)
    {
      Model::LogError ($e->errorMessage ());

      die ();
    }

    return $tasks;
  }

  public static function MarkTaskComplete ($id, $date)
  {
    $sucess = false;

    try
    {
      $db = Model::GetDbConnection ();

      $query = "UPDATE todolist ";
      $query .= "SET completed = Date(:date) ";
      $query .= "WHERE id = :id;";
      
      $statement = $db->prepare ($query);

      $statement->bindValue (':id', $id, PDO::PARAM_INT);
      $statement->bindValue (':date', $date, PD::PARAM_STR);

      $success = $statement->execute ();

      $statement->closeCursor ();
    }
    catch (PDOException $e)
    {
      Model::LogError ($e->getMessage ());

      die ();
    }

    return $success;
  }
  public static function DeleteTask ($id)
  {
    $success = false;

    try
    {
      $db = Model::GetDbConnection ();

      $query = "DELETE ";
      $query .= "FROM todolist.task ";
      $query .= "WHERE id = :id;";

      $statement = $db->prepare ($query);

      $statement->bindValue (':id', $id, PDO::PARAM_INT);

      $successs = $statement->execute ();

      $statement->closeCursor ();
    }
    catch (PDOException $e)
    {
      Model::LogError ($e->getMessage ());

      die ();
    }

    return $success;
  }

  public static function UpdateTask ($task)
  {
    $sucess = false;

    try
    {
      $db = Model::GetDbConnection ();

      $query = "UPDATE todolist.task ";
      $query .= "SET title = :title, description = :description";
      $query .= ", deadline = DATE(:deadline)";
      $query .= ", completed = DATE(:completed)";
      $query .= " WHERE id = :id";
      $query .= ";";

      $statement = $db->prepare ($query);

      $statement->bindValue (':title', $task->GetTitle (), PDO::PARAM_STR);
      $statement->bindValue (':description', $task->GetDescription (), PDO::PARAM_STR);
      $statement->bindValue (':id', $task->GetId (), PDO::PARAM_INT);
      $statement->bindValue (':deadline', $task->GetDeadline (), PDO::PARAM_STR);
      $statement->bindValue (':completed', $task->GetCompleted (), PDO::PARAM_STR);

      $success = $statement->execute ();

      $statement->closeCursor ();
    }
    catch (PDOException $e)
    {
      Model::LogError ($e->getMessage ());

      die ();
    }

    return $success;
  }
  public static function GetTask ($id)
  {
    $task = false;

    try
    {
      $db = Model::GetDbConnection ();

      $query = "SELECT * ";
      $query .= "FROM todolist.task ";
      $query .= "WHERE id = :id";
      $query .= ";";

      $statement = $db->prepare ($query);

      $statement->bindValue (':id', $id, PDO::PARAM_INT);

      $statement->execute ();

      $results = $statement->fetch ();

      $statement->closeCursor ();

      $task = new Task ();

      $task->Initialize ($results);
    }
    catch (PDOException $e)
    {
      Model::LogError ($e->getMessage ());

      die ();
    }

    return $task;
  }
  public static function AddTask ($task)
  {
    $sucess = false;

    try
    {
      $db = Model::GetDbConnection ();

      $query = "INSERT INTO todolist.task (title, description";
      
      if ($task->IsDeadlineSet ())
      {
        $query .= ", deadline";
      } 

      $query .= ") ";
      $query.= "VALUES (:title, :description";
        
      if ($task->IsDeadlineSet ())
      {
        $query .= ", DATE(:deadline)";
      }
    
      $query .= ");";

      $statement = $db->prepare ($query);

      $statement->bindValue (':title', $task->GetTitle (), PDO::PARAM_STR);
      $statement->bindValue (':description', $task->GetDescription (), PDO::PARAM_STR);

      if ($task->IsDeadlineSet ())
      {
        $statement->bindValue (':deadline', $task->GetDeadline (), PDO::PARAM_STR);
      }

      $statement->execute ();

      $success = $db->lastInsertId ();

      $statement->closeCursor ();
    }
    catch (PDOException $e)
    {
      Model::LogError ($e->getMessage ());

      die ();
    }

    return $success;
  }
  public static function Authenticate ($username, $password)
  {
    $user = false;

    try
    {
      $db = Model::GetDbConnection ();

      $query = "SELECT username ";
      $query .= "FROM todolist.user ";
      $query .= "WHERE username = :username ";
      $query .= "AND pwd = Sha1(:pwd);";

      $statement = $db->prepare ($query);

      $statement->bindValue (':username', $username, PDO::PARAM_STR);
      $statement->bindValue (':pwd', $password, PDO::PARAM_STR);

      $statement->execute ();

      $results = $statement->fetch ();

      if ($results != false)
      {
        $user = $results['username'];
      }

      $statement->closeCursor ();
    }
    catch (PDOException $e)
    {
      Model::LogError ($e->getMessage ());

      die ();
    }

    return $user;
  }

  public static function GetDbConnection ()
  {
    $dsn = 'mysql:host=localhost;dbname=todolist';
    $username = 'appuser';
    $password = 'appuser123';

    try
    {
      $db = new PDO($dsn, $username, $password);
    }
    catch (PDOException $e)
    {
      Model::LogError($e->getMessage());
      
      die ();
    }

    return $db;
  }

  public static function LogError ($message)
  {
    include ('../view/message-form.php');
  }
}
?>
