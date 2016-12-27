<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>

    
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/mailbox.css" />
	
	<script type="text/javascript" src='//cdn.tinymce.com/4/tinymce.min.js'></script>
	  <script type="text/javascript">
	  tinymce.init({
		selector: '#myTextarea',
		theme: 'modern',
		width: '100%',
		menubar:false,
		toolbar:false,
		height: 280,
		plugins: [
		  'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor'
		],
		content_css: 'css/content.css'
		/*,
		toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'*/
	  });
	  </script>
	  
	  
	
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head &gt; link').filter(':first').replaceWith('&lt;link rel="stylesheet" href="'+ css +'" type="text/css" /&gt;'); 
            else $('head &gt; link').filter(':first').replaceWith(defaultCSS); 
        }
        
		
		/* Javascript Check All AND Uncheck All */
		
		function checkAll(ele) {
			var checkboxes = document.getElementsByTagName('input');
			if (ele.checked) {
			 for (var i = 0; i < checkboxes.length; i++) {
				 if (checkboxes[i].type == 'checkbox') {
					 checkboxes[i].checked = true;
					 $('#actv1,#actv2').css('color','green');
				 }
			 }
			} else {
			 for (var i = 0; i < checkboxes.length; i++) {
				 console.log(i)
				 if (checkboxes[i].type == 'checkbox') {
					 checkboxes[i].checked = false;
					 $('#actv1,#actv2').css('color','#afafaf');
				 }
			 }
			}
		}
		
		function checkSingle(ele) {
			var checkboxes = document.getElementsByTagName('input');
			if (ele.checked) {
			 for (var i = 0; i < checkboxes.length; i++) {
				 if (checkboxes[i].type == 'checkbox') {
					 checkboxes.checked = true;
					 $('#actv1,#actv2').css('color','green');
				 }
			 }
			} else {
			 for (var i = 0; i < checkboxes.length; i++) {
				 console.log(i)
				 if (checkboxes[i].type == 'checkbox') {
					 checkboxes.checked = false;
					 $('#actv1,#actv2').css('color','#afafaf');
				 }
			 }
			}
		}
		
		
    </script>


<div id="inner_page"><!-- Begin: inner_page -->

	<div class="userfav_wrapper">
    	<div class="container">
            <div class="row">
                <div class="user_favorite"><!-- Begin: user_hi -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                        <div class="row">
                            
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                
								<div class="user_name2"><!-- Begin: user_name2 -->
                                    
									<p class="user_name2_h3">
										<i class="fa fa-envelope" style="color:#FF712D;"></i> 
										
										<?php
											echo $breadcrumb;
										?>
									</p>
									
                                </div><!-- End: user_name2 -->
								
                            </div>
							
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                <div class="purchage_list"><!-- Begin: purchage_list -->
                                    
									
									<!--form class="pull-right position" action="#">
									  
										<div class="input-append">
											<input type="text" placeholder="Search Mail" class="sr-input">
											<button type="button" class="btn sr-btn"><i class="fa fa-search"></i></button>
										</div>
									  
									</form-->
									
									
                                </div><!-- End: purchage_list -->
                            </div>
                        </div>
                        
                    </div>  
                </div><!-- End: user_hi -->
            </div>
        </div>
    </div>

	
	
	<div class="container">
	
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet prefetch">
	
	 <div class="mail-box">
		<aside class="sm-side">
		  
		  <div class="user-head">
				
				<a href="javascript:;" class="inbox-avatar">
					
					<img src="<?php echo base_url(); ?>assets/frontend/images/<?php if($this->session->userdata('user_picture') == NULL ){echo 'users/userprofile.png'; }else{ echo 'users/'.$this->session->userdata('user_picture');} ?>" class="img-responsive img-circle" alt="<?php echo $this->session->userdata('displayname'); ?> <?php echo sitename(); ?> profile picture" width="64" hieght="60" />
				
				</a>
				
				<div class="user-name">
				  
				  <h5>
					<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $this->session->userdata('userid'); ?>">
						<?php echo $this->session->userdata('displayname'); ?>
					</a>
				  </h5>
				  
				  <span>
					<a href="javascript:;"><?php echo $this->session->userdata('useremail'); ?></a>
				  </span>
				  
				</div>
				
				
		  </div>
		  
		  <div class="inbox-body">
			  
			  <a class="btn btn-compose" title="Compose" data-toggle="modal" href="#myModal">
				  
				  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				  Compose Message
				  
			  </a>
			  
			  <!-- Modal -->
			  <div style="display: none;" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					  <div class="modal-content">
						  
						  <div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							  
							  <h4 class="modal-title">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								New conversation
							  </h4>
							  
						  </div>
						  
						  <div class="modal-body">
							  <form class="form-horizontal" role="form">
								  
								  <div class="form-group">
									  
									  <label class="col-lg-2 control-label">With </label>
									  
									  <div class="col-lg-10">
										  <input type="text" class="form-control" id="inputEmail1" placeholder="Contact's username" />
									  </div>
									  
								  </div>
								  
								  
								  <div class="form-group">
									  <label class="col-lg-2 control-label">Subject</label>
									  <div class="col-lg-10">
										  <input type="text" class="form-control" id="inputPassword1" placeholder="">
									  </div>
								  </div>
								  
								  <div class="form-group">
									  <label class="col-lg-2 control-label">Message</label>
									  <div class="col-lg-10">
										  <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
									  </div>
								  </div>

								  <div class="form-group">
									  <div class="col-lg-offset-2 col-lg-10">
										  
										  <span class="btn green fileinput-button">
											<i class="fa fa-plus fa fa-white"></i>
											<span>Attachment</span>
											<input type="file" multiple="" name="files[]">
										  </span>
										  
										  <button type="submit" class="btn btn-send">Send</button>
										  <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-default">Cancel</button>
										  
									  </div>
								  </div>
							  </form>
						  </div>
					  </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
			  </div><!-- /.modal -->
		  </div>
		  
		  
			<ul class="inbox-nav inbox-divider">
			  
				<li class="active">
				  
				  <a href="<?php echo base_url(); ?>page/user/messages/<?php echo $this->session->userdata('userid'); ?>">
					<i class="fa fa-inbox"></i> Inbox 
				  </a>

				</li>
			  
				<li>
				  <a href="<?php echo base_url(); ?>page/user/sentmessages/<?php echo $this->session->userdata('userid'); ?>">
					<i class="fa fa-envelope-o"></i> Sent Mail
				  </a>
				</li>
			  
				<li>
				  <a href="<?php echo base_url(); ?>page/user/unreadmessages/<?php echo $this->session->userdata('userid'); ?>">
					<i class="fa fa-book"></i> Unread Mail
				  </a>
				</li>
			  
				<li>
				  <a href="<?php echo base_url(); ?>page/user/archivedmessages/<?php echo $this->session->userdata('userid'); ?>">
					<i class="fa fa-archive"></i> Archived Mail
				  </a>
				</li>
			  
				<!--li>
				  <a href="<?php //echo base_url(); ?>page/user/trashmessages/<?php //echo $this->session->userdata('userid'); ?>">
					<i class=" fa fa-trash-o"></i> Trash
				  </a>
				</li-->
			  
			</ul>
		  

		</aside>
		
		
		<aside class="lg-side">
		  <div class="inbox-head">
			  
			  <h4>
				<i class="fa fa-bars"></i> 
				<?php
					
					extract($messageHistory);
					
					if($senderid == $this->session->userdata('userid')){
						$uuuid = $receiverid;
						$receipentid = $receiverid; // That means Get Oposit Receipent Id
					}else{
						$uuuid = $senderid;
						$receipentid = $senderid; // That means Get Oposit Receipent Id
					}
					
					$sqlGetReceiverName = $this->db->query("select userid,display_name from mega_users where userid=$uuuid");
					$sqlFetchReceiverName = $sqlGetReceiverName->row_array();
					extract($sqlFetchReceiverName);
					
					$dsp_name = $display_name;
					
					echo $msgtitle;
					
				?>
				
				<br/>
				
				<i class="betweentwo">
					<i class="fa fa-user"></i>
					Conversation between you and 
					<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $uuuid; ?>">
						<?php echo $dsp_name; ?>
					</a>
				</i>
				
			  </h4>
			  
		  </div>
		  
		  
			<div class="inbox-body">
			 
				<table class="table table-inbox table-hover">
				
					<tbody>
						
						<tr class="<?php if($this->session->userdata('userid') == $senderid){ echo 'yesIm'; } ?> <?php if($msgstatus == 'unread'){ echo 'unread'; }else{ echo ''; } ?>">
							
							<td class="inbox-small-cells">
							
								<?php
								
								$sqlGetSenderName = $this->db->query("select user_picture,userid,display_name from mega_users where userid=$senderid");
								$sqlFetchSenderName = $sqlGetSenderName->row_array();
								extract($sqlFetchSenderName);
									
									// Check for userpicture NULL or Not
									if(!empty($user_picture222)){
										$upic = $user_picture;
									}else{ $upic = 'default-avatar.v9899025-75x75.gif'; }
									
								?>
								
								<img class="img-circle" width="40" height="40" src="<?php echo base_url(); ?>assets/frontend/images/users/<?php echo $upic; ?>" alt="<?php echo $display_name; ?> Profile Picture">
								
							</td>
							
							<td width="15%" class="view-message <?php if($msgstatus == 'unread'){ echo 'dont-show'; }else{ echo 'msg-show'; } ?>">
								
								<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $senderid; ?>">
								
								<?php echo $display_name; ?>
								
								</a>
								
							</td>
							
							<td width="50%" class="view-message "><?php echo $message; ?></td>
							<td class="view-message  inbox-small-cells">
								
								<a href="<?php echo base_url(); ?>assets/frontend/images/messagefiles/<?php echo $msgfile; ?>" target="_blank">
								
									<?php
										if($msgfile !== ''){
									?>
									<img class="img-thumbnail" width="70" height="70" src="<?php echo base_url(); ?>assets/frontend/images/messagefiles/<?php echo $msgfile; ?>">
									<?php
										}else{ /*Nothing*/ }
									?>
									
								</a>
							</td>
							
							<td class="view-message text-right">
								<?php echo $msgdate; ?><br/>
								<i><?php echo $msgdatetime; ?></i>
							</td>
						</tr>
						
						
						<?php
							$sqlGetMsgHistory = $this->db->query("select * from mega_message where refid=$conversationid");
							$sqlFetchMsgHistory = $sqlGetMsgHistory->result();
							
							foreach($sqlFetchMsgHistory as $msgRwsult){
								
								$sssenderid1 = $msgRwsult->senderid;
								
								$sssenderid2 = $msgRwsult->receiverid;
								
								if($sssenderid1){
									$sqlGetSenderName2220 = $this->db->query("select user_picture,userid,display_name from mega_users where userid=$sssenderid1");
								}
								
									$sqlFetchSenderName2220 = $sqlGetSenderName2220->row_array();
									extract($sqlFetchSenderName2220);
								
								$uuuserid = $userid;
								$user_picture222 = $user_picture;
								$dispName = $display_name;
						?>
						
						<tr class="<?php if($this->session->userdata('userid') == $uuuserid){ echo 'yesIm'; } ?> <?php if($msgRwsult->msgstatus == 'unread' and $this->session->userdata('userid') !== $uuuserid){ echo 'unread'; }else{ echo ''; } ?>">
							
							<td class="inbox-small-cells">
							
								<?php
									// Check for userpicture NULL or Not
									if(!empty($user_picture222)){
										$upic222 = $user_picture222;
									}else{ $upic222 = 'default-avatar.v9899025-75x75.gif'; }
								?>
								
								<img class="img-circle" width="40" height="40" src="<?php echo base_url(); ?>assets/frontend/images/users/<?php echo $upic222; ?>" alt="<?php echo $dispName; ?> Profile Picture">
								
							</td>
							
							<td class="view-message <?php if($msgRwsult->msgstatus == 'unread'){ echo 'dont-show'; }else{ echo 'msg-show'; } ?>">
								<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $uuuserid; ?>">
								
								<?php echo $dispName; ?>
								
								</a>
							</td>
							<td width="50%" class="view-message "><?php echo $msgRwsult->message; ?></td>
							<td class="view-message inbox-small-cells">
								<?php
									if($msgRwsult->msgfile !== ''){
								?>
									<a href="<?php echo base_url(); ?>assets/frontend/images/messagefiles/<?php echo $msgRwsult->msgfile; ?>" target="_blank">
									
									<?php
										$fileN = findFileExtension($msgRwsult->msgfile);
										if($fileN === 'png' || $fileN === 'jpg' || $fileN === 'jpeg' || $fileN === 'gif'){ 
									?>
									
									<img class="img-thumbnail" width="70" height="70" src="<?php echo base_url(); ?>assets/frontend/images/messagefiles/<?php echo $msgRwsult->msgfile; ?>">
									
									<?php }else{ ?>
									
									<img class="img-thumbnail" width="70" height="70" src="<?php echo base_url(); ?>assets/frontend/images/file-check.png">
									
									<?php } ?>
									
									</a>
								<?php
									}else{ /*Nothing*/ }
								?>
								
							</td>
							
							<td class="view-message text-right">
								<?php echo $msgRwsult->msgdate; ?><br/>
								<i><?php echo $msgRwsult->msgdatetime; ?></i>
							</td>
						</tr>
						
						<?php } ?>
						
						
						<?php
							
							$u888id = $this->session->userdata('userid');
							
							$sqlGetSenderName888 = $this->db->query("select user_picture,userid,display_name from mega_users where userid=$u888id");
								
							$sqlFetchSenderName888 = $sqlGetSenderName888->row_array();
							extract($sqlFetchSenderName888);
							
							$uuupic888 = $user_picture;
							// Check for userpicture NULL or Not
								if(!empty($uuupic888)){
									$upic888 = $uuupic888;
								}else{ $upic888 = 'default-avatar.v9899025-75x75.gif'; }
								
							$displyName888 = $display_name;
							
						?>
					  
						<tr class="">
							<td class="inbox-small-cells">
								<img class="img-circle" width="40" height="40" src="<?php echo base_url(); ?>assets/frontend/images/users/<?php echo $upic888; ?>" alt="<?php echo $displyName888; ?> Profile Picture">
							</td>
							<td class="view-message dont-show"><?php echo $displyName888; ?></td>
							<td colspan="3" class="view-message" width="50%">
								
								<form class="form-horizontal" method="post" enctype="multipart/form-data" role="form" action="<?php echo base_url(); ?>page/user/messagecontinue/refid/<?php echo $conversationid; ?>/<?php echo $conversationid; ?>">
								
									<input type="hidden" class="form-control" name="msgtitle" value="<?php echo $msgtitle; ?>" />
									
									<input type="hidden" class="form-control" name="senderid" value="<?php echo $this->session->userdata('userid'); ?>" />
									
									<input type="hidden" class="form-control" name="receiverid" value="<?php echo $receipentid; ?>" />
									
									<input type="hidden" class="form-control" name="refid" value="<?php echo $conversationid; ?>" />
								  
									<div class="form-group">
										<div class="col-lg-12">
										  <textarea name="message" id="myTextarea" class="form-control" cols="30" rows="10"></textarea>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12">
										  
											<span class="btn green fileinput-button">
												<i class="fa fa-plus fa fa-white"></i>
												<span>Attachment</span>
												<input type="file" multiple="" name="userfile" />
											</span>
										  
										  <button type="submit" class="btn btn-send">Send</button>
										  
										</div>
									</div>
									
								</form>
								
							</td>
						</tr>
					  
					</tbody>
				</table>
		  </div>
		</aside>
		
		</div>
	</div>

	<?php
		/* server timezone */
		/*define('CONST_SERVER_TIMEZONE', 'UTC');
		$datetime_variable = new DateTime();
		echo $datetime_formatted = date_format($datetime_variable, 'Y-m-d H:i:s');*/
		
	?>
	
    
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>

