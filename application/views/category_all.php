<div class="container">
	<h2>Topics by Category</h2>
	<?php if($categories){foreach($categories  as $r): ?>
		<?php 
			  	$path = base_url()."topic/showbyCategory/$r->idcategory";
	    ?>
       <a href=<?php echo $path; ?> class="list-group-item"><?php echo $r->category; ?></a>
    <?php endforeach; }?>
<hr>