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
@section("brand-name")
Admin Panel
@endsection
@section("body")
<center><h4>@empty($edit)Add a new project @endempty @isset($edit)Edit Project @endisset </h4></center>
<form id="form" class="form-control" method="post" action="@empty($edit)/admin/add/project @endempty @isset($edit)/admin/edit/project/{{$project->project_id}}@endisset">
	<div id="alert-error"style="display:@if ($errors->any())block;@else none;@endif" class="alert alert-danger">
        <ul id="errors">
        	@if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            @endif
        </ul>
    </div>
	@csrf
	
	@empty($edit)
	<div class="form-group">
		<label for="project_id">Project ID *</label>
		<input onchange="idEvaluate(this)" type="text" name="project_id" placeholder="Project ID" required/>
	</div>
	@endempty
	<div class="form-group">
		<label for="name">Project Name *</label>
		<input @isset($edit) value="{{$project->name}}" @endisset type="text" name="name" placeholder="Project Name" required/>
	</div>
	<div class="form-group">
		<label for="version">Project Version *</label>
		<input @isset($edit) value="{{$project->version_name}}" @endisset type="text" name="version" placeholder="Version" required/>
	</div>
	<div class="form-group">
		<label for="description">Project Description *</label>
		<input @isset($edit) value="{{$project->description}}" @endisset type="text" name="description" placeholder="Description" required/>
	</div>
	<div class="form-group">
		<label for="author">Project Author</label>
		<input @isset($edit) value="{{$project->author}}" @endisset type="text" name="author" placeholder="Author"/>
	</div>
	<div class="form-group">
		<label for="author_link">Author URL</label>
		<input @isset($edit) value="{{$project->author_link}}" @endisset type="text" name="author_link" placeholder="Author Link"/>
	</div>
	<div class="form-group">
		<label for="created_date">Created Date</label>
		<input @isset($edit) value="{{$project->created_at}}" @endisset class="form-item-sided" id="created_date_cont" type="text" name="created_date" placeholder="Created Date"/>
		<input class="form-item-sided-cont" id="created_date" type="date"/>
	</div>
	<div class="form-group">
		<input @isset($edit) @if($project->single_item_project) checked @endif @endisset type="checkbox" name="single_item_project" value="1"/>
		<label for="single_item_project">Single Item Project *</label>
	</div>
	<div class="form-group">
		<label for="readme">Description HTML</label>
		<textarea type="text" name="readme" placeholder="Description HTML">@isset($edit){{$project->readme}}@endisset</textarea>
	</div>
	<div class="form-group">
		<label for="keywords">Keywords (Use ',' to seperate)</label>
		<input @isset($edit) value="{{$project->keywords}}" @endisset type="text" name="keywords" placeholder="Keywords"/>
	</div>
	<div class="form-group">
		<label for="platform">Platform</label>
		<input @isset($edit) value="{{$project->platform}}" @endisset type="text" name="platform" placeholder="platform"/>
	</div>
	<div class="form-group">
		<label for="image">Project Image</label>
		<input @isset($edit) value="{{$project->image}}" @endisset type="text" name="image" placeholder="Image url"/>
	</div>
	<div class="form-group">
		<label for="details">Other Details</label>
		<input @isset($edit) value="{{$project->details}}" @endisset id="details-cont" type="text" name="details" hidden/>
		<table style="display:@empty($edit) none @endempty @isset($edit) table @endisset" id="details-items" class="table">
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
	
	<input id="submit" type="submit" value="Submit"/>
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
function idEvaluate(elem)
{
    var form = document.getElementById("form");
    var submit = document.getElementById("submit");
    var errors = document.getElementById("errors");
    var alertError = document.getElementById("alert-error");
    if(elem.value.includes(" ") || elem.value.includes("/") || elem.value.includes("&") || elem.value.includes("?") || elem.value.includes(".") || elem.value.includes("#"))
    {
        form.disabled = true;
        submit.style.display = "none";
        alertError.style.display = "block";
        errors.innerHTML += "<li>Cannot use space and special characters ('&','/','#' etc) in Project Id</li>";
    }
    else 
    {
        form.disabled = false;
        submit.style.display = "block";
        alertError.style.display = "none";
        errors.innerHTML = "";
    }
    elem.value = elem.value.toLowerCase();
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