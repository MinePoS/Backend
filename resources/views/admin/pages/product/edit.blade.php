@extends('admin.layout')

@section('title')
Edit {{$product->name}}
@endsection

@section('desc')
Yay! Donation Perks
@endsection

@section('content')
@if((count(\App\Category::all()) == 0) || (count(\App\Server::all()) == 0))
  <div class="col-md-12">
    <div class="alert alert-warning" role="alert">
      You can't create a product until you have created a category and server
    </div>
  </div> 
@else
<div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header with-border">
              <h3 class="card-title">Editing {{$product->name}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('admin.products.edit',['product'=>$product])}}" method="POST">
              {{csrf_field()}}
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input class="form-control" name="name" id="name" value="{{$product->name}}" placeholder="Product Name" required>
                </div>

                <div class="form-group">
                  <label for="desc">Description</label>
                    <textarea id="desc" name="desc" rows="10" cols="80" style="visibility: hidden; display: none;"> 
                      {!! $product->description !!}
                    </textarea>
                </div>

               <div class="form-group">
                  <label for="image">Image</label>
                  <input class="form-control" name="image" value="{{$product->image}}" id="image" placeholder="Image (TEMP UNTIL I CODE UPLOAD SYSTEM)" required>
                </div>

               <div class="form-group">
                  <label for="name">Price</label>
                  <input class="form-control" name="price" type="number" value="{{$product->price}}" step="0.01">
                </div>


  <div class="form-group command-inputs">

<?php $commands = json_decode($product->commands,true); ?>

  <div class="server-selector form-group">
     <label>Commands</label><br>
    <select class="form-control">
      @if(! isset($commands['-1']))
      <option value="-1">All Servers</option>
      @endif
      <?php $servers = \App\Server::all();?>
      @foreach($servers as $server)
        @if(! isset($commands[$server['id']]))
          <option value="{{$server->id}}">{{$server->name}}</option>
        @endif
      @endforeach
    </select>
    <a class="btn btn-success add-server"><i class="fa fa-plus" aria-hidden="true"></i></a>
  </div>
  <div class="server-sections row"></div>

</div>  

 <div class="form-group">
                  <label for="parent">Category</label>
                  <br>
                  <select class="parent" id="parent" name="parent">
                @foreach(\App\Category::all() as $category)
                  @if($category->parent_id == null)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endif
                       @endforeach
          </select>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Create</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        @endif
@endsection

@section('head')
  <link rel="stylesheet" href="/admin/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">
    <style type="text/css">
      .select2-container {
  margin: 0;
}
    </style>

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
@endsection

@section('extra')
  <script src="/admin/plugins/iCheck/icheck.min.js"></script>
  <script src="/admin/plugins/ckeditor/ckeditor.js"></script>
  <script src="/admin/bower_components/select2/dist/js/select2.full.min.js"></script>

<script type="text/javascript">
  function setupCommandEvents(){
  $(".command-inputs .server-selector").find("select").click(function(event){
    
  });
  
  $(".command-inputs .add-server").click(function(event){
    var sel = $(event.target).parent().find("select").find(":selected");
    // if( $(sel).attr("disabled") == "disabled"){
    //  return;
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

  return command;
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
  return section;
}


  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('desc');
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

    $('.parent').select2();

    setupCommandEvents();


     @foreach($commands as $key => $command)
        console.log({{$key}});
      <?php $server = \App\Server::find($key); ?>
     @if(!($server == null))
        var section = makeCommandsSection({{$key}}, "{{$server->name}}");
        @foreach($command as $cmd)
        var command = addCommand(section);
          $(command).find("input").val("{{$cmd}}");
        @endforeach
      @endif
    @endforeach
  })



</script>
@endsection


@section('extra')



</script>
@endsection