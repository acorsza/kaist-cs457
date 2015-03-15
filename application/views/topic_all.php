<div class="container">
	<h2><?php if($mytopics == "true") echo "My Topics"; else if($category != "false") echo "Topics by ".$category; else echo "All Topics"?> </h2>
	<?php if($topicList){foreach($topicList  as $r): ?>
			  <?php 
			  	$path = base_url()."topic/show/$r->idtopics/false";
			  ?>
              <a href=<?php echo $path ?> class="list-group-item"><?php echo $r->title; ?><span class="dateTopic"><?php echo " - " . $r->created_at; ?></span>
              <?php 
              if($mytopics == "true") {
              	if($r->replies_not_seen == 0){ ?>
              		<span class="badge" style="background-color: #428BCA;color: white;"><?php echo $r->replies_not_seen; ?></span>
              	<?php 
              	} else{ ?>
					<span class="badge" style="background-color: #D2322D;color: white;"><?php echo $r->replies_not_seen; ?></span>
              <?php
              		}
              }
              ?>
              
              </a>
            <?php endforeach; }?>
<hr>