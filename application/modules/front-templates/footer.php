<!--Authentication By Mostak-->
	<div class="modal fade regging" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-md" role="document">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<div class="modal-content">
			<div class="signin_details"><!-- Begin: register_details -->
			  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php									
					// Get User Or Visitors Info
					// this is where you get the ip
					$ip = $_SERVER['REMOTE_ADDR'];
					$country_code = getCountryFromIP($ip, "code");
					// this is where you create the variable that get you the name of the country
					$country = getCountryFromIP($ip, " NamE ");
					//echo "Hello there!<br>This is Gaurav Parmar and I welcome you to my website.<br>Your machine's IP is : <b>$ip</b><br>Your visiting country is : <b>$country</b><br>Your country code is : <b>$country_code</b>";
					
				?>
				<form class="form-horizontal" action="<?php echo base_url(); ?>page/user/userreg" id="msignup" method="post">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					  <div class="logfb">
						
						<h3>
							<i class="fa fa-user"></i>
							New user Register here
						</h3>
						
					  </div>
					</div>
					<input type="hidden" name="userip" value="<?php echo $ip; ?>" />
					<!--input type="hidden" name="user_country" value="<?php echo $country; ?>" /-->
				
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">First Name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="" autocomplete="off" name="user_first_name" placeholder="Enter first name" />
						</div>
					</div>
				  
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Last Name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="" name="user_last_name" autocomplete="off" placeholder="Enter last name" />
						</div>
					</div>
				  
					<div class="radio_box">
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Gender</label>
							<div class="col-sm-9">

								<label class="radio-inline">
								  <input checked type="radio" name="user_gender" id="inlineRadio1" value="Male">
								   Male
								</label>

								<label class="radio-inline">
								  <input type="radio" name="user_gender" id="inlineRadio1" value="Female">
								   Female 
								</label>

								<label class="radio-inline">
								  <input type="radio" name="user_gender" id="inlineRadio1" value="Private">
									Rather not say
								 </label>

							</div>
						</div>
					</div>
				  
					<div class="form-group">
						<label for="usseml" class="col-sm-3 control-label">Enter E-mail</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="usseml" autocomplete="off" onkeyup="checkemil(this.value);" name="user_email" placeholder="Enter e-mail">
						</div>
						<div class="col-lg-offset-3 col-lg-9">
							<span id="emerr"></span>
						</div>
					</div>
					
				  
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">Your Country</label>
						<div class="col-sm-9">
							<select required="required" name="user_country" id="user_country" class="form-control">
								<option value="">Select country</option>
								<?php $fxdcountry = fixedcountry();  foreach($fxdcountry as $cresult){ 
									if(empty($country)){ $contry = 'Bangladesh';}
									if($cresult == $contry){ $slt = 'selected="selected"'; }else{ $slt = ''; }
									echo '<option '.$slt.' value="'.$cresult.'">'.$cresult.'</option>';
								 } ?>
							</select>
						</div>
					</div>
					
				  
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-3 control-label">Password</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="regfldOne" autocomplete="off" name="user_password" placeholder="Enter password" />
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-3 control-label">Confirm Password</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" name="conf_user_password" autocomplete="off" placeholder="Enter confirm password" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-lg-9">
							
							<div class="checkbox">
								<label>
									<input name="newsletter" type="checkbox" value="1">
									I must agree the <a target="_blank" href="<?php echo base_url(); ?>page/terms">Terms & Conditions</a> and <a target="_blank" href="<?php echo base_url(); ?>page/ppolicy">Business Policy</a> for <?php echo sitename(); ?>.com
								</label>
							</div>
						</div>
					</div>
				  
					<div class="form-group">
						<div class="col-sm-offset-3 col-lg-9">
						  <button type="submit" class="btn btn-info btn-sm custom-button" style="background: #112C6F;border: 0;border-radius: 0;width: 100%">Register Now</button>
						</div>
					</div>
				</form>
			</div><!-- End: signin_details -->
		</div>
	  </div>
	</div>
	</div>
	<div class="modal fade loggin" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-md" role="document">
		<button type="button" class="close" id="lggclose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<div class="modal-content">
			<div class="signin_details"><!-- Begin: register_details -->
			  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				  <div class="logfb">
					<h3>
						<i class="fa fa-user"></i>
						User Login Here
					</h3>
				  </div>
			  </div>
			  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<form class="form-horizontal" id="signinfrm" action="<?php echo base_url('page/login/dologin'); ?>" method="post">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">User email</label>
						<div class="col-sm-9">
							<input type="text" name="user_email" class="form-control" id="inputEmail3" placeholder="Enter Email">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-3 control-label">Password</label>
						<div class="col-sm-9">
							<input type="password" name="user_password" class="form-control" id="inputPassword3" placeholder="Enter Password">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
						  <div class="checkbox">
							<label>
							  <input name="remember" type="checkbox" value="1">Remember me
							</label>
						  </div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9 col-md-9 col-lg-9">
						  <button type="submit" id="signsub" class="btn btn-info btn-sm custom-button" style="background: #112C6F;border: 0;border-radius: 0;width: 100%">Signin</button>
						</div>
					</div>
				</form>
					
				  <div class="or_separator">
					<div class="or-spacer">
					  <div class="mask"></div>
					  <span><i>or</i></span>
					</div>
				  </div>
				
				  <div class="pop_social">
					<div class="row msloggin">
						<div class="col-lg-12 col-md-21 col-sm-12 col-xs-12">
						  <div class="logfb">
							
							<a class="btn btn-default" href="" role="button" style="width:100%;background:#4682d8;color:#fff;">
									<i class="fa fa-facebook"></i> Sign in With Facebook
							</a>
							
						  </div>
						</div>
						
						<div class="col-lg-12 col-md-21 col-sm-12 col-xs-12 text-center">
						  <div class="logtt">
							<a class="btn btn-default" href="" role="button" style="width:100%;background:#e04733;color:#fff;"><i class="fa fa-google-plus"></i> Sign in With Google+</a>
						  </div>
						</div>
					</div>
				 </div> 
				<div class="modal_fp">
				</div>
					<p style="font-size:12px;text-align:center;padding-top:15px;">
						<!--a href="#" data-toggle="modal" data-target="#forgotpass" style="color:#337ab7;">Forgot Password?</a-->
						For a new member -
						<a data-toggle="modal" data-target=".regging" class="registerm recvpass" href="javascript:void(0);">Register Here</a>
						<br/>
						Forgot your password?
						<a data-toggle="modal" data-target=".restpss" class="forgotp recvpass" href="javascript:void(0);">Password reovery</a>
					</p>
				</div>
			</div><!-- End: signin_details -->
		</div>
	  </div>
	</div>
	
	<div class="modal fade restpss" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-md" role="document">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<div class="modal-content">
			<div class="signin_details"><!-- Begin: register_details -->
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<form class="form-horizontal" id="restpss" action="<?php echo base_url(); ?>page/login/resetpass" method="post">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">User Email</label>
							<div class="col-sm-9">
								<input type="text" name="user_email" class="form-control" id="inputEmail3" placeholder="Enter User Email">
							</div>
						</div>
					  
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9 col-md-9 col-lg-9">
							  <button type="submit" class="btn btn-info btn-sm custom-button" style="width:40%;background: #112C6F;border: 0;border-radius: 0;">Reset Password</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	  </div>
	</div>
<!--End Authentication By Mostak-->


<div id="big_footer"><!-- Begin: big_footer -->
    <div class="container">
        <div class="row">
        
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			
                <div class="footer_box"><!-- Begin: footer_box -->
				
                	<h3 class="footer_box_h3">Web Info</h3>
					
                    <ul>
                    	
                    	<li>
							<a href="<?php echo base_url(); ?>page/about">
								<i class="fa fa-angle-right"></i>&nbsp; About <?php echo sitename(); ?>
							</a>
						</li>
						
                    	<li>
							<a href="<?php echo base_url(); ?>page/faq">
								<i class="fa fa-angle-right"></i>&nbsp; FAQS
							</a>
						</li>
						
                    	<li>
							<a href="<?php echo base_url(); ?>page/terms">
								<i class="fa fa-angle-right"></i>&nbsp; Terms
							</a>
						</li>
						
                    	<li>
							<a href="<?php echo base_url(); ?>page/ppolicy">
								<i class="fa fa-angle-right"></i>&nbsp; Policies
							</a>
						</li>
						
						<?php if( $this->session->userdata('shopopen') == 0){ ?>
						<li>
							<a class="btn btn-info btnsmall" href="<?php echo base_url(); ?>page/yourshop/newshop">
								<i class="fa fa-plus-circle"></i>&nbsp; Open a shop
							</a>
						</li>
						<?php } ?>
						
						<?php if( $this->session->userdata('isLogin') == True){ ?>
						
							<li><a href="<?php echo base_url(); ?>page/login/logout"><i class="fa fa-sign-out"></i>&nbsp; Logout</a></li>
							
						<?php } ?>
						
                    </ul>
                </div><!-- End: footer_box -->
            </div>
        
            

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			
                <div class="footer_box"><!-- Begin: footer_box -->
                	<h3 class="footer_box_h3">Payment methods</h3>
                    <ul>
                    	<li><a href="#"><i class="fa fa-cc-amex"></i>&nbsp; American express</a></li>
                    	<li><a href="#"><i class="fa fa-cc-mastercard"></i>&nbsp; Master card</a></li>
                    	<li><a href="#"><i class="fa fa-cc-visa"></i>&nbsp; Visa card</a></li>
                    	<li><a href="#"><i class="fa fa-cc-discover"></i>&nbsp; Discover</a></li>
                    	<li><a href="#"><i class="fa fa-cc-paypal"></i>&nbsp; Paypal</a></li>
                    </ul>
                </div><!-- End: footer_box -->
            </div>
            
			
			<?php
				$socialSql = $this->db->query("select * from mega_social");
				extract($socialSql->row_array());
			?>
            
			
			
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			
                <div class="footer_box"><!-- Begin: footer_box -->
                	
					<h3 class="footer_box_h3">Follow <?php echo sitename(); ?></h3>
                    
					<ul>
                    	
						<li>
							<a target="_blank" href="<?php echo $facebook; ?>">
								<i class="fa fa-facebook-square" style="font-size:16px"></i>&nbsp; Facebook
							</a>
						</li>
						
                    	<li>
							<a href="<?php echo $facebook; ?>">
								<i class="fa fa-twitter-square" style="font-size:16px"></i>&nbsp; Twitter
							</a>
						</li>
						
                    	<li>
							<a href="<?php echo $facebook; ?>">
								<i class="fa fa-linkedin-square" style="font-size:16px"></i>&nbsp; Linkedin
							</a>
						</li>
						
                    	<li>
							<a href="<?php echo $facebook; ?>">
								<i class="fa fa-pinterest" style="font-size:16px"></i>&nbsp; Pinterest
							</a>
						</li>
						
                    </ul>
					
                </div><!-- End: footer_box -->
            </div>
            
        </div>
    </div>
</div><!-- End: big_footer -->

<div id="footer"><!-- Begin: footer -->
    <div class="container">
        <div class="row">
        
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="copy_right"><!-- Begin: copy_right -->
                	<p class="copy_right_p">Copyright© 2016 - <?php echo date('Y'); ?>, Allrights and reserved <?php echo sitename(); ?> | <a target="_blank" href="<?php echo base_url(); ?>page/ppolicy">Privacy policy</a>.</p>
                </div><!-- End: copy_right -->
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">
                <div class="design_dev"><!-- Begin: design_dev -->
                	<p class="design_dev_p">Design &amp; developed by <a href="http://www.wanitltd.com" target="_blank">WAN IT LTD.</a></p>
                </div><!-- End: design_dev -->
            </div>

        </div>
    </div>
</div><!-- End: footer -->

<div class="new_div1"><!-- Begin: new_div -->
</div><!-- End: new_div -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="new_div1"><!-- Begin: new_div -->
                </div><!-- End: new_div -->
            </div>
        </div>
    </div>
	
	<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script-->
	
	
    <!-- Include jQuery Validator plugin -->
   <script src="<?php echo base_url(); ?>assets/frontend/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/jquery.validate.js'); ?>"></script>
   <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/validate_cde.js'); ?>"></script>
   <script type="text/javascript">
		$("a.recvpass").on('click', function(){
			$("button#lggclose").click();
		});
   </script>
   <script type="text/javascript">
		function checkemil(val){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('page/checkemail'); ?>",
				data:'mail='+val,
				dataType:"json",
				success: function(data){
					if(data.status == 'ok'){
						$("span#emerr").html(data.emerrmess);
						$("input#usseml").val('');
					}else if(data.status == 'nok'){
						$("span#emerr").html('');
					}else{
						$("span#emerr").html('');
					}
				}
			});
		}
   </script>
   <script type="text/javascript">
		$.validator.setDefaults({
			submitHandler: function() {
				//window.location=document.getElementById('signinfrm').attr('action');
				window.location=document.getElementById('msignup').attr('action');
			}
		});
		$("#signinfrm").validate({
			rules: {
			   user_email: {
								required: true,
								email: true
			               },
			   user_password: {
								required: true,
			                  }
			},
			messages: {
				user_email: {
								required: "Please enter your user name",
								email: "Please enter valid email !"
							},
				user_password: "Please enter your password",
			}
		});
		$("#signinp").validate({
			rules: {
			   user_email: {
								required: true,
								email: true
			               },
			   user_password: {
								required: true,
			                  }
			},
			messages: {
				user_email: {
								required: "Please enter your user name",
								email: "Please enter valid email !"
							},
				user_password: "Please enter your password",
			}
		});
		$("#restpss").validate({
			rules: {
			   user_email: {
								required: true,
								email: true
			               },
			},
			messages: {
				user_email: {
								required: "Please enter your user name",
								email: "Please enter valid email !"
							},
			}
		});
		
		$("#msignup").validate({
			rules: {
			   user_first_name: "required",
			   user_last_name: "required",
			   user_country: "required",
			   newsletter: "required",
			   user_email: {
								required: true,
								email: true
			               },
			   user_password: {
								required: true,
			                  },
			   conf_user_password: {
								required: true,
								equalTo: "#regfldOne"
			                  },
			},
			messages: {
				user_first_name: "Please enter your first name",
				user_last_name: "Please enter your last name",
				user_country: "Please select your country",
				newsletter: "Please check this box",
				user_email: {
								required: "Please enter your email",
								email: "Please enter valid email !"
							},
				user_password: {
								 required: "Please enter your password",
								},
				conf_user_password: {
										required: "Please re-enter your password",
										equalTo: "Passwrod Do not Match !"
								    }
			}
		});
		
   </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script>
		var base_url = "<?php echo base_url(); ?>";
		$('form#signinfrm').on('submit', function(e){
			e.preventDefault();
			$.post(base_url + "page/login/checkuser", $('form#signinfrm').serialize(), function(data){
				if(data.status == 'ok'){
					
				}else{
					
				}
			}, "json");
			return false;
		});
	</script>  
    
	
    
	<script type="text/javascript">
      $(document).ready(function () {
      var navListItems = $('div.setup-panel div a'),
              allWells = $('.setup-content'),
              allNextBtn = $('.nextBtn');
    
      allWells.hide();
    
      navListItems.click(function (e) {
          e.preventDefault();
          var $target = $($(this).attr('href')),
                  $item = $(this);
    
          if (!$item.hasClass('disabled')) {
              navListItems.removeClass('btn-primary').addClass('btn-default');
              $item.addClass('btn-primary');
              allWells.hide();
              $target.show();
              $target.find('input:eq(0)').focus();
          }
      });
    
      allNextBtn.click(function(){
          var curStep = $(this).closest(".setup-content"),
              curStepBtn = curStep.attr("id"),
              nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
              curInputs = curStep.find("input[type='text'],input[type='url'],textarea[textarea],select[select]"),
              isValid = true;
    
          $(".form-group").removeClass("has-error");
          for(var i=0; i<curInputs.length; i++){
              if (!curInputs[i].validity.valid){
                  isValid = false;
                  $(curInputs[i]).closest(".form-group").addClass("has-error");
              }
          }
    
          if (isValid)
              nextStepWizard.removeAttr('disabled').trigger('click');
      });
    
      $('div.setup-panel div a.btn-primary').trigger('click');
    });
    </script>
        
    <script type="text/javascript">
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip();
		  $('#myPopOver').popover()
		  $('#myPopOver2').popover()
		  $("#myPopOver3").popover({ trigger: "hover" });
		})
		
		$('#myTab a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		})		
		
	</script>
    
	<script type="text/javascript">
	
    $('#myTab a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })		
    
    </script>

	<script type="text/javascript">
	
		$('#myModal').on('shown.bs.modal', function () {
		$('#myInput').focus()
		})
    
    </script>
    
    
	<script type="text/javascript">
	
		$('#myDropdown').on('show.bs.dropdown', function () {
		  // do something…
		})    
		
    </script>
    
    <!--Demo-->
    <script src="<?php echo base_url(); ?>assets/frontend/js/menu3d.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/frontend/js/menujquery.cookie.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/frontend/js/menujquery.ddslick.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/frontend/js/menudemo.js" type="text/javascript"></script>
    
	<script src="<?php echo base_url(); ?>assets/frontend/js/jquery-ui.js"></script>
    
	<script>
    
    $( "#accordion" ).accordion();
    
    var availableTags = [
    "ActionScript",
    "AppleScript",
    "Asp",
    "BASIC",
    "C",
    "C++",
    "Clojure",
    "COBOL",
    "ColdFusion",
    "Erlang",
    "Fortran",
    "Groovy",
    "Haskell",
    "Java",
    "JavaScript",
    "Lisp",
    "Perl",
    "PHP",
    "Python",
    "Ruby",
    "Scala",
    "Scheme"
    ];
    $( "#autocomplete" ).autocomplete({
    source: availableTags
    });
    
    
    
    $( "#button" ).button();
    $( "#button-icon" ).button({
    icon: "ui-icon-gear",
    showLabel: false
    });
    
    
    
    $( "#radioset" ).buttonset();
    
    
    
    $( "#controlgroup" ).controlgroup();
    
    
    
    $( "#tabs" ).tabs();
    
    
    
    $( "#dialog" ).dialog({
    autoOpen: false,
    width: 400,
    buttons: [
        {
            text: "Ok",
            click: function() {
                $( this ).dialog( "close" );
            }
        },
        {
            text: "Cancel",
            click: function() {
                $( this ).dialog( "close" );
            }
        }
    ]
    });
    
    // Link to open the dialog
    $( "#dialog-link" ).click(function( event ) {
    $( "#dialog" ).dialog( "open" );
    event.preventDefault();
    });
    
    
    
    /*$( "#datepicker" ).datepicker({
    inline: true
    });*/
    
    
    
    $( "#slider" ).slider({
    range: true,
    values: [ 17, 67 ]
    });
    
    
    
    $( "#progressbar" ).progressbar({
    value: 20
    });
    
    
    
    $( "#spinner" ).spinner();
    
    
    
    $( "#menu" ).menu();
    
    
    
    $( "#tooltip" ).tooltip();
    
    
    
    $( "#selectmenu" ).selectmenu();
    
    
    // Hover states on the static widgets
    $( "#dialog-link, #icons li" ).hover(
    function() {
        $( this ).addClass( "ui-state-hover" );
    },
    function() {
        $( this ).removeClass( "ui-state-hover" );
    }
    );
    </script>
    
    <script>
		$(function() {
			$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
			$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
		});
    </script>
    
    <script>
    $(function() {
    $( "#tabs" ).tabs({
      event: "mouseover"
    });
    });
    </script> 
    
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jssor.slider.min.js"></script>
    <script>
        jssor_1_slider_init = function() {
            
            var jssor_1_options = {
              $AutoPlay: false,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Cols: 9,
                $SpacingX: 3,
                $SpacingY: 3,
                $Align: 260
              }
            };
            
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1500);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 10);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        };
    </script>
    <script>
        jssor_1_slider_init();
    </script>
    
	 <script>
      $(function() {
        var availableTags = [
          "ActionScript",
          "AppleScript",
          "Asp",
          "BASIC",
          "C",
          "C++",
          "Clojure",
          "COBOL",
          "ColdFusion",
          "Erlang",
          "Fortran",
          "Groovy",
          "Haskell",
          "Java",
          "JavaScript",
          "Lisp",
          "Perl",
          "PHP",
          "Python",
          "Ruby",
          "Scala",
          "Scheme"
        ];
        $( "#tags" ).autocomplete({
          source: availableTags
        });
      });
      </script>
	  
	  
	
	<!-- Date Picker -->
    <script src="<?php echo base_url(); ?>assets/frontend/js/bootstrap-datepicker.js"></script>
	
	<script>
		$('.datepicker').datepicker()
	</script>
	
	  
	<!-- Mega Navigation Munu js -->
	
	<script type="text/javascript" charset="utf-8">window.ctSell=window.ctSell||{};ctSell.Context={"page":null,"data":{"is_mobile":false,"locale_settings":{"language":{"code":"en-US","id":0,"name":"English (US)","translation":"English (US)","is_detected":false,"is_default":true},"currency":{"currency_id":840,"code":"USD","name":"United States Dollar","number_precision":2,"symbol":"$","listing_enabled":true,"browsing_enabled":true,"buyer_location_restricted":false,"rate_updates_enabled":true,"is_detected":false,"is_default":true},"region":{"code":"XX","name":"Everywhere","translation":"Everywhere","is_detected":false,"is_default":true,"is_EU_region":false},"subdir_code":""},"should_auto_redirect":false,"category_nav_data":{"responsive_enabled":false,"nav_type":"hover","full_render":false}},"config":[],"feature":{"intelligent_item_reporter_overlay":true,"sendreport":true,"fei_fontloader":false,"localization.currency_library":true,"perf_navigator_sendbeacon":true,"perf_send_perf_beacon":true,"disable_old_frontend_logger":true,"localization.remove_locale_nag":true,"localization.locale_prefs_check":true,"search.new_spell_correction":false,"localization.no_currency_code":true,"vesta_homepage.dark_load.signed_out":false},"variant":{"fei_fontloader":false},"locale":{"decimal_point":".","thousands_sep":",","int_curr_symbol":"","currency_symbol":"","mon_decimal_point":"","mon_thousands_sep":"","positive_sign":"","negative_sign":"","int_frac_digits":127,"frac_digits":127,"p_cs_precedes":127,"p_sep_by_space":127,"n_cs_precedes":127,"n_sep_by_space":127,"p_sign_posn":127,"n_sign_posn":127,"grouping":[3,3],"mon_grouping":[]}};</script>

	<div id="locale_overlay_container"></div>

	<script type="text/javascript">
		ctSell.performance = ctSell.performance || {};
		ctSell.performance.firstAnimationFrameFired = -1;
		// normalize requestAnimationFrame across user agents
		!function(){
			var vendors = ['ms', 'moz', 'webkit', 'o'];
			for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
				 window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
			}
		}();
		if (window.requestAnimationFrame) {
			requestAnimationFrame(function(){
				ctSell.performance.firstAnimationFrameFired = new Date().getTime();
			});
		}
	</script> 

	<script>if(window.performance && window.performance.mark){window.performance.mark('timer_loadstart_jquery');}</script> 
	<!--<script src="<?php echo base_url(); ?>assets/frontend/megamenu/require-jquery.js" type="text/javascript" crossorigin=""></script>-->
	
	
	<!-- Mega Menu JS End -->
        
        
	  
	  <script type="text/javascript">
		$(document).ready(function() {
		 
			if(window.File && window.FileList && window.FileReader) {
				$("#files1").on("change",function(e) {
				var files = e.target.files ,
				filesLength = files.length ;
				for (var i = 0; i < filesLength ; i++) {
				var f = files[i]
				var fileReader = new FileReader();
				fileReader.onload = (function(e) {
				var file = e.target;
				$("<img></img>",{
				class : "imageThumb",
				id	 : "thumb1",
				src : e.target.result,
				title : file.name
				}).insertAfter("#files1");
				});
				fileReader.readAsDataURL(f);
				}
				});
				
				
				
				$("#files2").on("change",function(e) {
				var files = e.target.files ,
				filesLength = files.length ;
				for (var i = 0; i < filesLength ; i++) {
				var f = files[i]
				var fileReader = new FileReader();
				fileReader.onload = (function(e) {
				var file = e.target;
				$("<img></img>",{
				class : "imageThumb",
				id	 : "thumb2",
				src : e.target.result,
				title : file.name
				}).insertAfter("#files2");
				});
				fileReader.readAsDataURL(f);
				}
				});
				
				$("#files3").on("change",function(e) {
				var files = e.target.files ,
				filesLength = files.length ;
				for (var i = 0; i < filesLength ; i++) {
				var f = files[i]
				var fileReader = new FileReader();
				fileReader.onload = (function(e) {
				var file = e.target;
				$("<img></img>",{
				class : "imageThumb",
				id	 : "thumb3",
				src : e.target.result,
				title : file.name
				}).insertAfter("#files3");
				});
				fileReader.readAsDataURL(f);
				}
				});
				
				$("#files4").on("change",function(e) {
				var files = e.target.files ,
				filesLength = files.length ;
				for (var i = 0; i < filesLength ; i++) {
				var f = files[i]
				var fileReader = new FileReader();
				fileReader.onload = (function(e) {
				var file = e.target;
				$("<img></img>",{
				class : "imageThumb",
				id	 : "thumb4",
				src : e.target.result,
				title : file.name
				}).insertAfter("#files4");
				});
				fileReader.readAsDataURL(f);
				}
				});
				
				$("#files5").on("change",function(e) {
				var files = e.target.files ,
				filesLength = files.length ;
				for (var i = 0; i < filesLength ; i++) {
				var f = files[i]
				var fileReader = new FileReader();
				fileReader.onload = (function(e) {
				var file = e.target;
				$("<img></img>",{
				class : "imageThumb",
				id	 : "thumb5",
				src : e.target.result,
				title : file.name
				}).insertAfter("#files5");
				});
				fileReader.readAsDataURL(f);
				}
				});
				
				$("#files6").on("change",function(e) {
				var files = e.target.files ,
				filesLength = files.length ;
				for (var i = 0; i < filesLength ; i++) {
				var f = files[i];
				var fileReader = new FileReader();
				fileReader.onload = (function(e) {
				var file = e.target;
				$("<img></img>",{
				class : "imageThumb6",
				id	 : "thumb6",
				src : e.target.result,
				title : file.name
				}).insertAfter("#files6");
				});
				fileReader.readAsDataURL(f);
				}
				});
			} else { alert("Your browser doesn't support to File API") }
		});
	 
	</script>
	  
	<script type="text/javascript">
		
		/*document.getElementById("uploadBtn1").onchange = function () {
			//document.getElementById("uploadFile1").value = this.value;
			//document.getElementById("uploadFile2").value = this.value;
			var reader = new FileReader();
			
			reader.onload = function (b) {
				// get loaded data and render thumbnail.
				document.getElementById("imagePreview1").src = b.target.result;
			};
			
			// read the image file as a data URL.
			reader.readAsDataURL(this.files[0]);
		};
				
		document.getElementById("uploadBtn2").onchange = function () {
			//document.getElementById("uploadFile2").value = this.value;
			var reader = new FileReader();
			
			reader.onload = function (b) {
				// get loaded data and render thumbnail.
				document.getElementById("imagePreview2").src = b.target.result;
			};
			
			// read the image file as a data URL.
			reader.readAsDataURL(this.files[0]);
		};
		
		
		document.getElementById("uploadBtn3").onchange = function () {
			//document.getElementById("uploadFile3").value = this.value;
			var reader = new FileReader();
			
			reader.onload = function (c) {
				// get loaded data and render thumbnail.
				document.getElementById("imagePreview3").src = c.target.result;
			};
			
			// read the image file as a data URL.
			reader.readAsDataURL(this.files[0]);
		};*/
	</script>
      
	
	<script src="<?php echo base_url(); ?>assets/frontend/js/modernizr.custom.17475.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.elastislide.js"></script>
    <script type="text/javascript">
        
        $( '#carousel' ).elastislide();
			
		$('.paypal').click(function() {
			$('.paypalinfo').show("slow");
			$('.creditcardinfo').hide("slow");
		});
		
		$('.creditcard').click(function() {
			$('.paypalinfo').hide("slow");
			$('.creditcardinfo').show("slow");
		});
        
    </script>
	
	
	
	<script>
		// Signin & Register tab open/close
		
		$(document).ready(function(){
			
			$(".registerm").click(function(){
				$("#register").addClass("active");
				$(".tab-pane.registr").addClass("active");
				
				$("#signin").removeClass("active");
				$(".tab-pane.signi").removeClass("active");
				
				$("#forgotp").removeClass("active");
				$(".tab-pane.forgot").removeClass("active");
			});
			
			$(".signin").click(function(){
				$("#register").removeClass("active");
				$(".tab-pane.registr").removeClass("active");
				
				$("#signin").addClass("active");
				$(".tab-pane.signi").addClass("active");
				
				$("#forgotp").removeClass("active");
				$(".tab-pane.forgot").removeClass("active");
			});
			
			$(".forgotp").click(function(){
				$("#register").removeClass("active");
				$(".tab-pane.registr").removeClass("active");
				
				$("#signin").removeClass("active");
				$(".tab-pane.signi").removeClass("active");
				
				$("#forgotp").addClass("active");
				$(".tab-pane.forgot").addClass("active");
			});
			
		});
		
		
	
	
		$("#add").click(function(){

		   var newLabel = $("#optionInput").val();
				
		   if (!newLabel) return; //avoid adding empty checkboxes
		   //var newOption = '<div class="checkbox"><label><input type="checkbox">' + newLabel +'</label></div>';
		  
		   var newOption = '<div class="variation-fields"> <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><input type="text" name="coloroptionname[]" value='+ newLabel +' /> </div> <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <p> <b class="pull-right remove"> <span class="fa fa-remove"></span> </b> </p> </div> </div>';   
				
		   $(".new-option-content").append(newOption);
			
		   $("#optionInput").val(''); //clearing value

		});
			
		
		
		$("#add2").click(function(){

		   var newLabel = $("#optionInput2").val();
				
		   if (!newLabel) return; //avoid adding empty checkboxes
		   //var newOption = '<div class="checkbox"><label><input type="checkbox">' + newLabel +'</label></div>';
		  
		   var newOption = '<div class="variation-fields"> <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <input type="text" name="sizeoptionname[]" value="'+ newLabel +'" /></b></div><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><input type="text" id="pric" name="pricing[]" value="0.00" /></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><p><b class="pull-left remove"><span class="fa fa-remove"></span></b></p></div></div>';   
				
		   $(".new-option-content2").append(newOption);
			
		   $("#optionInput2").val(''); //clearing value

		});
			
		
		
		$("#add3").click(function(){

		   var newLabel = $("#optionInput3").val();
				
		   if (!newLabel) return; //avoid adding empty checkboxes
		  
		   var newOption = '<div class="variation-fields"> <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"> <input type="text" name="tags[]" value="'+ newLabel +'" /></b></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><p><b class="pull-right remove"><span class="fa fa-remove"></span></b></p></div></div>';   
				
		   $(".new-option-content3").append(newOption);
			
		   $("#optionInput3").val(''); //clearing value

		});
		
		
		$("#add4").click(function(){

		   var newLabel = $("#optionInput4").val();
				
		   if (!newLabel) return; //avoid adding empty checkboxes
		  
		   var newOption = '<div class="variation-fields"> <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"> <input type="text" name="materials[]" value="'+ newLabel +'" /></b></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><p><b class="pull-right remove"><span class="fa fa-remove"></span></b></p></div></div>';   
				
		   $(".new-option-content4").append(newOption);
			
		   $("#optionInput4").val(''); //clearing value

		});
		
	</script>
	
	
	<!-- Javascript Confirmation -->
	<script type="text/javascript">
		
		function confirmshopDelete() {
		  return confirm('Are you sure want to close your shop?');
		}
		
		function confirmDelete() {
		  return confirm('Are you sure want to delete?');
		}
		
		function confirmArchive() {
		  return confirm('Are you sure want to archive?');
		}
		
		function confirmUpdate() {
		  return confirm('Are you sure want to update this?');
		}
		
		function confirmActive() {
		  return confirm('Are you sure want to Active this?');
		}
		
		function confirmDeactive() {
		  return confirm('Are you sure want to Deactive this?');
		}
		
		function confirmRenew() {
		  return confirm('Are you sure want to Renew this?');
		}
		
		function confirmcheckout() {
		  return confirm('Are you sure want to checkout this?');
		}
		
		function confirmbillpay() {
		  return confirm('Are you sure want to bill pay?');
		}

	</script>
	
	
	<!-- Check all Or Uncheck all -->							
	<script type="text/javascript">
		
		$("#checkAll").change(function () {
			
			$("input#renewalpid").prop('checked', $(this).prop("checked"));
			
		});
		
	</script>
	
	
	<!-- Checked number count  -->							
	<script type="text/javascript">
		
		$(document).ready(function(){

			var $checkboxes = $('#devel-generate-content-form td input[type="checkbox"]');
				
			$checkboxes.change(function(){
				var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
				// $('#count-checked-checkboxes').text(countCheckedCheckboxes);
				
				$('#edit-count-checked-checkboxes').val(countCheckedCheckboxes);
				
				
				$('#totlItems').val(countCheckedCheckboxes);
				
				var tt = countCheckedCheckboxes*<?php echo listingfee(); ?>;
				if(totlItems > 5){
					var listingfee = tt.toPrecision(3);
				}else{
					var listingfee = tt.toPrecision(2);
				}
				
				$('#totl').val(listingfee);
				
			});

		});
		
	</script>
	

<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.slicknav.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#nav').slicknav();
	});
</script><!--slicknav-->
	
	<script>
		
		$(document).ready(function(){
			
			$('#msg').fadeOut(3000);
			
		});
		
	</script>
	
	
</body>
</html>

<?php
	/* the content */
	ob_get_contents();  //gets the contents of the output buffer 
	ob_end_flush(); // Send the output and turn off output buffering
?>