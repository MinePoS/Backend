@extends('admin.layout')

@section('title')
Dashboard
@endsection

@section('desc')
All the important stuff in one place
@endsection

@section('content')

<div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Info</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Today</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">7 Days</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">30 Days</a></li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                   @include("admin.parts.dashboard.infobar", ["days"=>1])
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    @include("admin.parts.dashboard.infobar", ["days"=>7])
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    @include("admin.parts.dashboard.infobar", ["days"=>30])
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>



<!-- <form action="{{route('admin.dd')}}" method="POST" class="form">
	{{csrf_field()}}
	<div class="form-group command-inputs">

	<div class="server-selector form-group">
		<select class="form-control">
			<option value="-1">All Servers</option>
			<?php $servers = \App\Server::all();?>
			@foreach($servers as $server)
			<option value="{{$server->id}}">{{$server->name}}</option>
			@endforeach
		</select>
		<a class="btn btn-success add-server"><i class="fa fa-plus" aria-hidden="true"></i></a>
	</div>
	<div class="server-sections row"></div>
</div>	
	

<input type="submit" class="btn btn-success" name="Submit">
</form> -->
@endsection


@section('extra')
<style>
.command .form-group {
    width: 80%;
    display: inline-block;
}
.command .btn {
    width: 15%;
}
.server-selector select {
    width: calc(100% - 80px);
    display: inline-block;

}
.server-selector a {
    width: 37px;
    display: inline-block;
}
</style>

<script>
function setupCommandEvents(){
	$(".command-inputs .server-selector").find("select").click(function(event){
		
	});
	
	$(".command-inputs .add-server").click(function(event){
		var sel = $(event.target).parent().find("select").find(":selected");
		// if( $(sel).attr("disabled") == "disabled"){
		// 	return;
		// }
		if($(sel)[0].value == "None"){
			$(".command-inputs .add-server").off();
			$(".command-inputs .add-server").remove();
			return;
		}
		makeCommandsSection($(sel)[0].value, $(sel)[0].innerHTML);
		$(sel)[0].value;
		$(sel)[0].remove();
		if($(event.target).parent().find("select").find(":selected").length == 0){
			var option = document.createElement("option");
			option.text = "None";
			$(event.target).parent().find("select")[0].add(option); 
			$(event.target).parent().find("select").attr("disabled",1);
			$(event.target).attr("disabled",1);
			return;
		}
		
	});
	

}
function addCommand(element){
	var sid = $(element).parent().attr("serverid");
	var sname = $(element).parent().attr("servername");
	
	var list = $(element).parent().find(".command-list")[0];
	
	var command = document.createElement("div");
	command.setAttribute("class","command");
	var text = document.createElement("input");
	text.setAttribute("name","commands["+sid+"][]");
	text.setAttribute("class","form-control form-group");
	var remove = document.createElement("a");
	remove.innerHTML = "<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>";
	remove.setAttribute("class","btn btn-danger");
	remove.setAttribute("onClick","$(this).parent().remove()");
	command.appendChild(text);
	command.appendChild(remove);
	
	list.append(command);
}
function makeCommandsSection(id, name){
	var section = document.createElement("section");
		section.setAttribute('serverid', id);
		section.setAttribute('servername', name);
		section.setAttribute('class', "form-group col-sm-3");
	
	var header = document.createElement("h4");
		header.innerHTML = name;
	section.appendChild(header);
		
	var addBtn = document.createElement("a");
		addBtn.innerHTML = "<i class=\"fa fa-plus\" aria-hidden=\"true\"></i>";
		addBtn.setAttribute("onclick","addCommand(this)");
		addBtn.setAttribute("class","btn btn-success");
	section.appendChild(addBtn);
	
	var commandsList = document.createElement("div");
		commandsList.setAttribute("class","command-list");
	section.appendChild(commandsList);
	
	document.getElementsByClassName("server-sections")[0].append(section);
}

setupCommandEvents();
</script>
@endsection