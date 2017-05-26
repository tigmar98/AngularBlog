	app.controller('CategoryController', ['$scope', '$http', '$rootScope', '$window', '$location', 'Category', 'Post', function($scope, $http, $window, $rootScope, $location, Category, Post) { 
    
    $scope.posts = "";
    $scope.message = "";
    $scope.showMessage = false;
    $scope.showLink = false;
    $scope.catId = null;
    $scope.category = "";

    $scope.getCategories = function(){
	  	$http.get('/api/category').then(function(response){
			$scope.categories = response.data.categories	
	    })
    }

    $scope.getCatPost = function(id){
    	$scope.catId = id;
    	$http.get('/api/category/allpost/' + id).then(function(response){
    		$scope.posts = response.data
    		$scope.showLink = true;
    	}) 	
    }

    $scope.deleteCategory = function(id){
    	$http.delete('/api/category/' + id).then(function(response){
    		$scope.showMessage = true;
    		$scope.message = response.data.msg;
    		$scope.getCategories();

    	})
    }

    $scope.deletePost = function(id){
    	$http.delete('/api/post/' + id).then(function(response){
    		$scope.getCatPost($scope.catId);
    		$scope.showMessage = true;
    		$scope.message = response.data.msg;
    	})
    }

    $scope.addCategory = function(){
    	if(typeof $scope.catName !== 'undefined'){
    		$http.post('/api/category', {catName: $scope.catName}).then(function(response){
    			$scope.message = response.data.msg;
    			$scope.showMessage = true;
    			if(response.data.success){
    				$location.path('/');
    			}
    		})
    	}
    }

    $scope.createPost = function(id){
    	Category.catId = id;
    	//console.log(Category)
    	$location.path('/addpost');	
    }

    $scope.editCategory = function(id, category){
    	Category.catId = id;
    	//console.log(Category.catId);
    	$location.path('/editcategory');
    	//$scope.category = category;
    }

    $scope.updateCategory = function(){
    	//console.log(Category.catId);
    	$http.put('/api/updatecategory', {id: Category.catId, category: $scope.category}).then(function(response){
    		$location.path('/')
    		$scope.message = response.data.msg;
    		$scope.showMessage = true;
    		//console.log(response.data)
    	})
    }

    $scope.editPost = function(id, postTopic, post){
    	Post.id = id;
    	Post.postTopic = postTopic;
    	Post.post = post;
    	$location.path('/editpost');
    }

}]);