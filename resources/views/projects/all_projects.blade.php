@extends("theme.base")
@section("head")
<link rel="stylesheet" href="/static/css/projects/all_projects.css"/>
@endsection
@section("body")
<div class="projects">
  <div class="head">
		<div class="image-bg">
			<img src="/static/images/backgrounds/project_defaults/bg1.jpg"/>
		</div>
		<div class="head-content">
			<div class="cont"><div>
			<h2 class="item-name">Projects</h2>
			<h6 class="item-release"></h6>
			</div></div>
		</div>
	</div>
  @foreach($projects as $pro)
  <div class="item">
    <div class="head">
      <h4>{{$pro->name}}</h4>
    </div>
    <div class="content">
      <p>{{$pro->description}}</p>
    </div>
    <div class="more"><a href="/projects/{{$pro->project_id}}">View More >></a></div>
  </div>
  @endforeach
</div>
@endsection
@section("script-onscroll")
if(window.scrollY >= 50) showTopBar();
else hideTopBar();
@endsection