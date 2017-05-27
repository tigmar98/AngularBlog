app.controller('MainController', ['$scope', '$http', '$window', '$location', 'Upload', function($scope, $http, $window, $location, Upload) { 
  
  $scope.userImage = "";

  $http.get('/api/image').then(function(response){
  	$scope.userImage = response.data.src;
  })

  $scope.upload = function(file){
  	if(typeof file !== 'undefined'){
	  	file.upload = Upload.upload({
	  		url: '/api/addimage',
	  		data: {image: file}
	  	})
	  	file.upload.then(function (response){
	  		$scope.message = response.data.msg;
	  	})
  	}
	$window.location.reload()
	$location.path('/')
  }


}]);