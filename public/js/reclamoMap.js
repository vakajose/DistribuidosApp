$(function () {


    $('#reclamos_table').DataTable({
    });
      
    
    setInterval(actualizarMapa, 2000);


  });
      var map;
      var markers = [];
// Inicializar mapa
  function initMap() {
       var centro = {lat: -17.783370, lng: -63.180207};
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15, 
          center: centro,
          mapTypeId: 'terrain'
        });
        actualizarMapa();
  }

  
  // añande los marcadores al mapa y los guarda en el array.
      function addMarker(location,ubi) {

        var infowindow = new google.maps.InfoWindow({
          content: getInfoString(ubi),
        });
  

        var marker = new google.maps.Marker({
          position: location,
          map: map,
          label: ubi['user_id'].toString(),
          title: ubi['created_at'],
        });
        markers.push(marker);
        
         marker.addListener('click', function() {
          infowindow.open(marker.get('map'), marker);
        });
      }
    
      function getInfoString(ubi) {
        var infostring = ubi['created_at'];
        return infostring;
      }

  function actualizarMapa(){

    $.ajax({
      url: 'getusers'
    }).done(function(users){
       $.ajax({
          url:'getubicaciones/online'}).done(function(ubicaciones) {
            
          var jusers = JSON.parse(users);
          var jubicaciones = JSON.parse(ubicaciones);
          jusers.forEach( function(usr, index) {
           //actualizamos estado de cada usuario
              $('#estado-'+usr['id']).removeClass('online');
              $('#estado-'+usr['id']).removeClass('offline');
              $('#estado-'+usr['id']).removeClass('suspend');
              $('#estado-'+usr['id']).addClass(usr['estado']);
          });
          markers = [];
          jubicaciones.forEach( function(ubi, index) {
            var marker = {lat: parseFloat(ubi['latitud']), lng: parseFloat(ubi['longitud'])};
            addMarker(marker,ubi);
          });
          console.log("actualizado")
       });
    }).fail(function(data) {
      console.log(data);
    });
  }