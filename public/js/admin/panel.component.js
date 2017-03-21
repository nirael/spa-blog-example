app.component('cats',{
	templateUrl:'/js/admin/panel-templates/cats.html',
	controller:['Category',function catsCtrl(Category){
		function f(a,val,cb){ a.forEach(function(x,i,z){if(x == val)cb(z,i)})}
		var self = this;
		self.newcatname;
		self.newcatdescription;
		self.newcat = false;
		this.cats = Category.all({},function(data,headers){
			self.categories = Array(data)[0].cats;
			self.maincat;

		});
		this.opennewcat = function(){
			self.newcat = true;
			self.maincat = null;
		}
		this.addnewcat = function(){
			Category.new({
				name:self.newcatname,
				description:self.newcatdescription
			},function(data,headers){
				self.message = data.message
				self.categories.push(data.cat)
			})
		}
		this.savecat = function(){
					Category.update({id:self.maincat.id},{
						name:self.maincat.name,
						description:self.maincat.description
					},function(data,headers){
						self.categories.forEach(function(x,y,z){
							if(x.id == data.cat.id)
								z[y] = data.cat
						})
						self.message = data.message;
					});
		}
		this.choosecat = function(id){
			self.newcat = false;
			Category.one({
				id:id
			},function(data,headers){
				self.maincat = data.cat;
			})
		}
		this.deletecat = function(cat){
			Category.remove({id:cat.id},{},function(data,headers){
				self.message = data.message;
				if(data.y)
					self.categories = self.categories.filter(function(x){return x != cat});
			})
		}
		
	}]
})
app.component('posts',{
	templateUrl:'/js/admin/panel-templates/posts.html',
	controller:['Post','Comment','Category','img','BanList',function postsCtrl(Post,Comment,Category,img,BanList){
		var self = this;
		this.selimg = img.img;
		Category.all({},function(data,headers){
			self.cats = Array(data)[0].cats;
		})
		self.newpostname,self.newpostcontent,self.cat_id;
		self.newpost = false;
		Post.all({},function(data,headers){
			self.posts = Array(data)[0].posts;
			self.mainpost;

		});

		BanList.all({},function(data,headers){
			self.banlist = Array(data.banned[0]);
			console.info(self.banlist);
		});
		BanList.ips({},function(data,headers){
			self.ips = data.ips;
		})
		this.ban = function(x){
			BanList.ban({ip:x.ip},function(a,b){
				console.log(a.r)
			});
			self.banlist.push(x.ip)
		}
		this.unban = function(ip){
			BanList.unban({ip:ip});
			self.banlist = self.banlist.filter(function(a){
				return a != ip;
			})
		}

		this.opennewpost = function(){
			self.newpost = true;
			self.mainpost = null;
			self.postcomments = null;
		}
		this.addnewpost = function(){
			Post.new({
				name:self.newpostname,
				content:self.newpostcontent,
				cat_id:self.cat_id
			},function(data,headers){
				self.message = data.message
				self.posts.push(data.post)
			})
		}
		this.setImg = function(){
			if(!img.img)return;
			var appedix =  "<img class='im' width='" + img.x + "' height='" + img.y + "' src='" + "/storage/images/" + self.selimg + "'><br />"
			if(self.newpost)
				self.newpostcontent += appedix
			if(self.mainpost)
				self.mainpost.content +=  appedix
		}
		this.savepost = function(){
					Post.update({id:self.mainpost.id},{
						name:self.mainpost.name,
						content:self.mainpost.content,
						cat_id:self.mainpost.cat_id
					},function(data,headers){
						self.posts.forEach(function(x,y,z){
							if(x.id == self.mainpost.id){
								x.name = self.mainpost.name
							}
						})
						self.message = data.message;
					});
		}
		this.choosepost = function(id){
			self.message = undefined;
			self.newpost= false;
			Post.one({
				id:id
			},function(data,headers){
				self.mainpost = data.post;
			})
			Post.comments({id:id},function(data,headers){
				self.postcomments = Array(data)[0].comments;
			});
		}
		this.deletepost = function(p){
			Post.remove({id:p.id},{},function(data,headers){
				self.message = data.message;
				if(data.y)
					self.posts = self.posts.filter(function(x){return x != p});
			})
		}

		this.editcomment = function(com){
			Comment.update({id:com.id},{
				name:com.name,
				email:com.email,
				valid:com.valid,
				message:com.message
			},function(data,headers){
				self.message = data.message;
				self.postcomments.forEach(function(x,y,z){
					if(x.id == data.comment.id)
						z[y] = data.comment
				})
			})
		}
		this.deletecomment = function(com){
			Comment.delete({id:com.id},{},function(data,headers){
				self.message = data.message;
				if(data.y)
					self.postcomments = self.postcomments.filter(function(x){return x != com});
			});
		}
	}]
})
app.component('storage',{
	templateUrl:'/js/admin/panel-templates/storage.html',
	controller:['$http','img',function storageCtrl($http,img){
		var self = this;
		this.img = img
		self.selimg = img.img;
		this.uploadFile = function(){
			//console.info('file is');
			//console.dir(this.myfile);

			var uf = "/stadd";
			
            var fd = new FormData();
            fd.append('file',this.myfile);
            var req = {
                    method:"POST",
                    transformRequest:angular.identitiy,
                    headers:{'Content-type':undefined},
            };
                  $http.post(uf,fd,req).then(function(response){
                  					//console.log(response.data.name)
                                    self.images.push(response.data.name)
                  });
   
		}
		$http.get("/getimages").then(function(response){
                        self.images = response.data.images.map(function(x){return x.substr(14)});
      });
		this.deleteImage = function(fname){
			$http.post('/deletefile',{file:fname}).then(function(response){
				self.message = response.data.message;
			})
			self.images = self.images.filter(function(x){return x != fname})
		}
		this.selectImg = function(name){
			img.img = name;
			self.selimg = name
			//img.x = self.x
			//img.y = self.y
		}
	}]
}).directive('fileModel',['$parse',function($parse){
	return{
		restrict:'A',
		link:function(scope,element,attrs){
			var model = $parse(attrs.fileModel);
			var modelSetter = model.assign;

			element.bind('change',function(){
				scope.$apply(function(){
					modelSetter(scope,element[0].files[0]);
				})
			})
		}
	}
}])