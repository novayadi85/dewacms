var apps = angular.module('product', ['datatables','thatisuday.dropzone','ngBootstrapLightbox','ngFileUpload','ui.sortable' , 'ui.bootstrap']);
	apps.config(function ($interpolateProvider,dropzoneOpsProvider) {
		$interpolateProvider.startSymbol('<%');
		$interpolateProvider.endSymbol('%>');

		dropzoneOpsProvider.setOptions({
			url : '/upload_url',
			maxFilesize : '10'
		});
	
	});
	var content = {};
	apps.directive('initModel', function($compile) {
		return {
			restrict: 'A',
			link: function(scope, element, attrs) {
				scope[attrs.initModel] = element[0].value;
				//console.log(element[0]);
				if(attrs.datameta) {
					var a = attrs.datameta;
					scope.post['metadata'][a] = element[0].value;
					if(typeof scope['metadata'] === 'undefined'){
						scope['metadata'] = {};
						scope['metadata'][a] = element[0].value;
						//console.log(scope['metadata'])
					}
					else{
						if(typeof scope['metadata'][a] === 'undefined' || typeof scope['metadata'][a] === null){
							scope['metadata'][a] = element[0].value;
						}
					}	
				}
				else{
					scope.post[attrs.initModel] = element[0].value;
				}
				
				element.attr('ng-model', attrs.initModel);
				element.removeAttr('init-model');
				$compile(element)(scope);
				
			}
		};
	});
	
	apps.controller('products', ['$scope', '$http', '$location', '$window' , 'lightbox','Upload','$timeout', function ($scope, $http , $location ,$window , lightbox , Upload,$timeout) {		
		$scope.post = {
			'title' : '',
			'slug' : '',
			'lang' : 'en',
			'description' : '',
			'metadata': {},
			'CONTEXT': {},
			'dates':{
				
			},
			'id' : false
		};
		
		$scope.dates = [];
		$scope.groups = [];

		$scope.sortableOptions = {
			update: function(e, ui) { },
			axis: 'x'
		  };

		
		$scope.upload = function (file) {
		//	console.log(file);
			Upload.upload({
				url: '/admin/product/upload',
				data: {file: file}
			}).then(function (resp) {
				//console.log('Success ' + resp.config.data.file.name + 'uploaded. Response: ' + resp.data);
			}, function (resp) {
				//console.log('Error status: ' + resp.status);
			}, function (evt) {
				var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
				//console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
			});
		};

		$scope.uploadFiles = function(files) {
			$scope.files = files;
			angular.forEach(files, function(file) {
				file.upload = Upload.upload({
					url: '/admin/product/uploadFiles',
					data: {file: file}
				});
	
				file.upload.then(function (response) {
					$timeout(function () {
						file.result = response.data;
					});
				}, function (response) {
					if (response.status > 0)
						$scope.errorMsg = response.status + ': ' + response.data;
				}, function (evt) {
					file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
				});
			});
			
		}

		$scope.editor = {};

		$scope.galleries = {}

		$scope.results = [];
		
		$scope.dzOptions = {
			url : '/admin/product/upload',
			dictDefaultMessage : 'Add files to show dropzone methods (few)',
			addRemoveLinks : true,
			//previewTemplate: $('#preview-template').html()
		};
		
		$scope.dzCallbacks = {
			'addedfile' : function(file){
				$scope.newFile = file;				
			},
			'removedfile' : function(file){
				$scope.gallery();
			},
			'success' : function(file, xhr){
				var postData = (xhr.data['input']);
				if(postData['draft'] != false){
					$scope.post['id'] = postData['draft'];
				}
				$scope.gallery();
			},
			'sending': function (file, xhr, formData) {
			  formData.append('post',JSON.stringify($scope.post));
			} ,
			'complete': function(file) {
				$scope.dzMethods.removeFile(file);
			}
		};
		
		$scope.dzMethods = {};
		$scope.removeNewFile = function(){
			$scope.dzMethods.removeFile($scope.newFile);
			$scope.gallery();
		}
		
		$scope.gallery = function () {
			$http.post("/admin/product/gallery",{params:$scope.post})
				.then(function (response) {
					$scope.galleries = response.data['galleries'];
					
				})
				.catch(function (err) {
				   toastr.error("Something error , check your connection !","Error");
				  
				})
				.finally(function () {
					
				});
		};
		
		$scope.load = function () {
			//console.log($scope.days);
			$http.post("/admin/product/load",{params:$scope.post})
				.then(function (response) {
					$scope.groups = response.data['posts'];
					$scope.dates = response.data['dates'];
					
				})
				.catch(function (err) {
				   toastr.error("Something error , check your connection !","Error");
				   
				})
				.finally(function () {
					$scope.ready();
				});
		}
		
		$scope.search = function () {
			//console.log($scope.view);
			
			$('body').progress('open');
			$http.post("/admin/product/api_v1",{params:$scope.post})
				.then(function (response) {
					$scope.results = response.data['posts'];
				})
				.catch(function (err) {
				   toastr.error("Something error , check your connection !","Error");
				   $('body').progress('close');
				})
				.finally(function () {
					$('body').progress('close');
				});
				
			
			
		}
		
		angular.element(document).ready(function () {
			if($scope.view == 'form'){
				$http.post("/admin/product/get_post",{id:$scope.id})
				.then(function (response) {
					$scope.post = response.data['posts'];
				})
				.catch(function (err) {
				   toastr.error("Something error , check your connection !","Error");
				   
				})
				.finally(function () {
					$scope.load();
					$scope.gallery();
				});
				return;
			}else if($scope.view == 'load'){
				$scope.load();
				return;
				
			} else if($scope.view == 'list'){
				$scope.search();
			}
			
			
		});

		$scope.ready = function(){
			var allEditors = document.querySelectorAll('.editor1 , .editor2 , .editor');
			for (var i = 0; i < allEditors.length; ++i) {
				n = i;
				ClassicEditor
				.create( allEditors[i] , {
					ckfinder: {
						uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Files&responseType=json'
					}
				} )
				.then(editor => {
					var editors = allEditors;
					$.each(editors, function(index, item) {
						editors[index].innerHTML = editor.getData();
						editors[index].setAttribute("data-ckEditor","true");
							model = editors[index].getAttribute("name");
							var name = (item.getAttribute("name"))
							//if(i == index + 1){
								content[name] = editor;
							//}
					});
				}
				//
				)
				.catch( error => {
					console.error( error );
				});
			}

		}

		$scope.oneAtATime = true;

		
		
		/*
		$scope.items = ['Item 1', 'Item 2', 'Item 3'];

		$scope.addItem = function() {
			var newItemNo = $scope.items.length + 1;
			$scope.items.push('Item ' + newItemNo);
		};
		
		$scope.callMeWhenCompiled = function () {
			
		};
		*/

		$scope.date_done = function(){
			$('.input-daterange').datepicker({
				autoclose: true,
				todayHighlight: true,
			 });
			//var datePost = $scope.post["dates"]["price"];
			if($scope.view == 'form'){
				$scope.post["dates"] = {
					"start" : {},
					"end" : {},
					"price" : {}
				};
				$.each($scope.dates, function(index, item) {
					$scope.post["dates"]["start"][index] = item["start"];
					$scope.post["dates"]["end"][index] = item["end"];	
					$scope.post["dates"]["price"][index] = item["price"];				
					//$scope.post["dates"]["price"]
					
				});
			}
			//$scope.post["dates"] = datePost;
			console.log($scope.post["dates"]);
		}

		$scope.addDate = function() {
			var dates = $scope.dates;
			var newItemNo = Object.keys(dates).length;
			/*
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();

			if(dd<10) {
				dd = '0'+dd
			} 

			if(mm<10) {
				mm = '0'+mm
			} 

			today = mm + '/' + dd + '/' + yyyy;	
			*/		
			var arr = {
				id : (newItemNo + 1),
				start: '',
				end: '',
				price: 0
			};
			$scope.dates[newItemNo] = arr;	
			console.log($scope.dates)	
		};

		$scope.removeDate = function(){
			var remove = this.x['id'];
			var dates = $scope.dates || [];
			for (var key in dates) {
				if(dates[key]["id"] == remove){
					console.log(dates[key])
					delete dates[key]
					//dates.splice(key, 1);
				}
			};
			
			$scope.dates = dates;
		}

		$scope.instansce = function(){
			$scope.repeat_done();
			$.each($scope.groups, function(index, item) {
				content["content_"+item["id"]] = item["content"];
				
				if(typeof $scope.post["tabs"] == 'undefined'){
					$scope.post["tabs"] = {};
				}

				if(typeof $scope.post["contents"] == 'undefined'){
					$scope.post["contents"] = {};
				}

				if(typeof $scope.post["CONTEXT"] == 'undefined'){
					$scope.post["CONTEXT"] = {};
				}

				$scope.post["tabs"][item["id"]] = item["title"];
				$scope.post["contents"][item["id"]] = item["content"];
				$scope.post["CONTEXT"]["content_"+item["id"]] = item["content"];
				$("#content__collapse_group_"+item["id"]).val(item["content"]);
				
			});
			
		}
		
		$scope.addTab = function(){
			var old_groups = $scope.groups;
			var count = Object.keys(old_groups).length;
			var key = 1;
			if(count > 0){
				key = parseInt(count) + 1;
			}
			var arr = {
				id : key,
				title: "Group Header - "+ key,
				content: "Group Body - "+ key
			};

			old_groups[(key - 1)] = arr;
			$scope.groups = old_groups;			
		}

		$scope.repeat_done = function(){
			var allEditors = document.querySelectorAll('.editor_tab');
			for (var i = 0; i < allEditors.length; ++i) {
				if(allEditors[i].getAttribute("data-ckEditor") != "true"){
					var n = allEditors[i].getAttribute("name");
					ClassicEditor
					.create( allEditors[i] , {
						ckfinder: {
							uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Files&responseType=json'
						}
					} )
					.then(editor => {
						var editors = allEditors;
						$.each(editors, function(index, item) {
							editors[index].innerHTML = editor.getData();
							editors[index].setAttribute("data-ckEditor","true");
							model = editors[index].getAttribute("name");
							var name = (item.getAttribute("name"))
							if(i == index + 1){
								content[name] = editor;
							}
						});
					}
					//
					)
					.catch( error => {
						console.error( error );
					});
				}
			}
		}
		
		$scope.removeTab = function(){
			var remove = this.group['id'];
			var old_groups = $scope.groups || [];
			for (var key in old_groups) {
				if(old_groups[key]["id"] == remove){
					//if($('.days_textarea ').length > 1){
						//delete old_groups[key]
						old_groups.splice(key, 1);
					//}
					
				}
			};
			
			$scope.groups = old_groups;
			$scope.groups.length = old_groups.length; 
		//	console.log($scope.groups);
		}
		
		$scope.openData = function(params) {
			var item = this.item;
			$scope.post = {
				'id' : item['id'],
				'title' : item['title'],
				'slug' : item['slug'],
				'lang' : item['lang'],
				'description' : item['description']
			};
		};
		
		$scope.deleteData = function(params) {
			var item = this.item;
			swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this customer!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
				  $http.post("product/remove",{params: item, action: 'remove'})
					.then(function(response) {
						$scope.search();
						if(response.status == '200'){
							/**
							swal("Poof! Customer has been deleted!", {
							  icon: "success",
							});
							**/
							toastr.success("Poof! Customer has been deleted!","Success");
						}
						else{
							swal("Sorry! Customer can't delete!", {
							  icon: "error",
							});
						}
					});
				
			  } 
			});
			
			
		};

		$scope.addDay = function(e) {
			//console.log($(e).data('test'));
			$('<li class=\"active\"><a data-toggle=\"tab\" href=\"#tab1\">Day 2</a></li>').insertBefore($(this).closest('li'));
		};

		$scope.slugify = function(){
			var str = $scope.post['title'];
			str = str.toString().toLowerCase().trim()
				.replace(/&/g, '-and-')         // Replace & with 'and'
				.replace(/[\s\W-]+/g, '-') ;
				
			$scope.post['slug'] = str;
		}

		$scope.editData = function(){
			var item = this.item;
			$scope.post = {
				'id' : item['id'],
				'title' : item['title'],
				'slug' : item['slug'],
				'lang' : item['lang'],
				'description' : item['description']
			};
			//$location.path( "/admin/product/show/" + item['id'] );
			//	console.log($location);
			$window.location.href = "/admin/product/show/" + item['id'] ;
		 };
		
		$scope.submit = function(){
			$scope.post["metadata"] = $scope.metadata;
			$.each(content, function(index, item) {
				if(typeof $scope.post["CONTEXT"] == 'undefined'){
					$scope.post["CONTEXT"] = {};
				}
				$scope.post["CONTEXT"][index] = item.getData();
			});
			console.log($scope.post);
			//return;
			if($scope.id){
				$scope.post["id"] = $scope.id;	
			}
			$http.post("/admin/product/store",{params:$scope.post, action:'add' , days: $scope.days})
				.then(function (response) {
					
					if(!$scope.id){
					//	$scope.resetForm();
					}
						
					if(response.data['error'] == false){
						toastr.success(response.data['message'],"Success");
						if(response.data['id'])
							$window.location.href = "/admin/product";
					}
					else{
						toastr.error(response.data['message'],"Failed");
						return;
					}
					
					
				})
				.catch(function (err) {
				   toastr.error("Something error , check your connection !","Error");
				   $('body').progress('close');
				})
				.finally(function () {
					$('body').progress('close');
					
				});
		}

		$scope.filter = function () {
			$scope.search();
		}
		
		$scope.resetForm = function(){
		   $scope.post = {};
		};
		
		$scope.options = {
			language: 'en',
			height:'120px',
			allowedContent: true,
			entities: false
		};
		
		$scope.onReady = function () {
			CKEDITOR.replace('.editor',{
				height: 120
			});
		};
		
		$scope.removeImage = function(){
		   var item = this.image;
			swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this image!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
				  $http.post("/admin/product/remove",{params: item, action: 'removeImage'})
					.then(function(response) {
						$scope.gallery();
						if(response.status == '200'){
							toastr.success("Poof! image has been deleted!","Success");
						}
						else{
							swal("Sorry! image can't delete!", {
							  icon: "error",
							});
						}
					});
				
			  } 
			});
		};
		
		$scope.lightboxOptions = {
		  fadeDuration: 0.7,
		  resizeDuration: 0.5,
		  fitImageInViewPort: true,
		  positionFromTop: 50,  
		  showImageNumberLabel: false,
		  alwaysShowNavOnTouchDevices: false,
		  wrapAround: false
		};
		
		$scope.openLightboxModal = function ($index) {
			lightbox.open($scope.galleries,$index);
			// console.log(lightbox)
		};
		
		
	}]);
	
	
	