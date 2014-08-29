$(function () {
			
  loadThePost();
  
  
  /* ======================== BLOG POST SUBMIT ======================== */
  $('#add-post').submit(function() {
	  
	  var theText = $('#bp').val();
	 // var theUserID = $('#userid').val();
		  
		// alert(theUserID);
	
	  if(theText == ''){
		$('#bp').parent().addClass('has-error');
		$('#bp').parent().find('.control-label').text('No Content!').removeClass('hide');
		
		$('#bp').on("keydown",function(){
			$(this).parent().removeClass('has-error');
			$(this).parent().find('.control-label').addClass('hide');
		});
		
	  }else{		
		$.ajax({ 
		type: "POST",
		url: "inc/view.php",
		data: 'postContent='+theText,                        
		  success: function(response){ 
			loadThePost();
		   $('#bp').val('');
		  }
		});
	  }
	 
	  return false;	
  });
	
	 /* ======================== BLOG POST COMMENT SUBMIT ======================== */
  $('body').on('submit','#add-post-comment',function() {
	  
	 $commentField = $(this).find('#p-comment'); 
	 var theComment = $commentField.val();
	 var theBlogId = $(this).find('.blogId').val();
         var isSubmit = false;

	  if(theComment == ''){		
		$commentField.on("keydown",function(){
                    $(this).parent().removeClass('has-error');
                    $(this).parent().find('.control-label').addClass('hide');
		});
		
	  }else{		
		$.ajax({ 
		type: "POST",
		url: "inc/view.php",
		data: 'postComment='+theComment+'&BlogId='+theBlogId,                       
		  success: function(response){
                      loadThePostCommnents(theBlogId);
		      $commentField.val();
		  }
		});
	  }
          
	 
	  return false;	
  });
					 

}); // End of Main Function

	
/* ======================== LOAD THE POST ======================== */
function loadThePost(){
	$.ajax({    //create an ajax request to load_page.php
	type: "GET",
	url: "inc/view.php",
	data: 'thePost=1',             
	dataType: "html",   //expect html to be returned                
		success: function(response){                    
                    $("#blog-container").hide().html(response).fadeIn('fast'); 
		}
	});
}

/* ======================== ADD NEW POST ======================== */
function addNewPost(theText){
	var d = new Date();
	var strDate = ("0" + d.getDate()).slice(-2) + "/" + ("0" + (d.getMonth() + 1)).slice(-2) + "/" + d.getFullYear() ;
	$("#blog-container").parent().scrollTop(0)
	$("#blog-container").prepend('<p class="sha fadeYellow"><span class="post-date">Posted on: '+strDate+' </span>'+theText+'</p>').find('p:first-child').fadeOut(0).fadeIn(500);
	 setTimeout(function(){
            $("#blog-container p:first-child").removeClass('fadeYellow');
      },200);	
}

/* ======================== LOAD THE POST COMMENTS ======================== */
function loadThePostCommnents(bId){
	$.ajax({    //create an ajax request to load_page.php
	type: "GET",
	url: "inc/view.php",
	data: 'loadPostComment=1&blogId='+bId,             
	dataType: "html",               
		success: function(response){                    
                    $("#"+bId).empty().append(response).removeClass('hide'); 
		}
	});
}

