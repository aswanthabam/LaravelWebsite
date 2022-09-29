@extends("theme/admin")
@section("head")
<link rel="stylesheet" href="/static/css/admin/index.css"/>
@endsection


@section("body")
<div class="projects">
<h2>Projects</h2>
@foreach($projects as $pro)
<div class="project">
  <div class="head col-12">
    <h5>{{$pro->name}}</h5>
    <small>{{$pro->project_id}}</small><br/>
    <small>Created on : {{$pro->added_on}}</small>
    <small>Updated on : {{$pro->changed_on}}</small>
    @if($pro->single_item_project) 
    <div class="col-12">
      Latest : @if($pro->latestItem != null) <a href="/admin/view/project/{{$pro->project_id}}/item/{{$pro->latestItem->item_id}}">{{$pro->latestItem->release_name}}</a> @else <a href="/admin/add/project/{{$pro->project_id}}/item">New release</a> @endif
    </div>
    @else
    <p>
      Project has multiple <button class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseItems{{$pro->id}}" aria-expanded="false" aria-controls="collapseItems{{$pro->id}}">
        Items <i class="bi bi-chevron-down"></i>
      </button>
    </p>
    <div class="collapse" id="collapseItems{{$pro->id}}">
      <div class="card card-body">
        @if(count($pro->multi) > 0)
        @foreach($pro->multi as $multi)
        <div class="card card-body">
          <h4>{{$multi->name}}</h4>
          @if($multi->item()->where("is_latest",true)->first() == null)
          No items added <a href="/admin/add/project/{{$pro->project_id}}/multi/{{$multi->id}}/item" class="btn btn-light">Add</a>
          @else
          <p>
            <small>{{$multi->item()->where("is_latest",true)->first()->release_name}}</small><br/>
            <a href="/admin/add/project/{{$pro->project_id}}/multi/{{$multi->id}}/item" class="btn btn-light">Update</a>
            <a href="/admin/edit/project/{{$pro->project_id}}/multi/{{$multi->id}}/item/{{$multi->item()->where("is_latest",true)->first()->item_id}}" class="btn btn-light">Edit</a>
          </p>
          @endif
        </div>
        @endforeach
        <div class="card card-body"><center><a href="/admin/add/project/{{$pro->project_id}}/multi" class="btn btn-light">Create New</a></center></div>
        @else
        <div class="card card-body"><center>No items found <br/><a href="/admin/add/project/{{$pro->project_id}}/multi" class="btn btn-light">Create New</a></center></div>
        @endif
      </div>
    </div>

    @endif
  </div>
  <div class="options col-12">
    <a href="/admin/view/project/{{$pro->project_id}}" class="btn btn-light">More</a>
    <a href="/projects/{{$pro->project_id}}" class="btn btn-light">View</a>
     <a href="/admin/add/project/{{$pro->project_id}}/item" class="btn btn-light"> @if($pro->single_item_project) Update @else New @endif </a>
     <a href="/admin/edit/project/{{$pro->project_id}}" class="btn btn-light">Edit</a>
     <a href="/admin/delete/project/{{$pro->project_id}}" class="btn btn-danger">Delete</a>
  </div>
</div>
@endforeach
@endsection