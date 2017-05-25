app.controller('PostController', ['$scope', '$http', '$location', 'Category', function($scope, $http, $location, Category) { 

	$scope.addPost = function(){
		var catId = Category.catId;
		$http.post('/api/post/', {postTopic: $scope.postTopic, post: $scope.post, categoriesId: catId}).then(function(response){
			$location.path('/')
			
		})
	}

}]);