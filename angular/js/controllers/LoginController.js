app.controller('LoginController', ['$scope', '$http', function($scope, $http) { 
   $scope.inputs = {}
   $scope.data = ""

   $scope.submit = function(inputs){
   		$scope.inputs = inputs;
   
  		$http.post('/api/login', $scope.inputs).then(function(response){
  	 		$scope.data = response.data
  		})
  	}
}]);