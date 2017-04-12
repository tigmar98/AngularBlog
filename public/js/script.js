$(document).ready(function(){



	var postTopic = 0,
		postBody = 0;
	$('.edit').click(function(){
		var editButt = $(this);
		$(this).parent().siblings('.postP').children().attr('contenteditable', 'true');
		$(this).parent().append('<button type="button" class="editPost btn btn-success">Edit</button>');
		$(this).parent().append('<button type="button" class="cancelEdit btn btn-warning">Cancel</button>');
		$(this).css({
			'display':'none'
		});
		$(this).parent().siblings('.delForm').children().css({
			'display':'none'
		});

	});

	$('body').delegate('.editPost', 'click', function(){
		postTopic = $(this).parent().siblings('.postP').find('.postTopic').html();
		postBody = $(this).parent().siblings('.postP').find('.postBody').html();
		console.log(postTopic + " " + postBody); 
	});
	$('body').delegate('.cancelEdit', 'click', function(){
		$(this).parent().siblings('.postP').find
	});

});