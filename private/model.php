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

        $task->SetCompleted ($result['completed']);
        $task->SetDescription ($result['description']);
        $task->SetId ($result['id']);
        $task->SetTitle ($result['title']);

        if (isset ($result['deadline']))
        {
          $task->SetDeadline ($result['deadline']);

          if (isset ($result['interim']))
          {
            $task->SetInterim ($result['interim']);
          }
        }

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

  public static function GetTasks ($completed)
  {
    $tasks = false;

    try
    {
      $db = Model::GetDbConnection ();

      $query = "SELECT * ";
      $query .= "FROM todolist.task ";
      $query .= "WHERE completed IS ";

      if ($completed == true)
      {
        $query .= "NOT ";
      }

      $query .= "NULL ";
      $query .= "ORDER BY deadline DESC;";

      $statement = $db->prepare ($query);

      $statement->execute ();

      $results = $statement->fetchAll ();

      $statement->closeCursor ();

      $tasks = array ();

      foreach ($results as $result)
      {
        $task = new Task ();

        $task->SetCompleted ($result['completed']);
        $task->SetDescription ($result['description']);
        $task->SetId ($result['id']);
        $task->SetTitle ($result['title']);

        if (isset ($result['deadline']))
        {
          $task->SetDeadline ($result['deadline']);

          if (isset ($result['interim']))
          {
            $task->SetInterim ($result['interim']);
          }
        }

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
      $query .= "SET completed = :date ";
      $query .= "WHERE id = :id;";
      
      $statement = $db->prepare ($query);

      $statement->bindValue (':id', $id);
      $statement->bindValue (':date', $date);

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

      $statement->bindValue (':id', $id);

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

      $query = "UPDATE todolist ";
      $query .= "SET title = :title, description = :description";
      
      if ($task->IsDeadlineSet ())
      {
        $query .= ", deadline = DATE(:deadline)";
        
        if ($task->IsInterimSet ())
        {
          $query .= ", interim = :interim ";
        }
      } 

      $query .= " WHERE id = :id";
      $query .= ";";

      $statement = $db->prepare ($query);

      $statement->bindValue (':title', $task->GetTitle ());
      $statement->bindValue (':description', $task->GetDescription ());
      $statement->bindValue (':id', $task->GetId ());

      if ($task->IsDeadlineSet ())
      {
        $statement->bindValue (':deadline', $task->GetDeadline ());

        if ($task->IsInterimSet ())
        {
          $statement->bindValue (':interim', $task->GetInterim ());
        }
      }

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

      $statement = $db->prepare ($query);

      $statement->bindValue (':id', $id);

      $statement->execute ();

      $results = $statement->fetch ();

      $statement->closeCursor ();

      $task = new Task ();

      $task->SetCompleted ($results['completed']);
      $task->SetDescription ($results['description']);
      $task->SetId ($results['id']);
      $task->SetTitle ($results['title']);

      if (isset ($results['deadline']))
      {
        $task->SetDeadline ($results['deadline']);

        if (isset ($results['interim']))
        {
          $task->SetInterim ($results['interim']);
        }
      }
    }
    catch (PDOException $e)
    {
      Model::LogError ($e->getMessage ());

      die ();
    }

    return task;
  }
  public static function AddTask ($task)
  {
    $sucess = false;

    try
    {
      $db = Model::GetDbConnection ();

      $query = "INSERT INTO todolist (title, description";
      
      if ($task->IsDeadlineSet ())
      {
        $query .= ", deadline";
        
        if ($task->IsInterimSet ())
        {
          $query .= ", interim";
        }
      } 

      $query .= ") ";
      $query.= "VALUES (:title, :description";
        
      if ($task->IsDeadlineSet ())
      {
        $query .= ", DATE(:deadline)";
        
        if ($task->IsInterimSet ())
        {
          $query .= ", :interim ";
        }
      }
    
      $query .= ");";

      $statement = $db->prepare ($query);

      $statement->bindValue (':title', $task->GetTitle ());
      $statement->bindValue (':description', $task->GetDescription ());

      if ($task->IsDeadlineSet ())
      {
        $statement->bindValue (':deadline', $task->GetDeadline ());

        if ($task->IsInterimSet ())
        {
          $statement->bindValue (':interim', $task->GetInterim ());
        }
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
