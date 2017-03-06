<div id="alfa"><!-- Begin: alfa -->
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                <div class="alfa_lft"><!-- Begin: alfa_lft -->
                	<p class="alfa_lft_p">
						Where hand made fashion jewelary introducing new style.
						<b style="color: #fff; float: right; font-size: 23px; position: relative; top: -3px;"><?php echo betaversion(); ?>!</b>
					</p>
                </div><!-- End: alfa_lft -->
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div class="alfa_rt"><!-- Begin: alfa_rt -->
					<p class="alfa_rt_p01">
						<a href="#signin" id="#sig" class="signin" data-toggle="modal" data-target=".loggin"><i class="fa fa-lock" aria-hidden="true"></i> Login</a>
					</p>
                	<p class="alfa_rt_p02">
						<a href="#register" id="reg" class="registerm" data-toggle="modal" data-target=".regging"><i class="fa fa-user" aria-hidden="true"></i> Register</a>
					</p>
                	<p class="alfa_rt_p03">
						<a href="#register" id="reg" class="registerm" data-toggle="modal" data-target=".loggin"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Sell on <?php echo sitename(); ?></a>
					</p> 
                </div><!-- End: alfa_rt -->
            </div>
        </div>
    </div>
</div><!-- End: alfa -->
<script>
	/*
	$('form#signinfrm').on('submit', function(form){
		form.preventDefault();
		$.post(base_url + "page/login/checkuser", $('form#signinfrm').serialize(), function(data){
			$('.edit_modelprice').modal('hide');
			$("input#modelpriceVal").val('');
			if(data.status == 'ok'){
				$('.displayPrice-'+data.model_id).html(data.display_price);
			}else{
				
			}
		}, "json");
	});
	*/
</script>