@extends('layouts.dashboard')

@section('content')
<div id="header" class=" clearfix">

                
                <header id="topNav">
                    <div class="container">

                        <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                            <i class="fa fa-bars"></i>
                        </button>

                       
                        <a class="logo pull-left" href="usuario">
                            <img src="images/.png" alt=""  width="126px" height="26px" />
                        </a>

                    
                        <div class="navbar-collapse pull-right nav-main-collapse collapse">
                            <nav class="nav-main">

                                <ul id="topMain" class="nav nav-pills nav-main nav-onepage">
                                    
                                   
                                </ul>

                            </nav>
                        </div>

                    </div>
                </header>
              

            </div>
<section>
    <script type="text/javascript" src="js/distribuidos.js"></script>
    <div class="display-table" >
        <div class="display-table-cell vertical-align-middle">
            <div class="container" >
                    <div class="wrapper">
                        <div class="panel panel-default wow fadeInLeft" style="border-style: inset;">
                                <br>
                               
                            <div class="row" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-md-12" style="margin-right: : 80px;">
                                    <center>
                                        <h2>Crear Encuesta</h2>
                                   
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
                                    <button type="button" class="btn btn-info" onclick="anadirPregunta();">Añadir Pregunta</button>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-sm">Añadir Opcion</button>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg">Añadir Dependencia</button>
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
                <div class="fancy-form">
                    Seleccione la pregunta
                    <select class="form-control" id="selectpregunta">
                       
                    </select>
                   
                </div>
                <br>
                <div class="fancy-form">
                    Seleccione el tipo de opcion
                    <select class="form-control" id="selectopcion" onchange="onChangeOpcion();">
                        <option value="1">Abierta</option>
                        <option value="2">Cerrada</option>
                    </select>

                </div>
                <br>
                <div class="fancy-form" id="tipodatodiv">
                    Seleccione el tipo de dato
                    <select class="form-control" id="selectopciontipo" onchange="onChangeOpcionT();">
                        <option value="1">Númerico</option>
                        <option value="2">Fecha</option>
                        <option value="3">Email</option>
                        <option value="4">Telefono</option>
                        <option value="5">String</option>
                    </select>

                </div>
                <br>
                <div class="fancy-form" id="multiplediv" style="display: none;">
                    <label class="checkbox">
                        <input type="checkbox" name="multiplecheck" id="multiplecheck" value="1">
                        <i></i> Multiple
                    </label>

                </div>
                <br>
                 Escriba el dominio
                 <h4 id="dominioh">Ej. Dominio númerico: 1,10.
                 </h4>
                <input type="text" name="opciondominio" id="opciondominio" class="form-control">
                <br>
                <button type="button" class="btn btn-success"  data-dismiss="modal" onclick="anadirOpcion();">Añadir</button>
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
                <button type="button" class="btn btn-success"  data-dismiss="modal" onclick="anadirDependencia();">Añadir</button>
            </div>

        </div>
    </div>
</div>       
                
</section>
@endsection
