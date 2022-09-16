<!doctype html>
<html>
	<head>
		<meta name="viewport" content="width=device-width"/>
		<title>@yield("title")</title>
		<link rel="stylesheet" href="/static/css/admin/base_style.css"/>
		<link rel="stylesheet" href="/static/css/style.css"/>
		
		<!-- bootstrap -->
		
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
		<!-- JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
		
		<!-- Bootstrap icons -->
		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	</head>
	<body>
		<div class="container-fluid">
		    <div class="row">
		        <div class="sidebar-big col-2 col-md-2 col-lg-3 bg-dark">
		            <!-- Side menu -->
		            <div class="sidebar-head">
		                @yield("sidebar-top")
		            </div>
		            <div class="sidebar-cont">
		                @yield("sidebar-cont")
		            </div>
		            <div class="sidebar-bottom">
		                @yield("sidebar-bottom")
		            </div>
		        </div>
		        <div class="main-cont col-10 col-md-10 col-lg-9">
		        	<div class="status">
					@if (session('status'))
					<div class="alert alert-success alert-dismissible">
						{{ session('status') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					@endif
				</div>
		            @yield("body")
		        </div>
		    </div>
		</div>
		<script>
		
		</script>
	</body>
</html>