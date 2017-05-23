app.factory('Category', function($http){
		return {
			get: function(){
					$http.get('/api/category').then(function(response){
				 		 console.log(response.data);    	
		    		})  
				//var str = "text"
				
			}
		}
		//return "Success"
	})