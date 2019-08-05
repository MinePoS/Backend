@extends('adminlte::page')

@section('title', 'Products')

@section('content')
<div class="row">
	<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
               @if($product->name == "")
              	<h3 class="box-title">Creating new product</h3>
              @else
              	<h3 class="box-title">Editing '{{$product->name}}'</h3>
              @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @if($product->name != null)
			 {{\Form::model($product, array('route' => array('admin.products.update', $product->id)),["class"=>"form-horizontal"])}}
			@else
			 {{\Form::model($product, array('route' => array('admin.products.store')),["class"=>"form-horizontal"])}}
			@endif
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                	{{ Form::label('name', 'Product Name')}}
					{{ Form::text('name', null,["class"=>"form-control","required"]) }}
                </div>

                <div class="form-group">
                	{{ Form::label('short_desc', 'Short Description')}}
					{{ Form::text('short_desc', null,["class"=>"form-control","required"]) }}
                </div>

                <div class="form-group">
                  <label for="desc">Description</label>
                    <textarea id="desc" name="desc" rows="10" cols="80" style="visibility: hidden; display: none;"> 
                      {!! $product->description !!}
                    </textarea>
      

               <div class="form-group">
                  <div class="form-group">
                	{{ Form::label('image', 'Image')}}
					{{ Form::text('image', "https://via.placeholder.com/150",["class"=>"form-control","required"]) }}
                </div>
                </div>

               <div class="form-group">
                 {{ Form::label('price', 'Price')}}
					{{ Form::number('price', null,["class"=>"form-control","required"]) }}
                </div>


  <div class="form-group command-inputs">

<?php $commands = json_decode($product->commands,true); ?>

  <div class="server-selector form-group">
     <label>Commands</label><br>
     <div class="form-row">
    <select style="width: calc( 100% - 40px);display:inline-block" class="form-control">
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
    <a style="max-width:38px"class="btn btn-success add-server"><i class="fa fa-plus" aria-hidden="true"></i></a>
  </div>
  </div>
  <div class="server-sections row"></div>

</div>  

 <div class="form-group">
                  <label for="parent">Category</label>
                  <br>
                  <select style="width:100%" class="parent" id="parent" name="parent">
                @foreach(\App\Category::all() as $category)
                  @if($category->parent_id == null)
                    <option value="{{$category->id}}" @if($category->id == $product->category_id) selected=true @endif>{{$category->name}}</option>
                  @endif
                       @endforeach
          </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
</div>
@stop
@section('js')
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
  window.tmp = element;
  var sid = $(element).parent().attr("serverid");
  var sname = $(element).attr("servername");
  
  var list = $(element).parent().find(".command-list")[0];
  
  var command = document.createElement("div");
  command.setAttribute("class","command");
  var text = document.createElement("input");
  text.setAttribute("name","commands["+sid+"][]");
  text.setAttribute("class","form-control form-group");
  text.setAttribute("style","max-width: calc( 100% - 40px ); display: inline-block;");
  var remove = document.createElement("a");
  remove.innerHTML = "<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>";
  remove.setAttribute("class","btn btn-danger");
  remove.setAttribute("style","width: 38px;display: inline-block;");
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
    header.setAttribute = "display: inline-block;margin-right: 10px;";
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
    });
    $('.parent').select2();
    setupCommandEvents();
    
    
    @if(is_array($commands))

        @foreach($commands as $key => $command)
        console.log({{$key}});
      <?php $server = \App\Server::find($key); ?>
     @if(!($server == null))
        var section = makeCommandsSection({{$key}}, "{{$server->name}}");
        window.sec = section;
        console.log("called");
        @foreach($command as $cmd)
        var command = addCommand(section);
          $(command).find("input").val("{{$cmd}}");
        @endforeach
      @endif
    @endforeach
    @endif

  })
</script>
@stop
@section('css')

@stop