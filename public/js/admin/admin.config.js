app.
	config(['$locationProvider','$routeProvider',
		function config($locationProvider,$routeProvider){
			$locationProvider.hashPrefix("!");
			$routeProvider.when('/categories',{
				template:"<cats></cats>"
			})
			.when('/posts',{
				template:"<posts></posts>"
			})
			.when('/storage',{
				template:"<storage></storage>"
			})
			.otherwise('/categories')
		}])