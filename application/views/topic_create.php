      <div class="container">
        <div class="width-70">
        <h2>Create new Topic</h2>
            <form action="<?php echo base_url();?>topic/create" method="post">
              
            <div class="input-group input-group-lg">
              <span class="input-group-addon"></span>
              <input type="text" class="form-control" name="title" placeholder="Title">
            </div>
            
            <h3>Description</h3>
            <textarea rows="7" class="form-control" name="description">
            </textarea>
            <br />
                 <select class="input-group input-group-lg form-control" name="category">
                  <option>Select a category for your topic</option>
                  <?php foreach($categorylist  as $r): ?>
              <option value=<?php echo "\"$r->idcategory\""?>>
                <?php 
                  echo $r->category;
                ?>
              </option>
            <?php endforeach; ?>
              </select>
              <br />
              <div class="btn-group btn-group-lg">
                <button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-pencil padding-7px"></i>Post</button>
              </div>
            
          </form>
        </div>
      <hr>  