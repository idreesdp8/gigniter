$(document).ready(function(){
    // body...
    $("st-2").hide();
    $("st-3").hide();
    $("st-4").hide();
    $("st-5").hide();



   
   




    // step 1 start from here...
    // step 1 variables
    var error_title = false;
    var error_subtitle = false;
    var error_category = false;
    var error_genre = false;
    var error_img = false;
    var error_gig_address = false;
    var error_goal = false;
    var error_checkbox = false;
    var error_venue = false;
    var error_check_box = false;


    // step 2 variables
    var error_tiername = false;
    var error_ticketprice = false;
    var error_ticketnum = false;
    var error_description = false;
    var error_size = false;
    var error_ticket_img  = false;
    var error_shipping_address = false;
    var error_postal_code = false;
    var error_delivery_date = false;

   // step 3 variables
    var error_fullname = false;
    var error_display_pic = false;
    var error_bio = false;
    var error_location = false;
    var error_website = false;
    var error_facebook = false;
    var error_instagram = false;
    var error_twitter = false;
    var error_cardholder = false;
    var error_cardnumber = false;
    var error_cardcvc = false;
    var error_expirydate = false;

    // step 4 variables
    var error_ = false;
    var error_ = false;
    var error_ = false;
    var error_ = false;
    var error_ = false;
    var error_ = false;
    var error_ = false;
    var error_ = false;
    // step 5 variables

    var error_ = false;
    var error_ = false;
    var error_ = false;
    var error_ = false;
    var error_ = false;
    var error_ = false;
    var error_ = false;

    


    // step 1 Functions...
    $("#title").focusout(function(){
                check_title();
             });

    $("#sub-title").focusout(function(){
                check_sub_title();
            });

    $("#gig-address").focusout(function(){
                check_gig_address();
            });

    $("#goal").focusout(function(){
                check_goal();
            });

    $("#category").focusout(function(){
                check_category();
            });

    $("#genre").focusout(function(){
                check_genre();
            });

    $("#venue").focusout(function(){
                check_venue();
    });

    $("#img_gig").focusout(function(){
                check_img_gig();
            });

    

    


    // step 2 Functions...
     $("#tier-name").focusout(function(){
                check_tier_name();
             });

    $("#ticket-price").focusout(function(){
                check_ticket_price();
             });

    $("#no-tickets").focusout(function(){
                check_no_tickets();
             });

    $("#description").focusout(function(){
                check_description();
             });

    $("#merch-size").focusout(function(){
                check_merch_size();
             });

    $("#ticket-img").focusout(function(){
                check_ticket_img();
             });

    $("#ship-address").focusout(function(){
                check_ship_address();
             });

    $("#post-code").focusout(function(){
                check_post_code();
             });




    // step 3 Functions...
    $("#fullname").focusout(function(){
                check_fullname();
             });

    $("#display-img").focusout(function(){
                check_display_img();
             });

    $("#bio").focusout(function(){
                check_bio();
             });

    $("#location").focusout(function(){
                check_location();
             });

    $("#website").focusout(function(){
                check_website();
             });

    $("#facebook").focusout(function(){
                check_facebook();
             });

    $("#instagram").focusout(function(){
                check_instagram();
             });

    $("#twitter").focusout(function(){
                check_twitter();
             });

    $("#card-holder").focusout(function(){
                check_card_holder();
             });

    $("#card-number").focusout(function(){
                check_card_number();
             });

    $("#cvc").focusout(function(){
                check_cvc();
             });

    $("#month").focusout(function(){
                check_month();
             });

    $("#year").focusout(function(){
                check_year();
             });


    // step 4 Functions...




    // step 5 Functions...

    // step 1 Functions..
    function check_title(){
        var pattern = /^[a-zA-Z]*$/;
        var title = $("#title").val();
        if (pattern.test(title) && title !== ""){
             $("#title").removeClass("error").addClass("good");
            } else {
            $("#title").addClass("error");
            error_title = true;
            }
        }

    function check_sub_title(){
        var subtitle = $("#sub-title").val();
        if (subtitle == ''){
            $("#sub-title").addClass("error");
        } if (subtitle !== ''){
            $("#sub-title").removeClass("error").addClass("good");
            error_subtitle = true;
        }
    }

    function check_gig_address(){
        var gig_address = $("#gig-address").val();
        if (gig_address == ''){
            $("#gig-address").addClass("error");
        } if (gig_address !== ''){
            $("#gig-address").removeClass("error").addClass("good");
            error_gig_address = true;
        }
    }

    function check_goal(){
        var goal = $("#goal").val();
        if (goal == ''){
            $("#goal").addClass("error");
        } if (goal !== ''){
            $("#goal").removeClass("error").addClass("good");
            error_goal = true;
        }
    }

    function check_category(){
        var category = $("#category").val();
        if (category == 'select'){
            $("#category").addClass("error");
        } else{
            $("#category").removeClass("error").addClass("good");
            error_category = true;
        }
    }

    function check_genre(){
        var genre = $("#genre").val();
        if (genre == 'genre'){
            $("#genre").addClass("error");
        } else{
            $("#genre").removeClass("error").addClass("good");
            error_genre = true;
        }
    }

    function check_venue(){
        var venue = $("#venue").val();
        if (venue == 'venue'){
            $("#venue").addClass("error");
        } else{
            $("#venue").removeClass("error").addClass("good");
            error_venue = true;
        }
    }

    function check_img_gig(){
        var img_gig = $("#gig-img").val();
        if (img_gig == ''){
            $("#gig-img").addClass("error");
        } else{
            $("#gig-img").removeClass("error").addClass("good");
            error_img_gig = true;
        }
    }

    




    // step 2 Functions..
    function check_tier_name(){
        var tier_name = $("#tier-name").val();
        if (tier_name == ''){
            $("#tier-name").addClass("error");
        } if (tier_name !== ''){
            $("#tier-name").removeClass("error").addClass("good");
            error_tiername = true;
        }
    }
   function check_ticket_price(){
        var ticket_price = $("#ticket-price").val();
        if (ticket_price == ''){
            $("#ticket-price").addClass("error");
        } if (ticket_price !== ''){
            $("#ticket-price").removeClass("error").addClass("good");
            error_ticketprice = true;
        }
    }    
   function check_no_tickets(){
        var no_tickets = $("#no-tickets").val();
        if (no_tickets == ''){
            $("#no-tickets").addClass("error");
        } if (no_tickets !== ''){
            $("#no-tickets").removeClass("error").addClass("good");
            error_ticketnum = true;
        }
    }

   function check_description(){
        var descrip = $("#description").val();
        if (descrip == ''){
            $("#description").addClass("error");
        } if (descrip !== ''){
            $("#description").removeClass("error").addClass("good");
            error_description = true;
        }
    }

   function check_merch_size(){
        var size = $("#merch-size").val();
        if (size == ''){
            $("#merch-size").addClass("error");
        } if (size !== ''){
            $("#merch-size").removeClass("error").addClass("good");
            error_size = true;
        }
    }

    function check_ticket_img(){
        var ticket_img = $("#ticket-img").val();
        if (ticket_img == ''){
            $("#ticket-img").addClass("error");
        } if (ticket_img !== ''){
            $("#ticket-img").removeClass("error").addClass("good");
            error_ticket_img = true;
        }
    }

    function check_ship_address(){
        var ship_address = $("#ship-address").val();
        if (ship_address == ''){
            $("#ship-address").addClass("error");
        } if (ship_address !== ''){
            $("#ship-address").removeClass("error").addClass("good");
            error_shipping_address = true;
        }
    }

    function check_post_code(){
        var post_code = $("#post-code").val();
        if (post_code == ''){
            $("#post-code").addClass("error");
        } if (post_code !== ''){
            $("#post-code").removeClass("error").addClass("good");
            error_postal_code = true;
        }
    } 



    // step 3 Functions...
   function check_fullname(){
    var fullname = $("#fullname").val();
    if (fullname == '') {
        $("#fullname").addClass("error");
    } if (fullname !== '') {
        $("#fullname").removeClass("error").addClass("good");
    }
   }

   function check_display_img(){
    var displayimg = $("#display-img").val();
    if (displayimg == '') {
        $("#display-img").addClass("error");
    } if (displayimg !== '') {
        $("#display-img").removeClass("error").addClass("good");
    }
   }

   function check_bio(){
    var bio = $("#bio").val();
    if (bio == '') {
        $("#bio").addClass("error");
    } if (bio !== '') {
        $("#bio").removeClass("error").addClass("good");
    }
   }

   function check_location(){
    var location = $("#location").val();
    if (location == '') {
        $("#location").addClass("error");
    } if (location !== '') {
        $("#location").removeClass("error").addClass("good");
    }
   }

   function check_website(){
    var website = $("#website").val();
    if (website == '') {
        $("#website").addClass("error");
    } if (website !== '') {
        $("#website").removeClass("error").addClass("good");
    }
   }

   function check_facebook(){
    var facebook = $("#facebook").val();
    if (facebook == '') {
        $("#facebook").addClass("error");
    } if (facebook !== '') {
        $("#facebook").removeClass("error").addClass("good");
    }
   }

   function check_instagram(){
    var instagram = $("#instagram").val();
    if (instagram == '') {
        $("#instagram").addClass("error");
    } if (instagram !== '') {
        $("#instagram").removeClass("error").addClass("good");
    }
   }

   function check_twitter(){
    var twitter = $("#twitter").val();
    if (twitter == '') {
        $("#twitter").addClass("error");
    } if (twitter !== '') {
        $("#twitter").removeClass("error").addClass("good");
    }
   }

   function check_card_holder(){
    var card_holder = $("#card-holder").val();
    if (card_holder == '') {
        $("#card-holder").addClass("error");
    } if (card_holder !== '') {
        $("#card-holder").removeClass("error").addClass("good");
    }
   }

   function check_card_number(){
    var card_number = $("#card-number").val();
    if (card_number == '') {
        $("#card-number").addClass("error");
    } if (card_number !== '') {
        $("#card-number").removeClass("error").addClass("good");
    }
   }

   function check_cvc(){
    var cvc = $("#cvc").val();
    if (cvc == '') {
        $("#cvc").addClass("error");
    } if (cvc !== '') {
        $("#cvc").removeClass("error").addClass("good");
    }
   }

   function check_month(){
    var month = $("#month").val();
    if (month == '') {
        $("#month").addClass("error");
    } if (month !== '') {
        $("#month").removeClass("error").addClass("good");
    }
   }

   function check_year(){
    var year = $("#year").val();
    if (year == '') {
        $("#year").addClass("error");
    } if (year !== '') {
        $("#year").removeClass("error").addClass("good");
    }
   }





    // step 4 Functions..



    // step 5 Functions..

   

    // For Basic Info Page Button...step 1
       
    function go_2nd_page(){

        var title = $("#title").val();
        var subtitle = $("#sub-title").val();
        var category = $("#category").val();
        var genre = $("#genre").val();
        var img_gig = $("#gig-img").val();
        var check_box1 = $("#allow-check").val();
        var gig_address = $("#gig-address").val();
        var goal = $(".gig-goal").val();
        var venue = $("#venue").val();

        if (title == '' || subtitle == '' || category == '' || genre == '' || img_gig == '' || gig_address == '' || goal == '' || venue == '') {
            alert("***Form Is not filled Correctly***")
        } else {
        	$(".step-2").addClass("active");
           $("#st-1").fadeOut();
           $("#st-2").fadeIn();
        }
    }

    $(".next").click(function(){
        go_2nd_page();

    });
    

    // For Ticket Tier page Button step 2..

    function go_3rd_page(){
        var tier_name = $("#tier-name").val();
        var ticket_price = $("#ticket-price").val();
        var no_tickets = $("#no-tickets").val();
        var descrip = $("#description").val();
        var size = $("#merch-size").val();
        var ticket_img = $("#ticket-img").val();
        var ship_address = $("#ship-address").val();
        var post_code = $("#post-code").val();

        if (tier_name == '' || ticket_price == '' || no_tickets == '' || no_tickets == '' || descrip == '' || size == '' || ticket_img == '' || ship_address == '' || post_code == '') {
            alert("***Form is not Completed***")
        } else {
            $(".step-3").addClass("active");
           $("#st-2").fadeOut();
           $("#st-3").fadeIn(); 
        }

    }
    $("#next2").click(function(){
           go_3rd_page();
    });
    $("#previous1").click(function(){
        $(this).parents(".step").fadeOut();
        $(this).parents(".step").prev().fadeIn();
    });



    // For About you page Button step 3..
     $("#next3").click(function(){
        var fullname = $("#fullname").val();
        var displayimg = $("#display-img").val();
        var bio = $("#bio").val();
        var location = $("#location").val();
        var links = [$("#website").val(), $("#facebook").val(), $("#instagram").val(), $("#twitter").val(), ];
        var month = $("#month").val();
        var year = $("#year").val();


        if (fullname == '' || displayimg == '' || bio == '' || location == '' || month == '' || year == '' || links == '') {
            alert("***Form is not Completed***")
            
        } else {
        	$(".step-4").addClass("active");
            $("#st-2").hide();
           $("#st-3").hide();
           $("#st-4").fadeIn(); 
        }
     
    });
     $("#previous2").click(function(){
        $(this).parents(".step").fadeOut();
        $(this).parents(".step").prev().fadeIn();
    });



     // For Preview page Button step 4..
      $("#next4").click(function(){
      	$(".step-5").addClass("active");
            $("#st-2").fadeOut();
           $("#st-4").fadeOut();
           $("#st-5").fadeIn(); 
        
           
         
    });
      $("#previous3").click(function(){
        $(this).parents(".step").fadeOut();
        $(this).parents(".step").prev().fadeIn();
    });
    


// For Test links page Buttons step 5..
    
    $("#launch_button").click(function(){
        $("input[type=text]").val('');
        $("step-2, step-3, step-4, step-5").removeClass("active")
        $("#st-5").fadeOut();
        $("#st-1").fadeIn();
    

    });



        

		
				
				




// PREVIEW BUTTON.......

                $("#preview").click(function(){
                	
                    $("#st-4").fadeOut();
                    $("#display-st-1").fadeIn();

                    $("#show-title").val($("#title").val());
                    $("#show-subtitle").val($("#sub-title").val());
                    $("#show-category").val($("#category").val());
                    $("#show-genre").val($("#genre").val());

                    

                    $("#show-gig-address").val($("#gig-address").val());
                    $("#show-goal").val($("#goal").val());
                    $("#show-date").val($("#gig-date").val());
                    $("#show-launchdate").val($("#launchdate").val());
                    $("#show-venue").val($("#venue").val());


                    $("#show-tiername").val($("#tier-name").val());
                    $("#show-price").val($("#ticket-price").val());
                    $("#show-ticketnumber").val($("#no-tickets").val());
                    $("#show-description").val($("#description").val());
                    $("#show-size").val($("#merch-size").val());
                    $("#show-ticketimage").val($("#ticket-img").val());
                    $("#show-shippingaddress").val($("#ship-address").val());
                    $("#show-postalcode").val($("#post-code").val());
                    $("#show-deliverydate").val($("#delivery-date").val());
                    

                    $("#show-name").val($("#fullname").val());
                    $("#show-profilpic").val($("#display-img").val());
                    $("#show-bio").val($("#bio").val());
                    $("#show-location").val($("#location").val());
                    $("#show-website").val($("#website").val());
                    $("#show-facebook").val($("#facebook").val());
                    $("#show-instagram").val($("#instagram").val());
                    $("#show-twitter").val($("#twitter").val());
                    $("#show-cardholder").val($("#card-holder").val());
                    $("#show-cardnumber").val($("#card-number").val());
                    $("#show-cvc").val($("#cvc").val());
                    $("#show-expirydate").val($("#month").val() + $("#year").val());
                    

                });
    
    // preview Images ........
                            $("#gig-img").change(function(event) {
                                readURL(this);    
                                            });
                            function readURL(input) {    
                              if (input.files && input.files[0]) {   
                                var reader = new FileReader();
                                var filename = $("#gig-img").val();
                                filename = filename.substring(filename.lastIndexOf('\\')+1);
                                reader.onload = function(e) {
                                  debugger;      
                                  $('#blah').attr('src', e.target.result);
                                  $('#blah').hide();
                                  $('#blah').fadeIn(500);      
                                               
                                }
                                reader.readAsDataURL(input.files[0]);    
                              } 
                              
                            }


                            $("#ticket-img").change(function(event) {
                                readURLnew(this);    
                                            });
                            
                            function readURLnew(input) {    
                              if (input.files && input.files[0]) {   
                                var reader = new FileReader();
                                var filename = $("#ticket-img").val();
                                filename = filename.substring(filename.lastIndexOf('\\')+1);
                                reader.onload = function(e) {
                                  debugger;      
                                  $('#tick-img').attr('src', e.target.result);
                                  $('#tick-img').hide();
                                  $('#tick-img').fadeIn(500);      
                                               
                                }
                                reader.readAsDataURL(input.files[0]);    
                              } 
                            }
                              
                              $("#display-img").change(function(event) {
                                readURLnew2(this);    
                                            });
                            
                            function readURLnew2(input) {    
                              if (input.files && input.files[0]) {   
                                var reader = new FileReader();
                                var filename = $("#display-img").val();
                                filename = filename.substring(filename.lastIndexOf('\\')+1);
                                reader.onload = function(e) {
                                  debugger;      
                                  $('#disp-img').attr('src', e.target.result);
                                  $('#disp-img').hide();
                                  $('#disp-img').fadeIn(500);      
                                               
                                }
                                reader.readAsDataURL(input.files[0]);    
                              } 
                            }
                
                            $("#okay").click(function(){
                                $("#display-st-1").fadeOut();
                                $("#st-5").fadeIn();
                            });
   

   


         
    
});