<?php
  include ('../private/includes/header-include.php');
?>

<?php if ($task->IsIdSet ()) { ?>
  <h1>Edit Task</h1>
<?php } else { ?>
  <h1>Add Task</h1>
<?php } ?>
<form class="add-edit-task" method="POST" action="<?php echo (Utils::GetScript ('ProcessAddEditTask')); ?>">
<?php if ($task->IsIdSet ()) { ?>
  <input type="hidden" name="id" value="<?php echo ($task->GetId ()); ?>" />
<?php } ?>
  <label>Title:</label>
  <input type="text" placeholder="(e.g. Replace Filter)" name="title" class="" value="<?php echo (Utils::GetHtmlSafe ($task->GetTitle ())); ?>" required autofocus />
  <br />
  <br />
  <label>Description:</label>
  <br />
  <label> </label>
  <textarea name="description" class="" placeholder="(e.g. Make sure to change both upstairs and downstairs.)" rows="5" cols="40" maxlength="100"><?php echo (Utils::GetHtmlSafe ($task->GetDescription ())); ?></textarea>
  <br />
  <br />
  <label>Deadline:</label>
  <input type="date" name="deadline" value="<?php echo (Utils::GetHtmlSafe ($task->GetDeadline ())); ?>" class="" placeholder="(e.g. 6/15/2016)" />
  (leave blank if there is no deadline)
  <br />
  <br />
  <label>Interim</label>
  <input type="number" name="interim" value="<?php echo ($task->GetInterim ()); ?>" class="" min="0" step="1" placeholder="(e.g. 7)" />
  day(s) (leave blank if the task is not recurring)
  <br />
  <br />
  <label>Completed:</label>
  <input type="date" name="completed" value="<?php echo (Utils::GetHtmlSafe ($task->GetCompleted ())); ?>" class="" placeholder="(e.g. 6/15/2016)" />
  (leave blank if the task has not been completed)
  <br />
  <br />
  <input type="submit" value="Submit">
  <?php if ($task->IsIdSet ()) { ?>
  <input type="button" value="Delete" onclick="location.href='<?php echo (Utils::GetScript ('DeleteTask&id=' . $task->GetId ())); ?>'">
  <?php } ?>
</form>
<?php
  include ('../private/includes/footer-include.php');
?>
