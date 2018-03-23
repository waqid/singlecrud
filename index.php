<!DOCTYPE html>
<html lang="en">
<head>
	<title>Single CRUD | Kumpul Koding</title>
	<!--meta name="viewport" content="width=device-width, initial-scale=1.0"-->
	<style type="text/css">
		/*! normalize.css v8.0.0 | MIT License | github.com/necolas/normalize.css */
		button,hr,input{overflow:visible}progress,sub,sup{vertical-align:baseline}[type=checkbox],[type=radio],legend{box-sizing:border-box;padding:0}html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}h1{font-size:2em;margin:.67em 0}hr{box-sizing:content-box;height:0}code,kbd,pre,samp{font-family:monospace,monospace;font-size:1em}a{background-color:transparent}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}b,strong{font-weight:bolder}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative}sub{bottom:-.25em}sup{top:-.5em}img{border-style:none}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;line-height:1.15;margin:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button}[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{border-style:none;padding:0}[type=button]:-moz-focusring,[type=reset]:-moz-focusring,[type=submit]:-moz-focusring,button:-moz-focusring{outline:ButtonText dotted 1px}fieldset{padding:.35em .75em .625em}legend{color:inherit;display:table;max-width:100%;white-space:normal}textarea{overflow:auto}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}details{display:block}summary{display:list-item}[hidden],template{display:none}
		/*Custom CSS*/
		.title,header{text-align:center}a,header{text-decoration:none}body,html,main{font-family:helvetica;display:block}main{margin-left:20%;margin-right:20%;margin-top:10vh}header{font-size:1.3em;color:#ccd;margin-bottom:16px;padding:16px;border-bottom:solid 2px #eee}.data p,button,input{display:inline-block;padding:8px;margin:2px;border:6px solid #fff;border-radius:100px;box-shadow:0 4px 8px 0 rgba(0,0,0,.2),0 6px 20px 0 rgba(0,0,0,.19)}.data p,input[type=text]{width:256px;color:#666;padding-left:16px;font-weight:700}.data p{color:#6A5ACD}.danger,.update,a,footer p{color:#fff}input:active,input:focus,input:hover,input:visited{background-color:#303030;border-color:#282828;color:#fff;font-weight:700}.data{padding:8px 0}.danger{background-color:tomato;border-color:tomato}.danger:hover{background-color:red;border-color:red}.update{background-color:#40e0d0;border-color:#40e0d0}.update:hover{background-color:#00ced1;border-color:#00ced1}.new{background-color:pink;border-color:pink}::-webkit-input-placeholder{color:#fff;font-weight:700}::-moz-placeholder{color:#fff;font-weight:700}:-ms-input-placeholder{color:#fff;font-weight:700}:-moz-placeholder{color:#fff;font-weight:700}a{border-bottom:2px dotted pink;font-weight:700}button{padding-right:16px;padding-left:16px;font-weight:700}::placeholder{color:#eee}footer{position:absolute;bottom:0;padding:12px 0;background-color:#00ced1;width:100%}footer p{border:none;padding:12px} header a{color: pink;border: none;}
	</style>
	<script>
		function switcher(){
			var d = document.createElement('input');
			var e = document.getElementsByTagName('p')[0];
			d.innerHTML = e.innerHTML;
			e.parentNode.insertBefore(d, e);
			console.log(e.innerHTML);
			e.parentNode.removeChild(e);
			console.log(e.innerHTML);
		}
	</script>
</head>
<body>
	<header><a href="/">
		Single File CRUD (Cek, Racocok, Uwahi, Dadi!)
		</a>
	</header>
	<main>
		<div class="content">
			<h3>Todo List</h3>
			<div id="todoContainer"></div>
		</div>
	</main>
	<footer>
		<p>Kumpul Koding Chapter I 03/23/2018 <a href="https://kesatriakeyboard.com">Kesatria Keyboard</a> and <a href="https://waqid.id">Waqid ID</a> </p>
	</footer>
	
	<script src="https://cdn.jsdelivr.net/npm/handlebars@4.0.5/dist/handlebars.min.js"></script>
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
	<script>
		var host = 'http://kumpulkoding.test/';
		loadData();

		function loadData() {
			var ourRequest = new XMLHttpRequest();
			ourRequest.open('GET', host + 'view.php', true);
			ourRequest.onload = function() {
			  if (ourRequest.status >= 200 && ourRequest.status < 400) {
			    var data = JSON.parse(ourRequest.responseText);
			    createHTML(data);
			  } else {
			    console.log("We connected to the server, but it returned an error.");
			  }
			};

			ourRequest.onerror = function() {
			  console.log("Connection error");
			};

			ourRequest.send();
		}

		function postRequest(url, params) {
			var xhr = new XMLHttpRequest();
			var task = document.getElementById('newTask').value;
			xhr.open('POST', url, true);

			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

			xhr.onload = function() {
				if (xhr.status >= 200 && xhr.status < 400) {
					loadData();
				} else {
					alert("something error");
				}
			}
			xhr.send(params);
		}

		function insertData() {
			event.preventDefault();
				
			var url = host + 'insert.php';
			var task = document.getElementById('newTask').value;
			var params = "task=" + encodeURIComponent(task);
			
			postRequest(url, params);
		}

		function updateData(id) {
			event.preventDefault();
			
			var url = host + 'update.php';
			var task = document.getElementById('task_'+id).value;
			var params = "id="+ id + "&task=" + encodeURIComponent(task);

			postRequest(url, params);
		}

		function deleteData(id) {
			event.preventDefault();
			
			var url = host + 'delete.php';
			var params = "id="+ id;

			postRequest(url, params);
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
