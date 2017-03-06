	$.validator.setDefaults({
		submitHandler: function() {
			window.location=document.getElementById('signinfrm').attr('action');
		}
	});
	
	
	$().ready(function() {
		// validate signup form on keyup and submit
		$("#signinfrm").validate({
			rules: {
			   user_email: "required",
			},
			messages: {
				user_email: "Please enter your user name",
			}
		});
		$("#customerLogin").validate({
			rules: {
				chf_nm: "required",
				new_pass: {
					required: true,
					minlength: 6
				},
				confirm_pass: {
					required: true,
					minlength: 6,
					equalTo: "#chng_n"
				},
               get_email: {
					required: true,
					email: true
				},
			   get_password: {
					required: true,
					minlength: 6
				},
			},
			messages: {
				chf_nm: "Please enter your childhood friend",
			   new_pass: {
					required: "Please enter your password",
					minlength: "Password at least 6 digit or character needed"
				},
				confirm_pass: {
					required: "Please enter your password for confirmation",
					minlength: "Password at least 6 digit or character needed",
					equalTo: "Password Do Not Match !"
				},
				get_email: {
					required: "Please enter your email address",
					email: "Please enter valid email"
				},
			   get_password: {
					required: "Please enter your password",
					minlength: "Password at least 6 digit or character needed"
				},
			}
		});
		$("#restPass").validate({
			rules: {
               reset_email: {
					required: true,
					email: true
				},
				ch_fname: {
					required: true
				},
			},
			messages: {
				reset_email: {
					required: "Please enter your email address",
					email: "Please enter valid email"
				},
				ch_fname: {
					required: "Please enter your childhood friend",
				},
			}
		});
		$("#newPass").validate({
			rules: {
               new_password: {
					required: true,
					minlength: 6
				},
				confirm_password: {
					required: true,
					minlength: 6,
					equalTo: "#nPass"
				}
			},
			messages: {
				new_password: {
					required: "Please enter new password",
					minlength: "Password at least 6 digit or character needed"
				},
				confirm_password: {
					required: "Please enter confirm password",
					minlength: "Password at least 6 digit or character needed",
					equalTo: "Password Do Not Match !"
				}
			}
		});
		$("#productInquiry").validate({
			rules: {
               inq_name: "required",
               inq_subject: "required",
               inq_phone: "required",
               inq_message: "required",
			   inq_email: {
					required: true,
					email: true
				},
			},
			messages: {
				inq_name: "Please enter your name",
				inq_subject: "Please enter your subject",
				inq_phone: "Please enter your phone number",
				inq_message: "Please enter your message",
				inq_email: {
					required: "Please enter your email address",
					email: "Please enter valid email"
				}
			}
		});
		$("#checkOutOne").validate({
			rules: {
			   bill_first_name: "required",
			   bill_last_name: "required",
			   bill_phone_number: "required",
			   bill_address: "required",
			   bill_postal_code: "required",
			   bill_username: "required",
			   bill_email: {
					required: true,
					email: true
				},
			   bill_password: {
					required: true,
					minlength: 6
				},
			},
			messages: {
				bill_first_name: "Please enter your first name",
				bill_last_name: "Please enter your last name",
				bill_phone_number: "Please enter your phone number",
				bill_address: "Please enter your address",
				bill_postal_code: "Please enter your postal code",
				bill_username: "Please enter your username",
				bill_email: {
					required: "Please enter your email address",
					email: "Please enter valid email"
				},
			   bill_password: {
					required: "Please enter your password",
					minlength: "Password at least 6 digit or character needed"
				},
			}
		});
		$("#checkOutTwo").validate({
			rules: {
               keep_same: "required",
               ship_receiver_name: "required",
               receiver_phone_number: "required",
               receiver_address: "required",
               receiver_postal_code: "required",
			},
			messages: {
				keep_same: "Please keep your shipping information",
				ship_receiver_name: "Please enter receiver name",
				receiver_phone_number: "Please enter phone number",
				receiver_address: "Please enter receiver address",
				receiver_postal_code: "Please enter postal code",
			}
		});
		$("#checkOutThree").validate({
			rules: {
               shipping_method: "required",
			},
			messages: {
				shipping_method: null,
			}
		});
		$("#checkOutFour").validate({
			rules: {
               payment_method: "required",
			},
			messages: {
				payment_method: null,
			}
		});
		$("#searF").validate({
			rules: {
                keywords_s: "required",
			},
			messages: {
                keywords_s: null,
			}
		});

	});