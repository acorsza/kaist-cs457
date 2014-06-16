<html>

<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_style.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.min.js"></script>

<script type="text/javascript">

//GLOBAL vars
var imgPath = '<?php echo base_url(); ?>assets/media/users_pictures/'; // do not delete.


//After DOM is ready so call the functions to fill the page.
$(document).ready(function() {
	
	loadUserInfo();

	//while users type a new username the fixed username below de users img is changed.
	$('body').delegate('#username', 'keyup change', function(){
   		$('#fixedUserName').text(this.value);
	});

	//upload img when selecting some img from the users computer
	//----------------------------------------------------------------------------------
 	$("#imagem").on("change", function() {
		$("#formulario").submit();
	});

	
	$('#formulario').on('submit',(function(e) {
		e.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			type:'POST',
			url: $(this).attr('action'),
			data:formData,
			cache:false,
			contentType: false,
			processData: false,
			success:function(data){
				$(".img-prof-user").attr('src', imgPath + data).load(function(){
              		//do something after load the image
              	});
              	$('.img-pos').show();
              	$('.mask').show();
				$('.loader').hide();
			},
			error: function(data){
				console.log("error");
				console.log(data);
				$('.img-pos').show();
				$('.mask').show();
				$('.loader').hide();
			}
		});
	}));
	//----------------------------------------------------------------------------------

});


//ALL FUNCTIONS

function uploadImg(){
	//show loader gif
	$('.img-pos').hide();
	$('.mask').hide();
	$('.loader').show();
	
	$('#imagem').click();

}

function loadUserInfo(){
	var username, email, country, imgName = ''; 
	var url_img_face = ''; 
    var pathImage = ''; 
                  
	url_img_face = '<?php echo $img_facebook ?>'; 
    
	<?php foreach($userinfo as $c): ?>; 
		username = '<?php echo $c->username; ?>'; 
		email = '<?php echo $c->email; ?>'; 
		country = '<?php echo $c->id_country; ?>'; 
		imgName = '<?php echo $c->img_name; ?>' 
	<?php endforeach; ?> 
	if(url_img_face !== ''){
		pathImage = url_img_face;
	} 
	else{
		pathImage = imgPath + imgName;
	}

	$(".img-prof-user").attr('src', pathImage).load(function(){ 
		//do something after load the image 
	});
	 
	$('#fixedUserName').html(username); 
	$('#username').val(username);
	$('#email').val(email); 
	$('#country option[value="' + country + '"]').prop("selected", true);
}

//------------------------------------------------
function save()
//------------------------------------------------
{
	_username = $("#username").val();
	_email    = $("#email").val();
	_country  = $("#country").val();

	$.ajax({
      type: 'post',
      data: 'username=' + _username + '&' + 'email=' + _email + '&' + 'country=' + _country,
      url:'<?php echo base_url();?>user/save',
      success: function(retorno){
        	//alert(retorno);
        	$("#success").css("opacity", 0);
        	$("#danger").css("opacity", 0);
        	$("#success").delay(50).animate({"opacity": "1"}, 700);
      },
      error: function(retorno){
      		$("#success").css("opacity", 0);
      		$("#danger").css("opacity", 0);
        	$("#danger").delay(50).animate({"opacity": "1"}, 700);
      }
 	 });
}

//substituir estes metodos de mudanca de visibilidae para eventos com jquery
function changeImgStyleOver(){
	$('.img-prof-user').css({"opacity": 0.4});
}

function changeImgStyleOut(){
	$('.img-prof-user').css({"opacity": 1.0});
}

function showUpLoadIcon(){
	$('.img-upload').css({"visibility": "visible"});
}

function hideUpLoadIcon(){
	$('.img-upload').css({"visibility": "hidden"});
}

</script>

</head>


<body>

	<div class="cnt-all" >

		<!--current page location --> 
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>">Home</a></li>
			<li class="active">User Profile</li>
		</ol>

		<div class="heading">
			<h2>User Profile</h2>
		</div>

		<div class="cnt-center-user">
			<div class="loader" >
				<img src="<?php echo base_url();?>assets/media/icons/loader_pic.gif">
			</div>
			<div class="cnt-center-user2">

				<form id="formulario" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>user/uploadImage" style="display:none;"> 
					<input type="file" id="imagem" name="imagem" /> 
				</form>
				<div id="visualizar"></div>


				<!-- profile img -->
				<div class="img-pos">
					<img src="#" height="140" width="140" class="img-prof-user">
					<img src="<?php echo base_url(); ?>assets/media/icons/uploadicon.png" height="80" width="80" class="img-upload" onclick="uploadImg()">
					<h4 id="fixedUserName"><h4>
					</div>
					<div class="mask" onmouseover="changeImgStyleOver(), showUpLoadIcon()" onmouseout="changeImgStyleOut(), hideUpLoadIcon()" onclick="uploadImg()"></div>


					<!-- form contains personal informations -->
					<div class="info-pos">
						<input type="text" class="form-control replace-width" id="username" name="username" placeholder="Name"/>
						<input type="text" class="form-control replace-width" id="email" name="email" placeholder="Email" />
						<select class="input-group input-group-lg form-control replace-width" id="country" name="country">
							<option>Where are you from?</option>
							<?php foreach($countrylist  as $r): ?>
								<option value=<?php echo "\"$r->idcountries\""?>>
									<?php echo $r->country; ?>
								</option>
							<?php endforeach; ?>
						</select>
						<button type="button" class="btn bnt-save" onclick="save()">Save</button>
						<button type="button" class="btn bnt-cancel" onclick="location.href = '<?php echo base_url(); ?>'">Cancel</button>
					</div>
				</div>
				<div id="success" class="alert alert-success msg-sucsess">
					<i class="glyphicon glyphicon-ok"></i>
					User's Informations have been saved!
				</div>
				<div id="danger" class="alert alert-danger msg-danger">
					<i class="glyphicon glyphicon-warning-sign"></i>
					User's Informations haven't been saved!
				</div>
			</div>
		</div>

	</body>
</html>