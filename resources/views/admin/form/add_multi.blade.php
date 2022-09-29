@extends("theme.base")
@section("head")
	<link rel="stylesheet" href="/static/css/form/form-style.css"/>
@endsection

@section("body")
@if($project->single_item_project)
<center><h4>This is a single item project. This project cant contain a multi item enviornment.</h4></center>
@else
<center><h4>@isset($edit) Edit multi @endisset @empty($edit) Add @endempty Item</h4></center>
@endif
@if(!$project->single_item_project)
<form class="form-control" method="post" action="
@empty($edit)
/admin/add/project/{{$project->project_id}}/multi
@endempty
@isset($edit)
/admin/edit/project/{{$project->project_id}}/multi/{{$multi->multi_id}}
@endisset
">
	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
	@csrf
	<div class="form-group">
		<label for="name">Name *</label>
		<input @isset($edit) value="{{$multi->name}}" @endisset type="text" name="name" placeholder="Name" required/>
	</div>
	<input type="submit" value="Next >>"/>
</form>
@endif
@endsection