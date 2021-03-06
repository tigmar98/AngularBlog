var app = angular.module("blogApp", ['ngRoute', 'ngFileUpload']);

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
		.when("/editcategory", {
			controller: "CategoryController",
			templateUrl: "views/editCategory.html"
		})
		.when("/editpost", {
			controller: "PostController",
			templateUrl: "views/editPost.html"
		})
		.when("/changeavatar", {
			controller: "MainController",
			templateUrl: "views/changeAvatar.html"
		})
		.otherwise({
			template: "<h1>The Otherwise works now</h1>"
		})
})