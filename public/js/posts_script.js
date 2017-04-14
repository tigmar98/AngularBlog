$(document).ready(function(){


	//var can_edit = $(document).querySelectorAll('.can_edit');
	for(var i = 0; i<$('.can_edit').length; i++){
		if($('.can_edit').eq(i).val() == 1){
			//console.log("Can edit" + " " + $('.can_edit').eq(i).val());
			var can_edit = $('.can_edit').eq(i);
			can_edit.parent().find('.del_form').append('<button type="submit" class="btn btn-danger pull-right delete">Delete</button>');
			can_edit.parent().append('<button type="submit" class="btn btn-warning pull-right edit">Edit</button>');	
		}
	}

	//Edit posts
	var post_topic = "",
		post = "",
		id = 0,
		previous_id = "";

	$('.edit').click(function(){
		var parent = $(this).parent();
		
		id = $(this).parent().find('.post_id').val();
		//console.log(post_topic);
		//console.log(post);
		if(typeof previous_id == 'number'){
			$(this).parent().parent().eq(previous_id).find('.post_topic').html(post_topic);
			$(this).aprent().parent().eq(previous_id).find('.post').html(post);
		}
		post_topic = parent.find('.post_topic').html();
		post = parent.find('.post').html();
		$('.delete').css({
			'display': 'inline'
		});
		$('.edit').css({
			'display': 'inline'
		});
		$('.cancel_edit').css({
			'display': 'none'
		});
		$('.edit_post').css({
			'display': 'none'
		});
		$('.post_topic').attr('contenteditable', 'false');
		$('.post').attr('contenteditable', 'false');
		parent.find('.post_topic').attr('contenteditable', 'true');
		parent.find('.post').attr('contenteditable', 'true');
		parent.find('.delete').css({
			'display': 'none'
		});
		$(this).css({
			'display': 'none'
		});
		parent.append('<button type="submit" class="btn btn-warning pull-right cancel_edit">Cancel</button>');
		parent.append('<button type="submit" class="btn btn-success pull-right edit_post">Edit</button>');
		previous_id = $(this).parent().index();
		//console.log(previous_id);	
	});


	$('body').delegate('.edit_post', 'click', function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		post_topic = $(this).parent().find('.post_topic').html();
		post = $(this).parent().find('.post').html();
		console.log(id);
		//console.log(post_topic + " " + post);
		$.ajax({
			url: '/postedit/' + id,
			type: 'GET',
			data: {
				post_topic: post_topic,
				post: post
			},
			success: function(){
				$('.post_topic').attr('contenteditable', 'false');
				$('.post').attr('contenteditable', 'false');
				$('.cancel_edit').remove();
				$('.edit_post').remove();
				$('.delete').css({
					'display': 'inline'
				});
				$('.edit').css({
					'display': 'inline'
				});
				previous_id = "";
			}
		});
	});


	$('body').delegate('.cancel_edit', 'click', function(){
		$(this).parent().find('.post_topic').html(post_topic);
		$(this).parent().find('.post').html(post);
		$('.delete').css({
			'display': 'inline'
		});
		$('.edit').css({
			'display': 'inline'
		});
		$('.post_topic').attr('contenteditable', 'false');
		$('.post').attr('contenteditable', 'false');
		$('.cancel_edit').remove();
		$('.edit_post').remove();
		previous_id = "";
	});

	

})
