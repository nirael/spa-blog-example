app.
	config(['$locationProvider','$routeProvider',
		function config($locationProvider,$routeProvider){
			$locationProvider.hashPrefix("!");
			$routeProvider.when('/all',{
				template:"<all></all>"
			})
			.when("/post/:id",{
				template:"<one></one>"
			})
			//.when('/',{
			//	template:"<welcome></welcome>"
			//})
			.when('/post/comments/:id',{
				template:"<comments></comments>"
			})
			.when('/categories/:id',{
				template:"<category></category>"
			})
			.otherwise('/all');
		}])