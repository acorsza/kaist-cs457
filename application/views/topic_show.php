<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" href="../../assets/css/styleTopic.css">
<link rel="stylesheet" href="../../assets/css/rating_button.css">
<link rel="stylesheet" href="../..//assets/lightbox/css/lightbox.css">


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../../assets/lightbox/js/lightbox.min.js"></script>


<!-- API's to show the weather map -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=weather"></script>
<script type="text/javascript" src="../../assets/js/weather_map.js"></script>
<!--  // -->

  
<script type="text/javascript">

//Global vars (POG - Programação Orientada a Gambiarra)
var _idTopic = '';
var _noAttachedImages = 0;


//After DOM is ready so call the functions to fill the page.
$(document).ready(function() {

      showTopic();
      showReplies();
      showCategories();
      showRelatedTopics();
      showWeather(); //call from separate js file


      //FACEBOOK SDK to get LIKE and SHARE functions
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

});


//Ruan @ 30/04/2014 - Shows the topic data.
//-------------------------------------------------------------------------------
function showTopic()
//-------------------------------------------------------------------------------
{
    var topicTitle, topicDesc, userTopic = null;

    <?php foreach($single_topic  as $c): ?>;
      _idTopic = <?php echo "\"$c->idtopics\""; ?>; 

      userTopic  = <?php echo "\"$c->username\""; ?>; 
      topicTitle = <?php echo "\"$c->title\""; ?>;
      topicDesc  = <?php echo "\"$c->description\""; ?>;
      $('<p>' + topicTitle + '</p>').appendTo("#topicTitle");
      $('<p>' + topicDesc + '</p>').appendTo("#topicDesc");
      $('.topic-footer').append('<hr/><p><?php echo date('M-d-Y h:i:s', strtotime($c->created_at)); 
                    echo "   ";
                    echo "<a class=\"btn btn-danger btn-xs\" href=" . base_url() . "topic/report_t/" . $c->idtopics . ">Report this topic</a>";

                
        ?></p>');
      $("#userTopic").html(userTopic);
    <?php endforeach; ?>
}

//Ruan @ 30/04/2014 - Shows the topic replies.
//-------------------------------------------------------------------------------
function showReplies()
//-------------------------------------------------------------------------------
{

    var node, nodeIni, nodeEnd, user, topicData, rate = '';
    var idReply = '';
    var totalRate = '';
    var imagesReply = '';
    var countReply = 0;

    //if found answerts to the topic then show them.
    <?php 
    if($topic_replies != ""){

        foreach($topic_replies as $c): ?>;
          countReply++;

          nodeIni     = '<div class="node">';
          user        = '<div class="cnt-user well"><img src="<?php if($img_facebook == ""){echo base_url();?>assets/media/users_pictures/<?php }echo $c->img_name; ?>" height="70px" width="70px" class="img-user-ans">';
          user       += '<p style="text-align: center; margin-top: 8px;">' + <?php echo "\"$c->username\""; ?> + '</p></div>';
          topicData   = '<div id="topic" class="panel panel-default cnt-replies reply-box">';
          topicData  += '<div id="topicDesc" class="panel-body">' + '<?php echo $c->description; ?>';
          topicData  += '<br/>';
          imagesReply = showArtifacts(<?php echo $c->id_reply; ?>);
          topicData  +=  imagesReply + '</div><div class="reply-footer"><hr/><p><?php echo date('M-d-Y h:i:s', strtotime($c->registered_at)); 
            echo "   ";
                    echo "<a class=\"btn btn-danger btn-xs\" href=" . base_url() . "topic/report_t/" . $c->id_reply . ">Report this reply</a>";


          ?></p></div></div>';
          rate       = '<a href="#" id="answer_<?php echo $c->id_reply; ?>" onclick="rateAnswer(this)"><div class="cnt-rat-btns">';
          
          if(countReply == 1){
            rate += '<img src="../../assets/media/icons/coroa.jpg" style="height: 25px; width: 50px; margin-top: 6px;">';
            rate += '<div class="bnt-rate" style="margin-top:11px;">';
          }
          else{
            rate += '<div class="bnt-rate">';
          }
    
          rate      += '<div class="hubstyle" ><font class="bnt-text">+1</font>';
          rate      += '</div></div></a>';
          rate      += '<div><p class="count-text point_<?php echo $c->id_reply; ?>">' + <?php echo "\"$c->up_point\""; ?> + '</p></div>';
          rate      += '</div></div>';
          nodeEnd    = '</div>';

          node = nodeIni + user + topicData + rate + nodeEnd;
          $('.cnt-center-content').append(node);
        <?php endforeach;
    }
    else{ ?>
        $('.cnt-center-content').append('<div class="no-result-daej">No answers for this topic...</div>');
    <?php } ?>


}


function showArtifacts(idReply){
  var images = '';
  var idReplyArt= '';
  var path = '';
  <?php if($answer_artifacts) { ?>
   <?php foreach($answer_artifacts as $c): ?>;
      idReplyArt = '<?php echo $c->id_reply; ?>';
      if(idReplyArt == idReply){
        path =  '<?php echo base_url();?>assets/media/artifacts/' + '<?php echo $c->path; ?>';
        images += '<a href="' + path + '" data-lightbox="image-' + idReply + '"><img src="' + path + '" class="attached-images" ></a>';
      } 
  <?php endforeach ?>;
  <?php } ?>

  return String(images);
}



//Ruan @ 24/05/2014 - Shows categories.
//-------------------------------------------------------------------------------
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




//TODO versao em AJAX
//-------------------------------------------------------------------------------
function rateAnswer($this)
//-------------------------------------------------------------------------------
{
  
 var idReply   = ($this.id).substr(7, ($this.id).length);
 var clas      = ".point_" + idReply;
 var scrollPos = $(document).scrollTop();

 $.ajax({
      type: 'post',
      data: 'idTopic=' + _idTopic + '&' + 'idAnswer=' + idReply + '&' + 'scrollPos=' + scrollPos,
      url:'<?php echo base_url();?>topic/rateAnswer',
      success: function(retorno){
       
         var val = retorno.split('#');
         $(document).scrollTop(val[0]);

         if(val[1] == '0'){
            var result = parseInt($(clas).html()) + 1;
            $(clas).html(result);
         }
         else{
            alert("You have already rated this answer before.");
         }
       
      }
  });
}

//-------------------------------------------------------------------------------
function insertArtifact()
//-------------------------------------------------------------------------------
{
  $('#artifact').click();
}

//-------------------------------------------------------------------------------
function readURL(input) 
//-------------------------------------------------------------------------------
{
  if (input.files) {
    //alert('lalala');
    $('#enviaFiles').val('true');
    for(var i = 0; i < input.files.length; i++){

      if(_noAttachedImages < 5){

        var reader = new FileReader();

        reader.onload = function (e) {
          var imgElement = '<img src="' + e.target.result + '" alt="image"/>';
          $('.images-preview').append(imgElement);
        };

        reader.readAsDataURL(input.files[i]);
        _noAttachedImages++;
      }
      else{
        alert('Sorry, 5 images limit!');
        break;
      }
    }
  }
} 

//Ruan @ 14/06/2014 - It includes the video objt inside of the div's reply.
//-------------------------------------------------------------------------------
function addYoutube()
//-------------------------------------------------------------------------------
{
  var video = '';
  var url = prompt("Enter the YOUTUBE URL:");
  url = url.replace("watch?v=", "v/");

  video = '<embed width="320" height="245" src="' + url + '" type="application/x-shockwave-flash"></embed>';
  $('#reply').append(video);
}

//Ruan @ 12/06/2014 - Tranfer the information from the div to a hidden input that will tranfer the information to the server.
//-------------------------------------------------------------------------------
function tranferAnswerContent()
//-------------------------------------------------------------------------------
{
  $("#areaTransferContent").val($('#reply').html());
}

//Ruan @ 14/06/2014 - Show related topics.
//-------------------------------------------------------------------------------
function showRelatedTopics()
//-------------------------------------------------------------------------------
{
  var element = '';

  <?php if($relatedTopics) { foreach($relatedTopics as $c): ?>
    element += '<p><a href="<?php echo base_url();?>topic/show/<?php echo $c->idtopics; ?>">' + '<?php echo $c->title; ?>' + '</a></p>';
    $('.content-related-topics').append(element);
  <?php endforeach; }?>
}

</script>
</head>

<body>

  <!--current page location --> 
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url();?>">Home</a></li>
    <li><a href="<?php echo base_url();?>topic/all">All Topics</a></li>
    <li class="active"><?php foreach($single_topic  as $c){ echo $c->title; } ?></li>
  </ol>

  <!-- weather map google -->
  <div id="map-canvas" class="weather-map"></div>

  <!-- search input -->
  <form action="<?php echo base_url()?>search/result" onsubmit="getSelectedCAtegories()" method="POST">
    <div class="input-group input-group-lg cnt-search el-align-left">
      <input type="text" name="filter" class="form-control" placeholder="Search">
      <input type="text" id="selectedCategories" name="selectedCategories" style="display:none;">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Go!</button>
      </span>
    </div>

    <!-- categories list -->
    <table class="el-align-left tb-ctg" width="850px">
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

  <!-- parent container with all content divs -->
  <div class="container cnt-all el-align-left">

    <div class="cnt-center-content">
      
      <!-- SHARE BUTTON FACEBOOK -->
      <div style="text-align: right; margin-right: 10px; margin-bottom: 10px;">
        <div id="fb-root"></div>
        <div class="fb-like" data-href="<?php echo base_url();?>topic/show/<?php echo $idTopic?>" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div>
        <div class="fb-share-button" data-href="<?php echo base_url();?>topic/show/<?php echo $idTopic?>" data-type="button_count" ></div>
      </div>
      <!-- Represents the container of the topic and the answers for each one -->
      <div class="node" >
        <!-- user image -->
        <div class="cnt-user well">
          <img src="<?php if($img_facebook == ""){echo base_url();?>assets/media/users_pictures/<?php }foreach($userinfo  as $c){ echo $c->img_name; } ?>" height="70px" width="70px" class="img-user-ans">
          <p id="userTopic" style="text-align: center; margin-top: 8px;"></p>
        </div>

        <!-- topic data -->
        <div id="topic" class="panel panel-default cnt-topic">
          <div class="panel-heading">
            <h2 id="topicTitle" class="panel-title"></h2>
          </div>
          <div id="topicDesc" class="panel-body"></div>
          <div class="topic-footer"></div>
        </div>
      </div>

      <!--Answer box -->
      <form enctype="multipart/form-data"  onsubmit="tranferAnswerContent()" action="<?php echo base_url();?>topic/createAnswer/<?php echo $idTopic?>" method="post">
      <div class="div-answer">
        <div style="position:relative; float:left; width:100px;height:100px; "><p class="label-answer">Your Answer:</p></div>
          <div name="reply" id="reply" class="answerbox" contenteditable="true" width="200px"></div>
          <input type="textarea" id="areaTransferContent" name="areaTransferContent" style="display:none">
          
        <div id="test" class="btn-footer">
          <input type="text" id="enviaFiles" name="enviaFiles" style="display:none" value="false"/>
          <button type="submit" class="btn btn-primary bnt-answer" >REPLY</button>
          <button type="button" onclick="addYoutube()" class="btn btn-primary glyphicon glyphicon-film btn-add-youtube"></button>
          <button type="button" onclick="insertArtifact()" class="btn btn-primary glyphicon glyphicon-picture btn-add-img"></button>     
          <input type='file' id="artifact" name="artifact[]" multiple onchange="readURL(this);"  style="display: none;" />
          <!--<img id="blah" src="#" alt="your image" /> -->
          <div class="images-preview">
            <!-- preview of images -->
          </div>
        </div>
      </div>
      </form>




      <div style="margin-bottom: 35px;">
        <h3>Users Replies</h3>
        <hr/>
      </div>
    </div>
    <div class="panel panel-default cnt-rel-topics" >
      <div class="panel-heading" style="background: #428BCA; color:#ffffff">
        <h2 class="panel-title" style="text-align:center;font-size:22px;">Ralated Topics</h2>
        <font class="panel-title"></font>
      </div>
      <div class="content-related-topics"></div> 
    </div>
  </div>

  <hr id="lineEnd">   
</body>
</html>
