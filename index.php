<!DOCTYPE html>
<html lang="en">
<head>
	<title>Single CRUD | Kumpul Koding</title>
	<!--meta name="viewport" content="width=device-width, initial-scale=1.0"-->
	<style type="text/css">
		/*! normalize.css v8.0.0 | MIT License | github.com/necolas/normalize.css */
		button,hr,input{overflow:visible}progress,sub,sup{vertical-align:baseline}[type=checkbox],[type=radio],legend{box-sizing:border-box;padding:0}html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}h1{font-size:2em;margin:.67em 0}hr{box-sizing:content-box;height:0}code,kbd,pre,samp{font-family:monospace,monospace;font-size:1em}a{background-color:transparent}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}b,strong{font-weight:bolder}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative}sub{bottom:-.25em}sup{top:-.5em}img{border-style:none}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;line-height:1.15;margin:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button}[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{border-style:none;padding:0}[type=button]:-moz-focusring,[type=reset]:-moz-focusring,[type=submit]:-moz-focusring,button:-moz-focusring{outline:ButtonText dotted 1px}fieldset{padding:.35em .75em .625em}legend{color:inherit;display:table;max-width:100%;white-space:normal}textarea{overflow:auto}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}details{display:block}summary{display:list-item}[hidden],template{display:none}
		/*Custom CSS*/
		.title,header{text-align:center}a,header{text-decoration:none}body,html,main{font-family:helvetica;display:block}main{min-width:calc(100%-100px);margin-left:20%;margin-right:20%;margin-top:10vh}header{font-size:1.3em;color:#ccd;margin-bottom:16px;padding:16px;border-bottom:solid 2px #eee}.data p,button,input{display:inline-block;padding:8px;margin:2px;border:6px solid #fff;border-radius:100px;box-shadow:0 4px 8px 0 rgba(0,0,0,.2),0 6px 20px 0 rgba(0,0,0,.19)}.data p,input[type=text]{width:256px;color:#666;padding-left:16px;font-weight:700}.data p{color:#6A5ACD}.danger,.update,a,footer p{color:#fff}input:active,input:focus,input:hover,input:visited{background-color:#303030;border-color:#282828;color:#fff;font-weight:700}.data{padding:8px 0}.danger{background-color:tomato;border-color:tomato}.danger:hover{background-color:red;border-color:red}.update{background-color:#40e0d0;border-color:#40e0d0}.update:hover{background-color:#00ced1;border-color:#00ced1}.new{background-color:pink;border-color:pink}::-webkit-input-placeholder{color:#fff;font-weight:700}::-moz-placeholder{color:#fff;font-weight:700}:-ms-input-placeholder{color:#fff;font-weight:700}:-moz-placeholder{color:#fff;font-weight:700}a{border-bottom:2px dotted pink;font-weight:700}button{padding-right:16px;padding-left:16px;font-weight:700}::placeholder{color:#eee}footer{background-color:#00ced1;width:100%}footer p{border:none;padding:12px} header a{color: teal;border: none;}
	</style>
</head>
<body>
	<header><a href="/">
		Single Page CRUD (Cek, Racocok, Uwahi, Dadi!)
		</a>
	</header>
	<main>
		<div class="content">
			<h3>Todo List</h3>
			<?php 
				if(!file_exists('./app/lib/config.php')) { die('<h3 style="color:red">Error: I cant find config.php in app/lib folder</h3>'); }
			?>
			<div id="todoContainer"></div>
		</div>
	</main>
	<footer>
		<p style="text-align: center; margin-top: 4rem; line-height: 1.4rem">
			To Do App CRUD PHP based, tested on PHP 5.4+ and MySQL 5.7+
		<br/>
			Kumpul Koding Chapter I 03/23/2018 
			<a target="_blank" href="https://kesatriakeyboard.com">Kesatria Keyboard</a> and 
			<a target="_blank" href="https://frista.id">Waqid ID</a> 
		</p>
	</footer>
	
	<!-- handlebars.js core -->
	<script src="https://cdn.jsdelivr.net/npm/handlebars@4.0.5/dist/handlebars.min.js"></script>
	<!-- handlebars.js custom template -->
	<script id="todoTemplate" type="text/x-handlebars-template">
		<div class="data">
			<form>
				<input type="text" id="newTask">
				<button class="update" onclick="insertData()">Tambah</button>
			</form>
		</div>
		{{#each todos}}
		<div class="data">
			<form>
				<input class="each" type="text" id="task_{{id}}" value="{{task}}">
				<button class="update" onclick="updateData({{id}})">Perbarui</button>
				<button class="danger" onclick="deleteData({{id}})">Hapus</button>
			</form>
		</div>
		{{/each}}	
	</script>
	<!-- ajax core function -->
	<script>
		function xwwwfurlenc(srcjson){
			if(typeof srcjson !== "object")
				if(typeof console !== "undefined"){
					console.log("\"srcjson\" is not a JSON object");
					return null;
				}
			u = encodeURIComponent;
			var urljson = "";
			var keys = Object.keys(srcjson);
			for(var i=0; i <keys.length; i++){
				urljson += u(keys[i]) + "=" + u(srcjson[keys[i]]);
				if(i < (keys.length-1))urljson+="&";
			}
			console.log(urljson);
			return urljson;
		}

		function xhrRequest(method, data) {
			var xhr = new XMLHttpRequest();
			xhr.open(method, data.url, true);

			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

			xhr.onload = function() {
				if (xhr.status >= 200 && xhr.status < 400) {
					try {
						var response = JSON.parse(xhr.responseText);
						data.success(response);
					} catch (e) {
						document.getElementById('todoContainer').innerHTML = '<h3 style="color:red">Error: I find difficulties reading data, there is what i found.</h3>' + xhr.responseText;
					}
				} else {
					data.error();
				}
			}
			xhr.onerror = function() {
				console.log('Connection Error');
			}

			if(data.params) {
				xhr.send(xwwwfurlenc(data.params));
			} else {
				xhr.send();
			}
		}

		function getRequest(data) {
			xhrRequest('GET', data);
		}

		function postRequest(data) {
			xhrRequest('POST', data);
		}
	</script>
	<!-- custom script, call ajax -->
	<script>
		var host = '//singlecrud.test/';
		loadData();

		function loadData() {
			getRequest({
				url: host + 'view.php',
				success: function(data) {
			    	createHTML(data);
				},
				error: function() {
					console.log("We connected to the server, but it returned an error.");
				}
			});
		}

		function insertData() {
			event.preventDefault();
			postRequest({
				url: host + 'insert.php',
				params: {
					'task': document.getElementById('newTask').value
				},
				success: function() {
					loadData();
				}
			});
		}

		function updateData(id) {
			event.preventDefault();
			postRequest({
				url: host + 'update.php',
				params: {
					'id': id,
					'task': document.getElementById('task_'+id).value
				},
				success: function() {
					loadData();
				}
			});
		}

		function deleteData(id) {
			event.preventDefault();
			postRequest({
				url: host + 'delete.php',
				params: {
					'id': id
				},
				success: function() {
					loadData();
				}
			});
		}

		function createHTML(fetchData) {
		  var raw = document.getElementById("todoTemplate").innerHTML;
		  var compiled = Handlebars.compile(raw);
		  var generated = compiled(fetchData);
		  var g = document.getElementById("todoContainer");
		  g.innerHTML = generated;
		}
	</script>
</body>
</html>
