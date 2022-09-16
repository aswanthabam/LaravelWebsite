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
<center><h4>Add a version</h4></center>
@else
<center><h4>Add an Item to project</h4></center>
@endif
<form class="form-control" method="post" action="/admin/add/project/{{$project_id}}/item">
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
	<!--div class="form-group">
		<label for="project_id">Project ID</label>
		<input type="text" name="project_id" placeholder="Item ID"/>
	</div-->
	@if(!$project->single_item_project)
	<div class="form-group">
		<label for="name">Item Name</label>
		<input type="text" name="name" placeholder="Item Name"/>
	</div>
	@endif
	<div class="form-group">
		<label for="version">Release Name *</label>
		<input type="text" name="release_name" placeholder="Release" required/>
	</div>
	<div class="form-group">
		<label for="version">Item Version *</label>
		<input type="text" name="version" placeholder="Version" required/>
	</div>
	
	<div class="form-group">
		<label for="description">Item Description *</label>
		<input type="text" name="description" placeholder="Description"@if(session("description")) value="{{session("description")}}" @endif required/>
	</div>
	<div class="form-group">
		<label for="author">Item Author</label>
		<input type="text" name="author" placeholder="Author"@if(session("author")) value="{{session("author")}}" @endif/>
	</div>
	<div class="form-group">
		<label for="created_date">Created Date</label>
		<input class="form-item-sided" id="created_date_cont" type="text" name="created_date" placeholder="Created Date" @if(session("created_at")) value="{{session("created_at")}}" @endif/>
		<input class="form-item-sided-cont" id="created_date" type="date"/>
	</div>
	<div class="form-group">
		<input type="checkbox" name="is_latest" value="yes"/>
		<label for="is_latest">Is Latest *</label>
	</div>
	<div class="form-group">
		<input onchange="isDownloadable(this)" type="checkbox" name="is_downloadable" value="yes"/>
		<label for="is_downloadable">Is Downloadable *</label>
	</div>
	<div id="download_link" style="display:none" class="form-group">
		<label for="download_link">Download Link</label>
		<input type="text" name="download_link" placeholder="download_link"/>
	</div>
	<div class="form-group">
		<input onchange="isViewable(this)" type="checkbox" name="is_viewable" value="yes"/>
		<label for="is_viewable">Is Viewable *</label>
	</div>
	<div id="view_link" style="display:none"class="form-group">
		<label for="view_link">View Link</label>
		<input type="text" name="View link" placeholder="view_link"/>
	</div>
	<div class="form-group">
		<label for="readme">Readme File URL</label>
		<input type="text" name="readme" placeholder="Readme file link"/>
	</div>
	<div class="form-group">
		<label for="keywords">Platform</label>
		<input type="text" name="platform" placeholder="Platform"@if(session("platform")) value="{{session("platform")}}" @endif/>
	</div>
	<div class="form-group">
		<label for="keywords">Keywords (Use ',' to seperate)</label>
		<input type="text" name="keywords" placeholder="Keywords"@if(session("keywords")) value="{{session("keywords")}}" @endif/>
	</div>
	<div class="form-group">
		<label for="details">Other Details</label>
		<input id="details-cont" type="text" name="details" @if(session("details")) value="{{session("details")}}" @endif hidden/>
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
otherDetails = {}
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