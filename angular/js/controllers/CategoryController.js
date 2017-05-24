app.controller('CategoryController', ['$scope', '$http', function($scope, $http) { 
    
    // $scope.categories = Category.get()
				// 		    .success(function(data){
				// 		    	return data
				// 		    })
  	$http.get('/api/category').then(function(response){
		$scope.categories = response.data.categories	
    })
    $scope.posts = "";
    $scope.message = "";
    $scope.showMessage = false;
    $scope.showLink = false;

    $scope.getCatPost = function(id){

    	$http.get('/api/category/allpost/' + id).then(function(response){
    		$scope.posts = response.data
    		$scope.showLink = true;

    	})
    	
    }

    $scope.deleteCategory = function(id){
    	$http.delete('/api/category/' + id).then(function(response){
    		$scope.showMessage = true;
    		$scope.message = response.data.msg;
    	})
    }

    $scope.deletePost = function(id){
    	$http.delete('/api/post/' + id).then(function(response){
    		//console.log(response.data.msg);
    		$scope.showMessage = true;
    		$scope.message = response.data.msg;
    	})
    }

    $scope.addCategory = function(){
    	if(typeof $scope.catName !== 'undefined'){
    		$http.post('/api/category', {catName: $scope.catName}).then(function(response){
    			$scope.message = response.data.msg;
    			$scope.showMessage = true;
    		})
    	}
    }

}]);