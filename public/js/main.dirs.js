


app.directive('categories',function(){
	return {
		scope:{},
		controller:["$scope",'Category',function catCtrl($scope,Category){
			$scope.categories = Category.all();
		}],
		templateUrl:"/js/templates/cats.html"
	}
})
app.directive('recent',function(){
	return {
		scope:{},
		controller:["$scope",'Post',function recentCtrl($scope,Post){
			$scope.recent = Post.recent();
		}],
		templateUrl:"/js/templates/recent.html"
	}
})
app.directive('searchQuery',function (){
	return {
		scope:{},
		controller:['search','$scope',function recentCtrl(search,$scope){
				$scope.query;
    $scope.changeQuery = function(){
        search.query = $scope.query
		}
	}],
		template:"<div class='nav navbar-form navbar-left'>"+
                            "<input type='text' class='search-field' ng-model='query' ng-blur='changeQuery()'>" +
                           // "<button class='btn-src'>"+
                            "&nbsp;<span style='font-size:1.2em;' class='glyphicon glyphicon-search'></span>&nbsp;"+
                           // "Search</button>" +
                    "</div>"
	}
})
