var app = angular.module("blogApp", ['ngRoute']);

/*app.config(function ($routeProvider){
	$routeProvider
		.when('app/', {
			controller: 'MainController',
			templateUrl: 'views/home.html'
		})
		.otherwise({
			redirectTo: '/'
		})
})
*/

app.config(function($routeProvider){
	$routeProvider
		.when("/", {
			controller: "CategoryController",
			templateUrl: "views/category.html"
		})
		/*.when("/login", {
			controller: "LoginController",
			templateUrl: "views/login.html"
		})*/
		.when("/addcategory", {
			controller: "CategoryController",
			templateUrl: "views/addCategory.html"
		})
		.when("/addpost", {
			controller: "PostController",
			templateUrl: "views/addPost.html"
		})
		.otherwise({
			template: "<h1>The Otherwise works now</h1>"
		})
})