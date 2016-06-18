<?php
  include ('../private/includes/header-include.php');
?>
<?php if ($option == 1) { ?>
<h1>Completed Tasks</h1>
<?php } else if ($option == -1) { ?>
<h1>Uncompleted Tasks</h1>
<?php } else { ?>
<h1>All Tasks</h1>
<?php } ?>
<table class="cellTable">
  <thead>
    <tr>
      <th>Title</th>
      <th>Deadline</th>
      <th>Completed</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      $count = 1;
      foreach($tasks as $task)
      {
        $id = $task->GetId ();
        $title = $task->GetTitle ();
        $deadline = $task->IsDeadlineSet () ? $task->GetDeadline () : '-';
        $completed = $task->IsCompletedSet () ? $task->GetCompleted () : '-';

        if ($deadline !== '-' && time() > strtotime ($deadline))
        {
            echo ('<tr class="past-due">');
        }
        else if ($deadline !== '-' && time () > (strtotime ($deadline) - (60*60*24*7)))
        {
            echo ('<tr class="coming-up">');
        }
        else if ($count % 2 == 0)
        {
          echo ('<tr>');
        }
        else 
        {
          echo ('<tr class="oddRow">');
        }

        if ($deadline !== '-')
        {
          $deadline = Utils::ToDisplayDate ($deadline);
        }

        if ($completed !== '-')
        {
          $completed = Utils::ToDisplayDate ($completed);
        }

				echo('<td>');
				echo(Utils::GetHtmlSafe ($title));
				echo('</td>');
				echo('<td>');
				echo($deadline);
				echo('</td>');
				echo('<td>');
				echo($completed);
		?>
      <td><input type="button" value="View" onclick="location.href='<?php echo (Utils::GetScript ('ViewTask&id=' . $id)); ?>'" /></td>
      <td><input type="button" value="Edit" onclick="location.href='<?php echo (Utils::GetScript ('EditTask&id=' . $id)); ?>'" /></td>
      <td><input type="button" value="Delete" onclick="location.href='<?php echo (Utils::GetScript ('DeleteTask&id=' . $id)); ?>'" /></td>
		<?php
				echo ('</tr>');
				
				$count++;
			}
    ?> 
  </tbody>
</table>
<?php
  include ('../private/includes/footer-include.php');
?>
