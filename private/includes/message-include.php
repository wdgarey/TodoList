<h3 class="red-font"><?php echo(Utils::GetHtmlSafe($message)); ?></h3>

<?php if (isset($list)) { ?>
    <ul>
    <?php foreach ($list as $listItem) { ?>
        <li><?php echo(Utils::GetHtmlSafe($listItem)); ?></li>
    <?php } ?>
    </ul>
<?php } ?>
