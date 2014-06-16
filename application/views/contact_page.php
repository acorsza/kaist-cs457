<head>
	 <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

     <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<script type="text/javascript">
	$(document).ready(function() {

		$('#message').on('focus', function () {
			$('#divBoxMessage').addClass('floating-label-form-group-with-value');
		});
	});
	

	</script>


</head>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 title-contact">
                    <h2>Contact Us</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <form role="form">
                        <div class="row">
                            <div class="form-group col-xs-12 floating-label-form-group">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 floating-label-form-group">
                                <label for="email">Email Address</label>
                                <input class="form-control" type="email" name="email" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="row">
                            <div id="divBoxMessage" class="form-group col-xs-12 floating-label-form-group">
                                <label for="message">Message</label>
                                <textarea placeholder="Message" id="message" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-xs-12" style="text-align: center;">
                                <button type="submit" class="btn btn-lg btn-success menu make-contact">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>