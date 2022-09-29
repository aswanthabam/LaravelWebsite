@extends("theme.base")
@section("head")
	<link rel="stylesheet" href="/static/css/form/form-style.css"/>
	<style>
	.main{
		margin: 0 !important;
		padding: 0 !important;
	}
		.table{
			width: 100%;
			background: #fff;
		}
		.table td{
			padding: 5px;
			border: 1px solid #12121290;
		}
		.table .head{
			background: #12121290;
			color: #fff;
		}
		.table .head td{
			border: 1px solid #fff;
		}
		.topbar{
			box-shadow: none;
			background: #fff;
		}
	</style>
@endsection

@section("body")
@if($project->single_item_project)
<center><h4>@isset($edit)Edit @endisset @empty($edit) Add @endempty a version</h4></center>
@else
<center><h4>Add an Item to project</h4></center>
@endif
<form class="form-control" method="post" action="
@empty($edit)
/admin/add/project/{{$project_id}}
@isset($multi)
/multi/{{$multi->multi_id}}
@endisset
/item
@endempty
@isset($edit)
/admin/edit/project/{{$project->project_id}}
@isset($multi)
/multi/{{$multi->multi_id}}
@endisset
/item/{{$item->item_id}}
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
	@if(!$project->single_item_project)
	<div class="form-group">
		<label for="name">Item Name</label>
		<input @isset($edit) value="{{$item->name}}" @endisset type="text" name="name" placeholder="Item Name"/>
	</div>
	@endif
	<div class="form-group">
		<label for="version">Release Name *</label>
		<input @isset($edit) value="{{$item->release_name}}" @endisset type="text" name="release_name" placeholder="Release" required/>
	</div>
	<div class="form-group">
		<label for="version">Item Version *</label>
		<input @isset($edit) value="{{$item->version_name}}" @endisset type="text" name="version" placeholder="Version" required/>
	</div>
	
	<div class="form-group">
		<label for="description">Item Description *</label>
		<input type="text" name="description" placeholder="Description" value="@empty($edit) {{$project->description}} @endempty @isset($edit) {{$item->description}} @endisset " required/>
	</div>
	<div class="form-group">
		<label for="author">Item Author</label>
		<input type="text" name="author" placeholder="Author" value="@empty($edit) {{$project->author}} @endempty @isset($edit) {{$item->author}} @endisset "/>
	</div>
	<div class="form-group">
		<label for="author_link">Author Link</label>
		<input type="text" name="author_link" placeholder="Author Link" value="@empty($edit) {{$project->author_link}} @endempty @isset($edit) {{$item->author_link}} @endisset "/>
	</div>
	<div class="form-group">
		<label for="created_date">Created Date</label>
		<input class="form-item-sided" id="created_date_cont" type="text" name="created_date" placeholder="Created Date" value="@empty($edit) {{$project->created_at}} @endempty @isset($edit) {{$item->created_at}} @endisset "/>
		<input class="form-item-sided-cont" id="created_date" type="date"/>
	</div>
	<div class="form-group">
		<input checked type="checkbox" name="is_latest" value="1"/>
		<label for="is_latest" @isset($edit) @if($item->latest) checked @endif @endisset>Is Latest *</label>
	</div>
	<div class="form-group">
		<input @empty($edit) checked @endempty @isset($edit) @if($item->downloadable) checked @endif @endisset onchange="isDownloadable(this)" type="checkbox" name="is_downloadable" value="1"/>
		<label for="is_downloadable">Is Downloadable *</label>
	</div>
	<div id="download_link" style="display:block" class="form-group">
		<label for="download_link">Download Link</label>
		<input @isset($edit) value="{{$item->download_link}}" @endisset type="text" name="download_link" placeholder="download_link"/>
	</div>
	<div class="form-group">
		<input @empty($edit) checked @endempty @isset($edit) @if($item->viewable) checked @endif @endisset onchange="isViewable(this)" type="checkbox" name="is_viewable" value="1"/>
		<label for="is_viewable">Is Viewable *</label>
	</div>
	<div id="view_link" style="display:block"class="form-group">
		<label for="view_link">View Link</label>
		<input @isset($edit) value="{{$item->view_link}}" @endisset type="text" name="view_link" placeholder="view_link"/>
	</div>
	<div class="form-group">
		<label for="readme">Description HTML</label>
		<textarea type="text" name="readme" placeholder="Description HTML">@empty($edit) @if($project->single_item_project){{$project->readme}} @endif @endempty @isset($edit) {{$item->readme}} @endisset </textarea>
	</div>
	<div class="form-group">
		<label for="keywords">Platform</label>
		<input type="text" name="platform" placeholder="Platform" value="@empty($edit) {{$project->platform}} @endempty @isset($edit) {{$item->platform}} @endisset "/>
	</div>
	<div class="form-group">
		<label for="image">Image Link</label>
		<input type="text" name="image" placeholder="Link" value="@empty($edit) {{$project->image}} @endempty @isset($edit) {{$item->image}} @endisset "/>
	</div>
	<div class="form-group">
		<label for="keywords">Keywords (Use ',' to seperate)</label>
		<input type="text" name="keywords" placeholder="Keywords" value="@empty($edit) {{$project->keywords}} @endempty @isset($edit) {{$item->keywords}} @endisset "/>
	</div>
	<div class="form-group">
		<label for="details">Other Details</label>
		<input id="details-cont" type="text" name="details" value="@empty($edit) {{$project->details}} @endempty @isset($edit) {{$item->details}} @endisset " hidden/>
		<table style="display:none" id="details-items" class="table">
			<tr class="head">
				<td>Key</td>
				<td>Value</td>
			</tr>
		</table>
		<div>
			<input id="key" style="width: calc(50% - 10px)" type="text" placeholder="Key"/>
	    	<input id="value" style="width: calc(50% - 10px)" placeholder="Value"/>
	    	<input style="position: relative; background: #12121290;color: #fff;width: 100px;right: 10px;" value="Add"onclick="addData(this)" type="button"/>
	    </div>
	</div>
	<input type="submit" value="Submit"/>
</form>
@endsection

@section("script")
otherDetails = {}
init();
function init()
{
   var item = document.getElementById("details-items")
   var cont = document.getElementById("details-cont")
	otherDetails = JSON.parse(cont.value);
	if(Object.keys(otherDetails).length > 0) item.style.display="table";
	for (var x in otherDetails){
	   var tr = document.createElement("tr");
   var elem = document.createElement("td");
   var elem2 = document.createElement("td");
   elem.textContent = x;
   elem2.textContent = otherDetails[x];
   tr.appendChild(elem)
   tr.appendChild(elem2)
   item.appendChild(tr)
	}
}
function addData(elem)
{
   var key = document.getElementById("key")
   var item = document.getElementById("details-items")
   var cont = document.getElementById("details-cont")
   var value = document.getElementById("value")
   item.style.display="table";
   var tr = document.createElement("tr");
   var elem = document.createElement("td");
   var elem2 = document.createElement("td");
   elem.textContent = key.value;
   elem2.textContent = value.value;
   tr.appendChild(elem)
   tr.appendChild(elem2)
   item.appendChild(tr)
   otherDetails[key.value] = value.value;
   cont.value = JSON.stringify(otherDetails);
   key.value = "";
   value.value = "";
}
function isDownloadable(elem)
{
    if(elem.checked)
    {
        document.getElementById("download_link").style.display = "block";
    }
    else{
        document.getElementById("download_link").style.display = "none";
    }
}
function isViewable(elem)
{
    if(elem.checked)
    {
        document.getElementById("view_link").style.display = "block";
    }
    else{
        document.getElementById("view_link").style.display = "none";
    }
}
function setDatePiker()
{
	picker = document.getElementById("created_date");
	cont = document.getElementById("created_date_cont");
	
	cont.onfocus = function (e)
	{
		picker.click();
	}
	picker.onchange = function()
	{
		cont.value = picker.value;
		picker.value = "";
	}
	cont.onchange = function()
	{
		alert(new Date(cont.value))
	}
}

setDatePiker();
@endsection