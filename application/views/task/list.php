<style>
#back-btn { display: block; }
</style>
<div class="content">

    <?php echo $this->session->flashdata('deletion');?>

	<ul data-role="listview" data-inset="true">
    <li data-role="list-divider">Open Tasks <span class="ui-li-count"><?=count($tasks)?></span></li>

    <?php foreach ($tasks as $task): ?>

    <li><a href="<?= base_url(); ?>task/listing/<?=$task['owner']?>/<?=$task['slug']?>">
        <h2><?=$task['title']?></h2>
        <p><?=$task['notes']?></p>
        <p class="ui-li-aside">Due: <strong>6:13</strong>PM</p>
    </a></li>

    <?php endforeach; ?>

    <li data-role="list-divider">Recently Closed</li>

    <?php foreach ($comp as $task): ?>

    <li><a href="<?= base_url(); ?>task/listing/<?=$task['owner']?>/<?=$task['slug']?>">
        <h2><?=$task['title']?></h2>
        <p><?=$task['notes']?></p>
        <p class="ui-li-aside">Done: <strong>6:13</strong>PM</p>
    </a></li>

    <?php endforeach; ?>

    <li><a href="index.html">Task Archive</a></li>
</ul>
</div>