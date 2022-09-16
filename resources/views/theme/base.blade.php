<!Doctype html/>
<html>
	<head>
		<meta name="viewport" content="width=device-width"/>
		<title>@yield("title")</title>
		@yield("head-beg")
		<!-- Font styles -->
		
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400&family=Exo+2:ital,wght@0,300;1,200&family=Finlandica:ital@0;1&family=Kanit:ital,wght@0,300;1,200&family=Source+Sans+Pro:wght@300;400&display=swap" rel="stylesheet">

		<!-- Pre Loader Styles -->
		
		<style type="text/css" media="all">
			@keyframes loader-animate{
				0%{
					transform: rotate(0deg);
					filter: hue-rotate(0deg);
				}100%{
					transform: rotate(330deg);
					filter: hue-rotate(330deg);
				}
			}
			*{
				padding: 0px;
			}
			body{
				margin: 0px;
				padding: 0px !important;
				--color-blured-black: #12121250;
				--color-gray: #6a6a6a;
			}
			.loader-container{
				display: flex;
				background: var(--color-blured-black);
				align-items: center;
				justify-content: center;
				min-height: 100vh;
				min-width: 100%;
				margin: 0px;
				padding: 0px;
				position: fixed;
				top: 0px;
				z-index: 20;
			}
			.loader-container .loader{
				position: relative;
				width: 50px;
				height: 50px;
				border-radius: 50%;
				border-left: 5px solid var(--color-gray);
				animation: loader-animate 1s linear infinite;
			}
			.loader-container .loader:before{
				content: '';
				position: absolute;
				top: 3px;
				left: 3px;
				right: 3px;
				bottom: 3px;
				border-radius: 50%;
				z-index: 1000;
			}
			/*.loader-container .loader:after{
				content: '';
				position: absolute;
				top: 0px;
				left: 0px;
				right: 0px;
				bottom: 0px;
				border-radius: 50%;
				z-index: 1000;
				z-index: 1;
				filter: blur(30px);
			}*/
			@yield("style")
		</style>
		
		<!-- JQuery -->
		
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		
		<!-- Boxicon CSS -->
		
		<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
		
		<!-- App StyleSheets -->
		
		<link rel="stylesheet" href="/static/css/base_style.css"/>
		
		<link rel="stylesheet" href="/static/css/style.css"/>
		
		<!-- App Scripts -->
		
		<script src="/static/js/base_js.js"></script>
		
		<!-- Additional Headers -->
		
		@yield("head")
		
	</head>
	<body>
		<div id="pre-loader" class="loader-container">
			<div class="loader">
				
			</div>
		</div>
		<div class="body-background-content-container">
		<div class="body-background">
		    <img src="/static/images/backgrounds/bg-2.jpg"></img>
		</div>
		<div id="container" class="container">
			<div id="sidebar" class="sidebar">
				<div id="side-background" class="side-background">
					
				</div>
				<div id="side-content" class="side-content">
					<div class="side-head">
						<div>
							<i id="menu-close" class='bx bx-right-arrow-alt'></i>
							<span class="brand-name-1">@yield("brand-name")</span>
						</div>
					</div>
					<div class="side-body">
						<div class="side-item">
							<a href="/">
								<div>
									<i class='bx bx-home-smile side-icon'></i>
									<span class="side-name">Home</span>
								</div>
							</a>
							
						</div>
						<div class="side-item">
							<a href="/projects">
								<div>
									<i class='bx bx-home-smile side-icon'></i>
									<span class="side-name">Projects</span>
								</div>
							</a>
							
						</div>
						<div class="side-item">
							<a href="/downloads">
								<div>
									<i class='bx bx-home-smile side-icon'></i>
									<span class="side-name">Downloads</span>
								</div>
							</a>
							
						</div>
						<div class="side-item">
							<a href="/contact">
								<div>
									<i class='bx bx-home-smile side-icon'></i>
									<span class="side-name">Contact</span>
								</div>
							</a>
							
						</div>
						<div class="side-item">
							<a href="/about">
								<div>
									<i class='bx bx-home-smile side-icon'></i>
									<span class="side-name">About</span>
								</div>
							</a>
							
						</div>
					</div>
				</div>
			</div>
			<div id="topbar" class="topbar">
				<div id="topbar-brand" class="brand">
					<img class="image-icon" src="/static/images/icons/icon_transparent.png"/>
				</div>
				<div class="menu">
					<span style="text-align: center;position: absolute; left: 50%;transform: translateX(-50%);" class="brand-name-1">@yield("brand-name")</span>
					<i id="menu-icon" class='bx bx-menu'></i>
				</div>
				
			</div>
			<div class="main">
				<div class="status">
					@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
					@endif
				</div>
				<div style="width:100%;height:auto; margin: 0 !important;padding: 0 !important;" class="main-cont">@yield("body")</div>
			</div>
			<div class="footer">
				@yield("footer")
			</div>
		</div>
		</div>
		<script>
			window.onload = function()
			{
				document.getElementById("pre-loader").style.display = "none";
				setUp();
				window.onscroll = function()
				{
				    @yield("script-onscroll")
				}
				@yield("script-onload")
			}
			
			@yield("script")
		</script>
		@yield("body-end")
	</body>
</html>