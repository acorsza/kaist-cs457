<html>
<head>

<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="../../assets/css/styleTopic.css">
  
<script type="text/javascript">

$(document).ready(function() {
  showResultDaejeonHub();
  showCategories();
  googleSearch();
  loadInfo();

});

//Ruan @ 29/05/2014 - load info to the page like typed filter.
//----------------------------------------------------------------------------------
function loadInfo()
//----------------------------------------------------------------------------------
{
   var filter =  '<?php echo $filter; ?>';
   $('#inputsearch').val(filter);
}

//Ruan @ 29/05/2014 - Makes a search on google with the typed filter.
//----------------------------------------------------------------------------------
function googleSearch()
//----------------------------------------------------------------------------------
{
  var title, description, url, resultElement  = '';
   
  <?php 
  $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&rsz=8&q=".$filter?>;

  <?php
  $body = file_get_contents($url);
  $json = json_decode($body);

  for($x=0;$x<count($json->responseData->results);$x++){ ?>;

    url         = '<?php echo $json->responseData->results[$x]->url; ?>';
    title       = '<?php echo $json->responseData->results[$x]->title; ?>';
    <?php 
        $string = $json->responseData->results[$x]->content;
        $string = str_replace("<b>","", $string); 
        $string = str_replace("</b>","", $string);
        $string = str_replace("\n","", $string); 
        $string = str_replace("\r","", $string); 

    ?>

    description = '<?php echo $string; ?>';

    resultElement += '<a href="' + url + '" class="list-group-item" target="_blank">';
    resultElement += '<h4 class="list-group-item-heading" style="color: blue; font-family: normal; font-weight:bold;">' + title + '</h4>';
    resultElement += '<p class="list-group-item-text">' + description + '</p>';
    resultElement += '<p class="list-group-item-text">...</p>';
    resultElement += '<p class="list-group-item-text">' + url + '</p></a>';

    $('#resultGoogle').append( resultElement );
    resultElement = '';

  <?php } ?>;

    if(<?php echo count($json->responseData->results); ?> <= 0){
       $('.no-result-goog').append('Sorry, no results found...');
    }
}

//Ruan @ 29/05/2014 - Makes a consult on database to select topics where title ou content presents the typed filter.
//----------------------------------------------------------------------------------
function showResultDaejeonHub()
//----------------------------------------------------------------------------------
{
  var hasResult = true;
  var title, description, idTopic, resultElement  = '';
  <?php if($list != null && $list != ""){ ?>
        <?php foreach($list  as $c){ ?>;

          //Remove formatting to prevent error undertermined literal string
          <?php $desc  = str_replace(array("\n","\r"), "", $c->description); ?>

          idTopic     = <?php echo "\"$c->idtopics\""; ?>;
          title       = <?php echo "\"$c->title\""; ?>;
          description = <?php echo "\"$desc\""; ?>; 

          resultElement += '<a href="<?php echo base_url();?>topic/show/' + idTopic + '" class="list-group-item">';
          resultElement += '<h4 class="list-group-item-heading" style="color:blue;">' + title + '</h4>';
          resultElement += '<p class="list-group-item-text">' + description + '</p>';
          resultElement += '<p class="list-group-item-text">...</p></a>';

          $('#resultDaejeonHub').append( resultElement );
          resultElement = '';

        <?php 
        }
      }
      else{
      ?>;
        $('.no-result-daej').append('Sorry, no results found...');
      <?php } ?>
}

//Ruan @ 28/05/2014 - Shows categories.
//----------------------------------------------------------------------------------
function showCategories()
//-------------------------------------------------------------------------------
{
    <?php foreach($categorylist as $c): ?>; 
        $(".nav").append('<li class=""  value="<?php echo $c->idcategory; ?>" onclick="categoryFilter(this)"><a href="#">' + <?php echo "\"$c->category\""; ?> + '</a></li>');   
    <?php endforeach; ?>
}

//Ruan @ 04/06/2014 - Active os desactive the category to be used on the search
//-------------------------------------------------------------------------------
function categoryFilter(obj)
//-------------------------------------------------------------------------------
{
  if($(obj).attr('class') === 'active'){
    $(obj).attr('class', '');
  }
  else{
    $(obj).attr('class', 'active');
  }
}

//Ruan @ 04/06/2014 - Get just the selected categories to perform search.
//-------------------------------------------------------------------------------
function getSelectedCAtegories()
//-------------------------------------------------------------------------------
{

  var selected = "";

  $('#categoryList').each(function(){
        $(this).find('li').each(function(){
            //alert($(this).attr('class'));
            if($(this).attr('class') === 'active'){
               selected += $(this).val() + "*";
            }
        });
  });
  //store in hidden input to be send in the form submit
  $("#selectedCategories").val(selected);
}

</script>
</head>


<body>

  <!--current page location --> 
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url();?>">Home</a></li>
    <li><a href="<?php echo base_url();?>/topic/all">All Topics</a></li>
    <li class="active">Search Result</li>
  </ol>

  <!-- parent container with all content divs -->
  <div class="container cnt-all el-align-left">


    <!-- search input -->
  <form action="<?php echo base_url()?>search/result" onsubmit="getSelectedCAtegories()" method="POST">
    <div class="input-group input-group-lg cnt-search el-align-left" style="margin-top:20px;">
      <input type="text" id="inputsearch" name="filter" class="form-control" placeholder="Search">
      <input type="text" id="selectedCategories" name="selectedCategories" style="display:none;">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Go!</button>
      </span>
    </div>

    <!-- categories list -->
    <table class="el-align-left tb-ctg" width="100%" style="margin-top:10px;">
      <tr>
        <td style="vertical-align:text-top;">
          <h3 style="margin-top:5px;"> Category: </h3>
        </td>
        <td>

          <ul id="categoryList" class="nav nav-pills">
            <!--<li class="active"><a href="#">Select</a></li>-->
          </ul>
        </td>
      </tr>
    </table>

  </form>


    <!-- Dajeon Hub results -->
    <div style="margin-bottom: 40px; margin-top:90px;">
        <h3>Dajeon Hub Results</h3>        
        <hr/>
        <div class="no-result-daej" ></div>
    </div>
    
    <div class="cnt-center-content">
      <div class="list-group" id="resultDaejeonHub"></div>
    </div>

    <!-- Google results -->
    <div style="margin-bottom: 40px; margin-top:90px;">
        <h3>Google Results</h3>
        <hr/>
        <div class="no-result-goog"></div>
    </div>
    
    <div class="cnt-center-content">
      <div class="list-group" id="resultGoogle"></div>
    </div>

    <div class="cnt-right-content">
      <h3>Search-related Videos</h3>
      <?= $videos ?>
    </div>
<!-- youtube google -->

  </div> 

  <hr id="lineEnd">   
</body>
</html>
