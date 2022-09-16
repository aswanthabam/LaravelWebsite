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
<center><h4>Add a new project</h4></center>
<form class="form-control" method="post" action="/admin/add/project">
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
		<label for="project_id">Project ID *</label>
		<input type="text" name="project_id" placeholder="Project ID" required/>
	</div>
	<div class="form-group">
		<label for="name">Project Name *</label>
		<input type="text" name="name" placeholder="Project Name" required/>
	</div>
	<div class="form-group">
		<label for="version">Project Version *</label>
		<input type="text" name="version" placeholder="Version" required/>
	</div>
	<div class="form-group">
		<label for="description">Project Description *</label>
		<input type="text" name="description" placeholder="Description" required/>
	</div>
	<div class="form-group">
		<label for="author">Project Author</label>
		<input type="text" name="author" placeholder="Author"/>
	</div>
	<div class="form-group">
		<label for="created_date">Created Date</label>
		<input class="form-item-sided" id="created_date_cont" type="text" name="created_date" placeholder="Created Date"/>
		<input class="form-item-sided-cont" id="created_date" type="date"/>
	</div>
	<div class="form-group">
		<input type="checkbox" name="single_item_project" value="1"/>
		<label for="single_item_project">Single Item Project *</label>
	</div>
	<div class="form-group">
		<label for="readme">Readme File URL</label>
		<input type="text" name="readme" placeholder="Readme file link"/>
	</div>
	<div class="form-group">
		<label for="keywords">Keywords (Use ',' to seperate)</label>
		<input type="text" name="keywords" placeholder="Keywords"/>
	</div>
	<div class="form-group">
		<label for="platform">Platform</label>
		<input type="text" name="platform" placeholder="platform"/>
	</div>
	<div class="form-group">
		<label for="details">Other Details</label>
		<input id="details-cont" type="text" name="details" hidden/>
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