app.component('all',{
	templateUrl:"/js/templates/allposts.html",
	controller:['search','Post','HideData',function allController(search,Post,HideData){
	var self = this;
		this.manager = HideData;
		this.search = search
		this.search.query = undefined;
		console.log(this.search.query)
		this.data = Post.all({},function(data,headers){
			self.manager.n = 10;
			self.manager.reset();
			self.manager.points[1] = Math.ceil(data.posts.length/10);
			self.manager.main_data = Array(data)[0].posts;
			self.manager.cur_data = self.manager.main_data.slice(0,10);
		});

	}]
});
app.component('one',{
	templateUrl:"/js/templates/singlepost.html",
	controller:['Comment','Post','$routeParams',function oneController(Comment,Post,$routeParams){
		this.data = Post.one({id:$routeParams.id});
		this.newcomment;
		var self = this;
		this.postcomments = Post.comments({id:$routeParams.id});
		this.sendComment = function(){
			if(this.name && this.email && this.message){
				Comment.new({name:this.name,email:this.email,message:this.message,post_id:$routeParams.id},
					function(data,headers){
					console.log(data)
					self.newcomment = data.comment;
					self.postcomments.comments.push(self.newcomment);
				});	
					//this.postcomments.comments.push(this.newcomment.comment)
			}
			else{
				alert("Fill the fields!")
			}
		}

	} ]
})
app.component('welcome',{
	templateUrl:"/js/templates/welcome.html"
});
app.component('comments',{
	template:"<h5> {{ $ctrl.data }} </h5>",
	controller:['Comment','$routeParams',function comment(Comment,$routeParams){
		this.data = Comment.forpost({id:$routeParams.id})
	}]
})

app.component('category',{
	templateUrl:"/js/templates/allposts.html",
	controller:['search','Category','$routeParams','HideData',function category(search,Category,$routeParams,HideData){
		var self = this;
		this.search = search;
		this.search.query = undefined;
		this.manager = HideData;
		this.n = Category.one({id:$routeParams.id},function(data,headers){
			self.catName = data.cat.name;
		})
		this.data = Category.posts({id:$routeParams.id},function(data,headers){
			if(self.catName){
			self.manager.reset();
			self.manager.n = 5;
			self.manager.points[1] = Math.ceil(data.posts.length/5);
			self.manager.main_data = Array(data)[0].posts;
			self.manager.cur_data = self.manager.main_data.slice(0,5);
		}
		});
	}]
})