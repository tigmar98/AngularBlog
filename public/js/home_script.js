$(document).ready(function(){

	
	//Edit post
	var post_topic = "",
		post = "",
		previous_id = "";
	$('.edit').click(function(){
		

		if(typeof previous_id == 'number'){
			$('.post_topic').eq(previous_id).html(post_topic);
			$('.post').eq(previous_id).html(post);
		}
		post_topic = $(this).parent().siblings('.post_p').find('.post_topic').html();
		post = $(this).parent().siblings('.post_p').find('.post').html();
		$('.cancel_post_edit').remove();
		$('.edit_post').remove();
		$('.del_form').children().css({
			'display': 'inline'
		});
		$('.edit').css({
			'display': 'inline'
		});
		$('.post_p').children().attr('contenteditable', 'false');		
		$(this).parent().siblings('.post_p').children().attr('contenteditable', 'true');
		$(this).parent().append('<button type="button" class="edit_post btn btn-success">Edit</button>');
		$(this).parent().append('<button type="button" class="cancel_post_edit btn btn-warning">Cancel</button>');		
		$(this).css({
			'display': 'none'
		});
		$(this).parent().siblings('.del_form').children().css({
			'display': 'none'
		});
		previous_id = $(this).parent().parent().index();

	});

	$('body').delegate('.edit_post', 'click', function(){
		//$(this).parent().siblings('.post_p').find('.post_topic').html(post_topic);
		//$(this).parent().siblings('.post_p').find('.post').html(post);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		post_topic = $(this).parent().siblings('.post_p').find('.post_topic').html();
		post = $(this).parent().siblings('.post_p').find('.post').html();
		var id = $(this).parent().find('.hidPostId').val();
		//console.log(id);
		$.ajax({
			url: '/postedit/' + id,
			type: 'GET',
			data: {
				post_topic : post_topic,
				post : post 
			},
			success: function(){						
				$('.edit_post').parent().siblings('.del_form').children().css({
					'display': 'inline'
				});
				$('.edit_post').parent().find('.edit').css({
					'display':'inline' 
				});
				$('.cancel_post_edit').remove();
				$('.edit_post').remove();
				previous_id = "";
			}
		});		
	});

	$('body').delegate('.cancel_post_edit', 'click', function(){
		//console.log(post_topic+ " " +post);

		$(this).parent().siblings('.post_p').find('.post_topic').html(post_topic);
		$(this).parent().siblings('.post_p').find('.post').html(post);
		$('.post_p').children().attr('contenteditable', 'false');
		$(this).parent().siblings('.del_form').children().css({
			'display': 'inline'
		});
		$(this).parent().find('.edit').css({
			'display':'inline' 
		});
		$('.cancel_post_edit').remove();
		$('.edit_post').remove();
		previous_id = "";
	});


	//Edit Category
	var newCatName = "";
	$('.edit_cat').click(function(){
		var catButt = $(this).parent().parent().find('.catButt').html();
		$('.cat_inp').remove();
		$('.catButt').css({
			'display': 'inline'
		});
		$('.cancel_cat_edit').remove();
		$('.cat_edit').remove();
		$('.btn_del').css({
			'display':'inline'
		});
		$('.edit_cat').css({
			'display':'inline'
		});
		$(this).parent().parent().children().first().find('.catButt').css({
			'display': 'none'
		});
		$(this).parent().parent().children().first().append('<input type="text" name="category" class="cat_inp" placeholder="' + catButt +'">');
		$(this).parent().parent().children().first().append('<button type="button" class="btn btn-warning pull-right cancel_cat_edit">Cancel</button>');
		$(this).parent().parent().children().first().append('<button type="button" class="btn btn-success pull-right cat_edit">Edit</button>');
		$(this).parent().parent().find('.btn_del').css({
			'display': 'none'
		});
		$(this).css({
			'display': 'none'
		});
	});


	$('body').delegate('.cat_edit', 'click', function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		newCatName = $(this).parent().find('.cat_inp').val();
		var id = $(this).parent().parent().find('.hidCatId').val();
		//console.log(newCatName + " " + id);
		$.ajax({
			url: '/categoryedit/'+id,
			type: 'GET',
			data: {
				category : newCatName, 
			},
			success: function(){
				location.reload();
			}
		});
		$('.cancel_cat_edit').remove();
		$('.cat_inp').remove();
		$('.catButt').css({
			'display': 'inline'
		});
		$('.edit_cat').css({
			'display': 'inline'
		});
		$('.btn_del').css({
			'display': 'inline'
		});
		$(this).remove();

	});

	$('body').delegate('.cancel_cat_edit', 'click', function(){
		$('.cat_inp').remove();
		$('.cat_edit').remove();
		$(this).remove();
		$('.catButt').css({
			'display': 'inline'
		});
		$('.edit_cat').css({
			'display': 'inline'
		});
		$('.btn_del').css({
			'display': 'inline'
		});
	});


});