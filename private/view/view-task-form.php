<?php
  include ('../private/includes/header-include.php');
?>
<h1>View Task</h1>
<form class="add-edit-task" method="POST" action="<?php echo (Utils::GetScript ('EditTask')); ?>">
  <input type="hidden" name="id" value="<?php echo ($task->GetId ()); ?>" />
  <label>Title:</label>
  <?php echo (Utils::GetHtmlSafe ($task->GetTitle ())); ?>
  <br />
  <br />
  <label>Description:</label>
  <pre><?php echo (Utils::GetHtmlSafe ($task->GetDescription ())); ?></pre>
  <br />
  <br />
  <?php if ($task->IsDeadlineSet ()) { ?>
  <label>Deadline:</label>
  <?php echo (Utils::GetHtmlSafe (Utils::ToDisplayDate ($task->GetDeadline ()))); ?>
  <br />
  <br />
  <?php } ?>
  <?php if ($task->IsInterimSet ()) { ?>
  <label>Interim</label>
  <?php echo ($task->GetInterim ()); ?>
  day(s)
  <br />
  <br />
  <?php } ?>
  <label>Completed:</label>
  <?php if ($task->IsCompletedSet ()) { ?>
  <?php echo (Utils::GetHtmlSafe (Utils::ToDisplayDate($task->GetCompleted ()))); ?>
  <?php } else { ?>
  Not completed yet.
  <?php } ?>
  <br />
  <br />
  <input type="submit" value="Edit">
  <input type="button" value="Delete" onclick="location.href='<?php echo (Utils::GetScript ('DeleteTask&id=' . $task->GetId ())); ?>'">
</form>
<?php
  include ('../private/includes/footer-include.php');
?>
