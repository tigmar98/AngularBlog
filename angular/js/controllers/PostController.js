app.controller('PostController', ['$scope', '$http', '$location', 'Category', 'Post', function($scope, $http, $location, Category, Post) { 

	$scope.addPost = function(){
		var catId = Category.catId;
		$http.post('/api/post/', {postTopic: $scope.postTopic, post: $scope.post, categoriesId: catId}).then(function(response){
			$location.path('/')
			
		})
	}

	$scope.updatePost = function(){
		$http.put('/api/updatepost/', {id:Post.id, postTopic: $scope.postTopic, post:$scope.post}).then(function(response){
			$location.path('/')
		})
	}

}]);