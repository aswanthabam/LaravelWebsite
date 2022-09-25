@extends("theme.base")

@section("head-beg")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/AVC-Tech/MarkDownToHtml@1.0.0/markdown.css" type="text/css" media="all" />
<script src="https://cdn.jsdelivr.net/gh/AVC-Tech/MarkDownToHtml@1.0.0/markdown.js" type="text/javascript" charset="utf-8"></script>
@endsection
@section("head")
<link rel="stylesheet" href="/static/css/projects/item_view.css"/>
@endsection
@section("body")
<div class="item-container">
	<div class="head">
		<div class="image-bg">
			<img src="/static/images/backgrounds/project_defaults/bg1.jpg"/>
		</div>
		<div class="head-content">
			<div class="cont"><div>
			<h2 class="item-name">{{$item->name}}</h2>
			<h6 class="item-release">{{$item->release_name}}</h6>
			</div></div>
		</div>
	</div>
	<div class="content">
	<div class="description">
		<p>{{$item->description}}</p>
	</div>
	<div class="author">
		By {{$item->author}}
	</div>
	<div class="details">
		<table class="table">
			<tbody>
				@foreach(array_keys(json_decode($item->details,true)) as $x)
				<tr>
					<td>{{$x}}</td>
					<td>{{json_decode($item->details,true)[$x]}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="readme-head">
			README
		</div>
	<div style="width: calc(100% - 30px);margin: 15px;" class="readme">
		
		{!! $item->readme !!}
	</div>
	</div>
</div>
@endsection
@section("script-onscroll")
if(window.scrollY >= 50) showTopBar();
else hideTopBar();
@endsection