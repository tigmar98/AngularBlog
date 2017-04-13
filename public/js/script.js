$(document).ready(function(){

	
	//Edit post
	var post_topic = "",
		post = "";
	$('.edit').click(function(){
		$('.cancelPostEdit').remove();
		$('.editPost').remove();
		$('.delForm').children().css({
			'display': 'inline'
		});
		$('.edit').css({
			'display': 'inline'
		});
		$('.postP').children().attr('contenteditable', 'false');		
		$(this).parent().siblings('.postP').children().attr('contenteditable', 'true');
		$(this).parent().append('<button type="button" class="editPost btn btn-success">Edit</button>');
		$(this).parent().append('<button type="button" class="cancelPostEdit btn btn-warning">Cancel</button>');
		post_topic = $(this).parent().siblings('.postP').find('.post_topic').html();
		post = $(this).parent().siblings('.postP').find('.post').html();
		$(this).css({
			'display': 'none'
		});
		$(this).parent().siblings('.delForm').children().css({
			'display': 'none'
		});

	});

	$('body').delegate('.editPost', 'click', function(){
		$(this).parent().siblings('.postP').find('.post_topic').html(post_topic);
		$(this).parent().siblings('.postP').find('.post').html(post);
		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		})

		post_topic = $(this).parent().siblings('.postP').find('.post_topic').html();
		post = $(this).parent().siblings('.postP').find('.post').html();
		var id = $(this).parent().find('.hidPostId').val();
		//console.log(id);
		$.ajax({
			url: '/postedit/'+id,
			type: 'GET',
			data: {
				post_topic : post_topic,
				post : post 
			}
		});		
		$(this).parent().siblings('.delForm').children().css({
			'display': 'inline'
		});
		$(this).parent().find('.edit').css({
			'display':'inline' 
		});
		$('.cancelPostEdit').remove();
		$('.editPost').remove();
	});

	$('body').delegate('.cancelPostEdit', 'click', function(){
		//console.log(post_topic+ " " +post);

		$(this).parent().siblings('.postP').find('.post_topic').html(post_topic);
		$(this).parent().siblings('.postP').find('.post').html(post);
		$('.postP').children().attr('contenteditable', 'false');
		$(this).parent().siblings('.delForm').children().css({
			'display': 'inline'
		});
		$(this).parent().find('.edit').css({
			'display':'inline' 
		});
		$('.cancelPostEdit').remove();
		$('.editPost').remove();
	});


	//Edit Category
	var newCatName = "";
	$('.editCat').click(function(){
		var catButt = $(this).parent().parent().find('.catButt').html();
		$('.catInp').remove();
		$('.catButt').css({
			'display': 'inline'
		});
		$('.cancelCatEdit').remove();
		$('.catEdit').remove();
		$('.btnDel').css({
			'display':'inline'
		});
		$('.editCat').css({
			'display':'inline'
		});
		$(this).parent().parent().children().first().find('.catButt').css({
			'display': 'none'
		});
		$(this).parent().parent().children().first().append('<input type="text" name="category" class="catInp" placeholder="' + catButt +'">');
		$(this).parent().parent().children().first().append('<button type="button" class="btn btn-warning pull-right cancelCatEdit">Cancel</button>');
		$(this).parent().parent().children().first().append('<button type="button" class="btn btn-success pull-right catEdit">Edit</button>');
		$(this).parent().parent().find('.btnDel').css({
			'display': 'none'
		});
		$(this).css({
			'display': 'none'
		});
	});


	$('body').delegate('.catEdit', 'click', function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		newCatName = $(this).parent().find('.catInp').val();
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
		$('.cancelCatEdit').remove();
		$('.catInp').remove();
		$('.catButt').css({
			'display': 'inline'
		});
		$('.editCat').css({
			'display': 'inline'
		});
		$('.btnDel').css({
			'display': 'inline'
		});
		$(this).remove();

	});

	$('body').delegate('.cancelCatEdit', 'click', function(){
		$('.catInp').remove();
		$('.catEdit').remove();
		$(this).remove();
		$('.catButt').css({
			'display': 'inline'
		});
		$('.editCat').css({
			'display': 'inline'
		});
		$('.btnDel').css({
			'display': 'inline'
		});
	});


});