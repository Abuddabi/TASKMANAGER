<?php $this->layout('layout') ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">

      <h1><?=$task['title'];?></h1>
      <p><?= $task['content']; ?></p>
      <a href="/tasks">Go back</a>
      
    </div>
  </div>
</div>