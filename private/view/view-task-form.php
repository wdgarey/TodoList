<?php
  include ('../private/includes/header-include.php');
?>
<h1>View Task</h1>
<div class="add-edit-task">
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
  <label>Completed:</label>
  <?php if ($task->IsCompletedSet ()) { ?>
  <?php echo (Utils::GetHtmlSafe (Utils::ToDisplayDate($task->GetCompleted ()))); ?>
  <?php } else { ?>
  Not completed yet.
  <?php } ?>
  <br />
  <br />
</div>
<form class="inline" method="POST" action="<?php echo (Utils::GetScript ('EditTask')); ?>">
  <input type="hidden" name="id" value="<?php echo ($task->GetId ()); ?>" />
  <input type="submit" value="Edit">
</form>
<form class="inline" method="POST" action="<?php echo (Utils::GetScript ('DeleteTask')); ?>">
  <input type="hidden" name="id" value="<?php echo ($task->GetId ()); ?>" />
  <input type="submit" value="Delete">
</form>
<form class="inline" method="POST" action="<?php echo (Utils::GetScript ('ProcessAddEditTask')); ?>">
  <input type="hidden" name="title" value="<?php echo (Utils::GetHtmlSafe ($task->GetTitle ())); ?>" />
  <input type="hidden" name="description" value="<?php echo (Utils::GetHtmlSafe ($task->GetDescription ())); ?>" />
  <input type="hidden" name="deadline" value="<?php echo (Utils::GetHtmlSafe ($task->GetDeadline ())); ?>" />
  <input type="hidden" name="completed" value="" />
  <input type="submit" name="duplicate" value="Repeat in:" />
  <input type="number" name="interim" value="1" min="0" step="1"/> day(s)
</form>
<?php
  include ('../private/includes/footer-include.php');
?>
