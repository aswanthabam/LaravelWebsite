@extends("theme/admin")
@section("head")
<link rel="stylesheet" href="/static/css/admin/index.css"/>
@endsection


@section("body")
<div class="projects">
<h2>Projects</h2>
@foreach($items as $item)
<div class="project">
  <div class="head col-12">
    <h5>{{$item->release_name}}</h5>
    <small>{{$item->item_id}}</small><br/>
    <small>Created on : {{$item->added_on}}</small>
    <small>Updated on : {{$item->changed_on}}</small>
    
  </div>{{--<!-- 
  <div class="options col-12">
    <a href="/admin/view/project/{{$item->item_id}}" class="btn btn-light">More</a>
    <a href="/projects/{{$item->project->project_id}}/" class="btn btn-light">View</a>
     <a href="/admin/add/project/{{$item->item_id}}/item" class="btn btn-light"> @if($pro->single_item_project) Update @else New @endif </a>
     <a href="/admin/edit/project/{{$item->item_id}}" class="btn btn-light">Edit</a>
     <a href="/admin/delete/project/{{$item->item_id}}" class="btn btn-danger">Delete</a>
  </div> -->--}}
</div>
@endforeach
@endsection