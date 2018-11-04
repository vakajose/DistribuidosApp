 function anadirPregunta(){
    var form = document.getElementById("form").innerHTML;
    var count = document.getElementById("countpregunta").value;
    count++;

    var container = document.createElement("div");
    container.setAttribute("id", "divpregunta"+count);
    container.innerHTML = '<h3 class="pull-left">Pregunta '+count+'</h3><input type="text"  class="form-control" id="pregunta'+ count+ '" name="pregunta'+count +'" required="required" placeholder="Pregunta '+count +'"> <br>';
    document.getElementById("form").appendChild(container);

    //Añadir pregunta al select
    var selectpregunta = document.getElementById("selectpregunta");
    selectpregunta.innerHTML = selectpregunta.innerHTML + '<option value="'+count+'">Pregunta '+count+'</option>';
    var selectpreguntadep  = document.getElementById("selectpreguntadep");
    selectpreguntadep.innerHTML = selectpreguntadep.innerHTML + '<option value="'+count+'">Pregunta '+count+'</option>';
    document.getElementById("countpregunta").value = count;

   }
   function anadirOpcion(){ //OPCION 1 = TEXTUAL, 2 = CHECKBOX
    var count = document.getElementById("countopcion").value;
    count++;
    var pregunta = document.getElementById( "selectpregunta" );
    pregunta = pregunta.options[ pregunta.selectedIndex ].value;
    var opcion = document.getElementById( "selectopcion" );
    opcion = opcion.options[ opcion.selectedIndex ].value;
    var opciontipodato = document.getElementById( "selectopciontipo" );
    opciontipodato = opciontipodato.options[ opciontipodato.selectedIndex ].value;
    var preguntaseleccionada = document.getElementById("divpregunta"+pregunta);
    var container = document.createElement("div");
    var multiple = 0;
    if (document.getElementById("multiplecheck").checked){
        multiple = 1;
    }
    //PANTALLEO
    var dominio = document.getElementById("opciondominio").value;
    var insert ='';
    if (opcion == 1) {
            insert = ''+dominio +'<center><input></center>';

    }else{
        var dom = dominio.split(',');
        for (var i = 0; i < dom.length; i++) {
            if(multiple == 0)
              insert = insert + '<label class="radio"> <input type="radio" disabled> <i></i>'+dom[i]+' </label>';  
            else
              insert = insert + '<label class="checkbox"> <input type="checkbox"> <i></i>'+dom[i]+' </label>';  
        }
        
    }
    if(dominio == ''){
        dominio = 'c';
        opciontipodato = 5;
    }
    container.innerHTML = '<input hidden="true" value="'+pregunta+'/'+opcion+'/'+multiple+'/'+dominio+'/'+opciontipodato+'" name="opcion'+count+'" id="opcion'+count+'">' + insert + '<br>';
    preguntaseleccionada.appendChild(container);
    //Añadir las preguntas y opciones a "Dependencia Select"
    var selectopciondep = document.getElementById("selectopciondep");
    selectopciondep.innerHTML = selectopciondep.innerHTML + '<option value="'+count+'">Pregunta '+pregunta+' - Opcion '+count+'</option>';
    document.getElementById("countopcion").value = count;


    
   }
   function anadirDependencia(){
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
        var multiplediv = document.getElementById("multiplediv");
        var dominioh = document.getElementById("dominioh");
        if (opcion == 1){
            x.style.display = "block";
            multiplediv.style.display = "none";
            dominioh.innerHTML = 'Ej. Dominio númerico: 1,10.';
        }else{
            x.style.display = "none";
            multiplediv.style.display = "block";
            dominioh.innerHTML = 'Escriba las opciones separada por coma. Ej: A,B,C,D'
        }
   }