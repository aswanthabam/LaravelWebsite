@extends("theme.admin")
@section("head")
<link rel="stylesheet" href="/static/css/admin/view/project_view.css"/>
@endsection
@section("body")
@if($project->single_item_project)
@foreach($project->allItems as $item)
@if($item->is_latest)
Latest
@endif
<div class="item">
  
</div>
@endforeach
@else

@endif
@endsection