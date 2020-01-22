<?php $this->layout('layout') ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Edit Task</h1>
      <form action="/editTask_h" method="post">
        <div class="form-group">
          <input name="title" value="<?=$task['title']; ?>" type="text" class="form-control">
        </div>

        <div class="form-group">
          <textarea name="content" class="form-control"><?=$task['content']; ?></textarea>
        </div>

        <div class="form-group">
          <button name="id" value="<?=$task['id']; ?>" class="btn btn-warning" type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>