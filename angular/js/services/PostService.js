app.factory('Post', function(){
	
	var postTopic = "";
	var post = "";
	var id = null;
	return {
		postTopic: postTopic,
		post: post,
		id: id
	}
})