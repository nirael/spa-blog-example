app.factory("Post",['$resource',function($resource){
	return $resource('/posts/:id',{},
		{
			one:{
      		method:"GET",
      		params:{},
      		isArray:false
      	},
      	all:{
      		method:"GET",
      		url:'/posts/',
      	},
      	new:{
      		method:"POST",
      		url:"/posts/",
      		params:{
      			name:"",
      			content:"",
      			_method:"POST"
      		},


      	},
      	update:{
      		method:"POST",
      		url:"/posts/:id",
      		params:{
      			name:"",
      			content:"",
      			_method:"PUT"
      		}
      	},
      	remove:{
      	   method:"POST",
      	   "url":"/posts/:id",
      	   params:{
      	   	_method:"DELETE"
      	   }
      	},
      	comments:{
      		method:"GET",
      		url:"/posts/:id/comments"
      	},
      	category:{
      		method:"GET",
      		url:"/posts/:id/category"
      	},
            recent:{
                  method:"GET",
                  url:"/recent"
            }
      	}

     );
}])
app.factory("Category",['$resource',function($resource){
      return $resource('/categories/:id',{},
            {
                  one:{
                  method:"GET",
                  params:{},
                  isArray:false
            },
            all:{
                  method:"GET",
                  url:'/categories/',
            },
            new:{
                  method:"POST",
                  url:"/categories/",
                  params:{
                        name:"",
                        description:"",
                        _method:"POST"
                  },


            },
            update:{
                  method:"POST",
                  url:"/categories/:id",
                  params:{
                        name:"",
                        description:"",
                        _method:"PUT"
                  }
            },
            remove:{
               method:"POST",
               url:"/categories/:id",
               params:{
                  _method:"DELETE"
               }
            },
            posts:{
                  method:"GET",
                  url:"/categories/:id/posts"
            },
         
      }

     );
}])
app.factory("Comment",['$resource',function($resource){
      return $resource('/comments/:id',{},
            {
                  one:{
                  method:"GET",
                  params:{},
                  isArray:false
            },
            all:{
                  method:"GET",
                  url:'/comments/',
            },
            new:{
                  method:"POST",
                  url:"/comments/",
                  params:{
                        name:"",
                        email:"",
                        message:"",
                        parent:0,
                        post_id:0,
                        _method:"POST"
                  },


            },
            update:{
                  method:"POST",
                  url:"/comments/:id",
                  params:{
                        name:"",
                        content:"",
                        _method:"PUT"
                  }
            },
            remove:{
               method:"POST",
               "url":"/comments/:id",
               params:{
                  _method:"DELETE"
               }
            },
            forpost:{
                  method:"GET",
                  url:"/comments/forpost/:id"
            },
         
      }

     );
}])
app.factory("HideData",function(){
      return {
            n:1,
            points:[1,1],
            main_data:null,
            cur_data:null,
            chPage:function(){
                  if(this.points[0] == this.points[1])return;
                  this.points[0]++;
                  this.cur_data = this.main_data.slice(0,this.points[0]*this.n);
            },
            reset:function(){
                  this.points = [1,1]
            },
            all:function(){
                  this.points[0] = this.points[1];
                  this.chPage();
            }

      }
})
app.factory('BanList',['$resource',function($resource){
      return $resource('/banned',{},{
            all:{
                  method:'GET',
            },
            ips:{
                  method:'GET',
                  url:'/ips'
            },
            ban:{
                  method:'POST',
                  params:{ip:null},
                  url:'/ban'
            },
            unban:{
                  method:'POST',
                  params:{ip:null},
                  url:'/unban'
            }
      })
}]);
app.factory('search',function(){
      return {
            query:undefined
      }
})
app.factory('img',function(){
      return {
            img:undefined,
            x:100,
            y:100
      }
})