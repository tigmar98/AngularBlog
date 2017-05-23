app.controller('CategoryController', ['$scope', '$http', 'Category', function($scope, $http, Category) { 
    
    // $scope.categories = Category.get()
				// 		    .success(function(data){
				// 		    	return data
				// 		    })
  		$http.get('/api/category').then(function(response){
		  $scope.categories = response.data.categories	

    	})  
}]);