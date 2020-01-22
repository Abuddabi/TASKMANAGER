<?php $this->layout('layout') ?>


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Create Task</h1>
      <form action="createTask_h" method="post">
        <div class="form-group">
          <input name="title" type="text" class="form-control">
        </div>

        <div class="form-group">
          <textarea name="content" class="form-control"></textarea>
        </div>

        <div class="form-group">
          <button name="submit" value="press" class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>