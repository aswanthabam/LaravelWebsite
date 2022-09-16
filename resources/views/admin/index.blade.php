@extends("theme/admin")
@section("sidebar-cont")
<a class="sidebar-item" href="/admin/projects"><i class="bi bi-person-workspace"></i> <span class="full">Projects</span></a>
@endsection

@section("sidebar-top")
<img width="100%" src="/static/images/icons/icon_transparent.png"/>
@endsection

@section("sidebar-bottom")
<a class="bottom-item" href="/logout"><i class="bi bi-box-arrow-left"></i> <span class="full">Logout</span></a>
@endsection

@section("body")
<h5><b>Welcome {{$user->name}}</b></h5>
<a href="/admin/add/project">Add new project</a>
<h4>Projects</h4>
@foreach($projects as $pro)
{{$pro->name}} {{$pro->version}} {{$pro->created_date}}
@endforeach
@endsection