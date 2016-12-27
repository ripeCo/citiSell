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
					
					
					<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<h4 class="text-center">
							<?php
								 
								// Success Or Failor check
								if(isset($success_msg)){
									
									echo '<span id="msg" class="text-success"> <i class="fa fa-check-circle"></i> '.$success_msg.' </span><br/>';
									
								}else if(isset($error_msg)){
									
									echo '<span class="text-danger"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </span><br/>';
									
								}
								
							?>
							
						</h4>
					
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
								
								<form class="form-horizontal" method="post" enctype="multipart/form-data" role="form" action="<?php echo base_url(); ?>page/user/messagesend">
								
								
								 
									<div class="form-group">
									  
										<label class="col-lg-2 control-label">With </label>
									  
										<div class="col-lg-10">
										  
										  <input type="email" class="form-control" id="user_email" required="required" name="user_email" placeholder="Contact's user email" />
										  
										  <input type="hidden" class="form-control" name="senderid" value="<?php echo $this->session->userdata('userid'); ?>" />
										  
										</div>
									  
									</div>
								  
								  
								  <div class="form-group">
										<label class="col-lg-2 control-label">Subject</label>
										<div class="col-lg-10">
										  <input type="text" class="form-control" id="msgtitle" name="msgtitle" placeholder="Message Subject">
										</div>
								  </div>
								  
								  
								  <div class="form-group">
										<label class="col-lg-2 control-label">Message</label>
										<div class="col-lg-10">
										  <textarea name="message" id="myTextarea" class="form-control" cols="30" rows="10"></textarea>
										</div>
								  </div>
								  

								  <div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
										  
										  <span class="btn green fileinput-button">
											<i class="fa fa-plus fa fa-white"></i>
											<span>Attachment</span>
											<input type="file" multiple="" name="userfile" />
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
			  
				<li>
				  
				  <a href="<?php echo base_url(); ?>page/user/messages/<?php echo $this->session->userdata('userid'); ?>">
					<i class="fa fa-inbox"></i> Inbox 
				  </a>

				</li>
			  
				<li>
				  <a href="<?php echo base_url(); ?>page/user/sentmessages/<?php echo $this->session->userdata('userid'); ?>">
					<i class="fa fa-envelope-o"></i> Sent Mail
				  </a>
				</li>
			  
				<li class="active">
				  <a href="<?php echo base_url(); ?>page/user/unreadmessages/<?php echo $this->session->userdata('userid'); ?>">
					<i class="fa fa-book"></i> Unread Mail
				  </a>
				</li>
			  
				<li>
				  <a href="<?php echo base_url(); ?>page/user/archivedmessages/<?php echo $this->session->userdata('userid'); ?>">
					<i class="fa fa-archive"></i> Archived Mail
				  </a>
				</li>
			  
				<li>
				  <a href="<?php echo base_url(); ?>page/user/trashmessages/<?php echo $this->session->userdata('userid'); ?>">
					<i class=" fa fa-trash-o"></i> Trash
				  </a>
				</li>
			  
			</ul>
		  

		</aside>
		
		
		<aside class="lg-side">
			<div class="inbox-head">
			  
				<h3> <i class="fa fa-inbox"></i> Unread Messages</h3>
			  
			</div>
		  
		  
		  
			<div class="inbox-body">
				
				<form class="form-horizontal" method="post" role="form" action="<?php echo base_url(); ?>page/user/messagearchiveordelete">
				
				<div class="mail-option">
					<div class="chk-all">
						
						<div class="btn-group">
						
							<input type="checkbox" class="mail-checkbox mail-group-checkbox" onchange="checkAll(this)" name="chk[]" />
							All
							
						</div>
						
					</div>

					<div class="btn-group">
					
						<button type="submit" name="msgdelete" value="Delete" onclick="return confirmDelete();" class="btn mini tooltips actv" id="actv1">
							<i class=" fa fa-trash"></i>
							Delete
						</button>
						
					</div>

					<div class="btn-group">
					
						<button type="submit" name="msgarchive" value="Archive" onclick="return confirmArchive();" class="btn mini tooltips actv" id="actv2">
							<i class=" fa fa-archive"></i>
							Archive
						</button>
						
					</div>
				 
				</div>
			 
			 
				<table width="100%" id="example-table" class="table table-striped table-bordered table-inbox">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Message</th>
							<th>File</th>
							<th>Date</th>
						</tr>
					</thead>
						
						<?php
							
							$receiverid0 = $this->session->userdata('userid');
							
							$sqlGetReceiver = $this->db->query("select * from mega_message where receiverid=$receiverid0 and refid='0' and msgstatus='unread' order by msgdatetime DESC");
							$sqlFetchReceiver = $sqlGetReceiver->result();
								
							foreach($sqlFetchReceiver as $inboxresults){
								
									
								$msgstatus = $inboxresults->msgstatus;
								
								$refid  = $inboxresults->conversationid;
								$sqlGetReceiver54 = $this->db->query("select * from mega_message where refid=$refid order by msgdatetime DESC");
								
								$sqlFetchReceiver54 = $sqlGetReceiver54->row_array();
								if($sqlGetReceiver54->num_rows() > 0){
									extract($sqlFetchReceiver54);
									$msgStstus = $msgstatus;
								}
								
								$usr = $inboxresults->senderid;
								$conversationid = $inboxresults->conversationid;
								
								
								$sqlGetReceiver77 = $this->db->query("select userid,display_name,user_picture from mega_users where userid=$usr");
								$sqlFetchReceiver77 = $sqlGetReceiver77->row_array();
								extract($sqlFetchReceiver77);
		
						?>
						
						<tr class="<?php if($msgstatus == 'read'){ echo ''; }else{ echo 'unread';} ?>">
							
							<td class="inbox-small-cells">
								<input type="checkbox" value="<?php echo $conversationid; ?>" class="mail-checkbox mail-group-checkbox" onchange="checkSingle(this)" name="chkS[]" />
							</td>
							
							<td class="view-message <?php if($msgstatus == 'read'){ echo 'msg-show'; }else{ echo 'dont-show';} ?>">
								
								<a href="<?php echo base_url(); ?>page/user/writemessage/refid/<?php echo $conversationid; ?>/<?php echo $refid; ?>">
									
									<?php
										if(!empty($user_picture)){
											$upic = 'users/'.$user_picture;
										}else{$upic = 'default-avatar.v9899025-75x75.gif';}
									?>
									
									<img class="img-circle" width="30" height="30" src="<?php echo base_url(); ?>assets/frontend/images/<?php echo $upic; ?>" alt="<?php echo ucwords($display_name); ?> Profile picture">
									
									
									<span><?php echo ucwords($display_name); ?></span>
								</a>
								
							</td>
							
							<td class="view-message <?php if($msgstatus == 'read'){ echo 'msg-show'; }else{ echo 'dont-show';} ?>" width="50%">
								
								<a href="<?php echo base_url(); ?>page/user/writemessage/refid/<?php echo $conversationid; ?>/<?php echo $refid; ?>">
									<?php echo $inboxresults->msgtitle; ?> 
								</a>
								
							</td>
							
							<td class="view-message text-center <?php if($msgstatus == 'read'){ echo 'msg-show'; }else{ echo 'dont-show';} ?> inbox-small-cells">
								
								<?php if($inboxresults->msgfile !== 'NO'){ ?> 
								
									<i class="fa fa-paperclip"></i>
								
							<?php } ?>
								
								
							</td>
							
							<td class="view-message <?php if($msgstatus == 'read'){ echo 'msg-show'; }else{ echo 'dont-show';} ?> text-right">
								<?php echo $inboxresults->msgdate; ?><br/>
								<i><?php echo substr($inboxresults->msgdatetime,-9); ?></i>
							</td>
						</tr>
						
						
						<?php } ?>
					  
					</tbody>
				</table>
				
				
				</form>
				
		  </div>
		</aside>
		
		</div>
	</div>

	
	
    
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer2.php'); ?>

