<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            if (!isset($dCharset)) { $dCharset = "UTF-8"; }
            if (!isset($dDescription)) { $dDescription = "Todo list."; }
            if (!isset($dTags) || !is_array($dTags)) { $dTags = array("todo", "list"); }
            if (!isset($dAuthor)) { $dAuthor = "Wesley Garey"; }
            if (!isset($dTitle)) { $dTitle = "The Todo List"; }

            $tags = "";
            foreach ($dTags as $tag)
            {
                $tags .= $tag . " ";
            }
        ?>

        <meta charset='<?php echo($dCharset); ?>' />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name='description' content='<?php echo($dDescription); ?>' />
        <meta name='keywords' content='<?php echo($tags); ?>' />
        <meta name='author' content='<?php echo($dAuthor); ?>' />

        <title><?php echo($dTitle); ?></title>

        <link rel='shortcut icon' href='../private/images/icon.ico' />

        <link rel='stylesheet' href='../private/css/main.css' />
        <link rel='stylesheet' href='../private/css/bootstrap.css' />
        
        <script type='text/javascript' src='../private/js/jquery-1.9.1.min.js'></script>
        <script type='text/javascript' src='../private/js/bootstrap.js'></script>
        <script type='text/javascript' src='../private/js/javascript.js'></script>
        <script type='text/javascript' src='../private/js/jquery.tablesorter.js'></script>
        <script type='text/javascript' src='../private/js/jquery.validate.js'></script>
        <script type='text/javascript' src='../private/js/navbar.js'></script>
    </head>
    <body>
      <?php if (Controller::IsUserLoggedIn()) { ?>
        <div class="navbar-space"> </div>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo (Utils::GetScript ('ViewTasks&Completed=FALSE')); ?>">The Todo List</a>
              </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tasks<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="<?php echo (Utils::GetScript ('ViewTasks&option=0')); ?>">View All Tasks</a></li>
                      <li><a href="<?php echo (Utils::GetScript ('ViewTasks&option=1')); ?>">View Completed Tasks</a></li>
                      <li><a href="<?php echo (Utils::GetScript ('ViewTasks&option=-1')); ?>">View Uncompleted Tasks</a></li>
                      <li class="divider"></li>
                      <!--<li class="dropdown-header">More</li>-->
                      <li><a href="<?php echo (Utils::GetScript ('AddTask')); ?>">Add Task</a></li>
                    </ul>
                  </li>
                </ul>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo(Utils::GetHtmlSafe(Controller::GetUsername ())); ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="<?php echo (Utils::GetScript ('Logout')); ?>">Logout</a></li>
                    </ul>
                  </li>
                </ul>
              </div><!--/.nav-collapse -->
            </div>
          </nav>
        <?php } ?>
        <div class="container">
