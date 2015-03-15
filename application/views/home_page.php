    <?php 
    $i = 0;
    $username = null;
        if($username != null){
          $showDivFlag = false;
          $userlogged = true;
       } else {
          $showDivFlag = true;
       }
        
        ?>

    <div class="jumbotron">
      <div class="container text-center">
        <h1>What do you want to know?</h1>
        <p>Daejeon Hub helps you to find answers for your daily questions!</p>
        <form action="<?php echo base_url()?>search/result" method="POST">
        <div class="input-group input-group-lg">
          	<input type="text" id="inputsearch" name="filter" class="form-control" placeholder="Search">
          	<span class="input-group-btn">
             <button class="btn btn-default" type="submit">Go!</button>
            </span>
          
        </div>
        </form>
        <br />
       
        
        
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Top Topics</h2>
          <div class="list-group">
            <?php foreach($topicList  as $r): if (++$i == 11) break;?>

              <a href=<?php echo base_url() . "topic/show/$r->idtopics"; ?> class="list-group-item"><?php echo $r->title; ?>

              </a>
            <?php endforeach; $i = 0?>
          </div>
        </div>


        <!-- @Aderlei 11/06/2014 - Column for Questions without answer -->

        <div class="col-md-4">
          <h2>Questions without answer</h2>
          <div class="list-group">
            <?php foreach($topic_no_answer  as $t): if (++$i == 11) break;?>
              <a href=<?php echo base_url() . "topic/show/$t->idtopics"; ?> class="list-group-item"><?php echo $t->title; ?>

              </a>
            <?php endforeach; ?>
          </div>
       </div>
        
       
        <div <?php if ($showDivFlag===false){?>style="display:none"<?php } ?>>
        <div class="col-md-4">
          <h2>New user?</h2>
            <form action="user/create" method="post">
            <div class="input-group input-group-lg">
              <span class="input-group-addon"></span>
              <input type="text" class="form-control" placeholder="Name" name="name">
            </div>
            <br />
            <div class="input-group input-group-lg">
              <span class="input-group-addon"></span>
              <input type="email" class="form-control" placeholder="Email" name="email">
            </div>
            <br />
            <div class="input-group input-group-lg">
              <span class="input-group-addon"></span>
              <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <br />
                 <select class="input-group input-group-lg form-control" name="country">
                  <option>Where are you from?</option>
                  <?php foreach($countrylist  as $r): ?>
                    <option value=<?php echo "\"$r->idcountries\""?>>
                      <?php echo $r->country; ?>
                    </option>
                  <?php endforeach; ?>
              </select>
              <br />
            <button type="submit" class="btn btn-default" name="submit">Register &raquo;</button>
          </form>
        </div>
      </div>


      <div <?php if ($showDivFlag===true){?>style="display:none"<?php } ?>>
        <div class="col-md-4">
          <h2>My topics</h2>
            
        </div>
      </div>
    </div>
  </div>
<hr>