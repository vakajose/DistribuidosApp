@extends('layouts.dashboard')

@section('content')
<div id="header" class=" clearfix">

           
                <header id="topNav">
                    <div class="container">

                        <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                            <i class="fa fa-bars"></i>
                        </button>

                       
                        <a class="logo pull-left" href="usuario">
                            <img src="images/logo.png" alt=""  width="126px" height="26px" />
                        </a>

                    
                        <div class="navbar-collapse pull-right nav-main-collapse collapse">
                            <nav class="nav-main">

                                <ul id="topMain" class="nav nav-pills nav-main nav-onepage">
                                    <li class=""><!-- HOME -->
                                        <a href="/">
                                            Home
                                        </a>
                                    </li>
                                    <li><!-- FEATURES -->
                                        <a href="showSalas">
                                            Ver mis salas
                                        </a>
                                    </li>
                                   
                                </ul>

                            </nav>
                        </div>

                    </div>
                </header>
              

            </div>
<section>
    <div class="display-table" >
        <div class="display-table-cell vertical-align-middle">
            <div class="container" >
                    <div class="wrapper">
                        <div class="panel panel-default wow fadeInLeft" style="border-style: inset;">
                                <br>
                               <center><h2>Lista de encuentas   </h2></center>
                            <div class="row" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-md-6">
                                    <center>
                                    <button type="button" class="btn btn-success" onclick="añadirPregunta();">Añadir Pregunta</button>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm">Añadir Opcion</button>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Añadir Dependencia</button>
                                    <br>
                                    <br>
                                    <form class="form-horizontal" role="form" method="POST" action="crearencuesta" name="form">
                                        <input hidden="true" value="0" name="countpregunta" id="countpregunta">
                                        <input hidden="true" value="0" name="countopcion" id="countopcion">
                                        <input hidden="true" value="0" name="countdependencia" id="countdependencia">  
                                    {{ csrf_field() }}
                                    <center id="form">
                                    <input type="text"  class="form-control" name="titulo" placeholder="Titulo" required="required">
                                    <br>
                                    <input type="text" class="form-control" name="descripcion" placeholder="Descripción" required="required">
                                    <br>
                                    </center>
                                    <button type="submit" class="btn btn-success">Crear</button>
                                    </form>
                                    </center>
                                    
                                </div>                
                            </div>
                        </div>
                    </div>
            </div>
                
        </div>
    </div>
<script type="text/javascript">
   function añadirPregunta(){
    var form = document.getElementById("form").innerHTML;
    var count = document.getElementById("countpregunta").value;
    count++;

    var container = document.createElement("div");
    container.setAttribute("id", "divpregunta"+count);
    container.innerHTML = '<input type="text"  class="form-control" id="pregunta'+ count+ '" name="pregunta'+count +'" required="required" placeholder="Pregunta '+count +'"> <br>';
    document.getElementById("form").appendChild(container);

    //Añadir pregunta al select
    var selectpregunta = document.getElementById("selectpregunta");
    selectpregunta.innerHTML = selectpregunta.innerHTML + '<option value="'+count+'">Pregunta '+count+'</option>';
    var selectpreguntadep  = document.getElementById("selectpreguntadep");
    selectpreguntadep.innerHTML = selectpreguntadep.innerHTML + '<option value="'+count+'">Pregunta '+count+'</option>';
    document.getElementById("countpregunta").value = count;

   }
   function añadirOpcion(){ //OPCION 1 = TEXTUAL, 2 = CHECKBOX
    var count = document.getElementById("countopcion").value;
    count++;
    var pregunta = document.getElementById( "selectpregunta" );
    pregunta = pregunta.options[ pregunta.selectedIndex ].value;
    var opcion = document.getElementById( "selectopcion" );
    opcion = opcion.options[ opcion.selectedIndex ].value;
    var opciontipodato = document.getElementById( "selectopciontipo" );
    opciontipodato = opciontipodato.options[ opciontipodato.selectedIndex ].value;

    var descripcion = document.getElementById("opciondescripcion").value;
    var insert ='';
    if (opcion == 1) {
        insert = ''+descripcion +'<center><input></center>';
    }else{
        insert = '<label class="checkbox"> <input type="checkbox"> <i></i>'+descripcion+' </label>';
    }
    var preguntaseleccionada = document.getElementById("divpregunta"+pregunta);
    var container = document.createElement("div");
    container.innerHTML = '<input hidden="true" value="'+pregunta+'/'+opcion+'/'+descripcion+'/'+opciontipodato+'" name="opcion'+count+'" id="opcion'+count+'">' + insert + '<br>';
    preguntaseleccionada.appendChild(container);
    //Añadir las preguntas y opciones a "Dependencia Select"
    var selectopciondep = document.getElementById("selectopciondep");
    selectopciondep.innerHTML = selectopciondep.innerHTML + '<option value="'+count+'">Pregunta '+pregunta+' - Opcion '+count+'</option>';
    document.getElementById("countopcion").value = count;
   }
   function añadirDependencia(){
    var count = document.getElementById("countdependencia").value;
    count++;
    var pregunta = document.getElementById( "selectpreguntadep" );
    pregunta = pregunta.options[ pregunta.selectedIndex ].value;
    var opcion = document.getElementById( "selectopciondep" );
    opcion = opcion.options[ opcion.selectedIndex ].value;
    var container = document.createElement("div");
    container.innerHTML = '<input id="dependencia'+ count+ '" name="dependencia'+count +'" value="'+pregunta+'/'+opcion+'"> <br>';
    document.getElementById("form").appendChild(container);
    document.getElementById("countdependencia").value = count;
   } 



   function onChangeOpcion(){
        var opcion = document.getElementById( "selectopcion" );
        opcion = opcion.options[ opcion.selectedIndex ].value;
        var x = document.getElementById("tipodatodiv");
        if (opcion == 1){
            x.style.display = "block";
            
        }else{
            x.style.display = "none";
        }
   }
</script>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- header modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mySmallModalLabel">Añadir Opcion</h4>
            </div>

            <!-- body modal -->
            <div class="modal-body">
                <div class="fancy-form fancy-form-select">
                    Seleccione la pregunta
                    <select class="form-control" id="selectpregunta">
                       
                    </select>
                   
                </div>
                <br>
                <div class="fancy-form fancy-form-select">
                    Seleccione el tipo de opcion
                    <select class="form-control" id="selectopcion" onchange="onChangeOpcion();">
                        <option value="1">Textual</option>
                        <option value="2">Checkbox</option>
                    </select>

                </div>
                <br>
                <div class="fancy-form fancy-form-select" id="tipodatodiv">
                    Seleccione el tipo de dato
                    <select class="form-control" id="selectopciontipo" onchange="onChangeOpcion();">
                        <option value="1">Númerico</option>
                        <option value="2">Fecha</option>
                        <option value="3">Email</option>
                        <option value="4">Telefono</option>
                        <option value="5">String</option>
                    </select>

                </div>
                <br>
                 Descripción de la opción
                <input type="text" name="opciondescripcion" id="opciondescripcion" class="form-control">
                <br>
                <button type="button" class="btn btn-success"  data-dismiss="modal" onclick="añadirOpcion();">Añadir</button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- header modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mySmallModalLabel">Añadir dependencia</h4>
            </div>

            <!-- body modal -->
            <div class="modal-body">
                <div class="fancy-form fancy-form-select">
                    Seleccione la pregunta
                    <select class="form-control" id="selectpreguntadep">
                       
                    </select>
                   
                </div>
                <br>
                <div class="fancy-form fancy-form-select">
                    Seleccione el tipo de opcion
                    <select class="form-control select" id="selectopciondep">
                    </select>

                </div>
                <br>
                <button type="button" class="btn btn-success"  data-dismiss="modal" onclick="añadirDependencia();">Añadir</button>
            </div>

        </div>
    </div>
</div>       
                
</section>
@endsection
