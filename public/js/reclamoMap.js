$(function () {
    
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
        //iteramos sobre los reclamos para poblar el mapa
        // console.log(reclamos);
        // for (var i = 0; i <reclamos.length ; i++) {
        //   $reclamo = reclamos[i];
        //   var marker = {lat: parseFloat($reclamo.latitud), lng: parseFloat($reclamo.longitud)};

        //   addMarker(marker,$reclamo);
          
        //   console.log(marker);
        // }
        
        

  }
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
        //iteramos sobre los reclamos para poblar el mapa
        console.log(reclamos);
        for (var i = 0; i <reclamos.length ; i++) {
          $reclamo = reclamos[i];
          var marker = {lat: parseFloat($reclamo.latitud), lng: parseFloat($reclamo.longitud)};

          addMarker(marker,$reclamo);
          
          console.log(marker);
        }
        
        

  }

  // añande los marcadores al mapa y los guarda en el array.
      function addMarker(location,reclamo) {

        var infowindow = new google.maps.InfoWindow({
          content: getInfoString(reclamo),
        });
  

        var marker = new google.maps.Marker({
          position: location,
          map: map,
          label: $reclamo.id.toString(),
          title: $reclamo.descripcion,
        });
        markers.push(marker);
        
         marker.addListener('click', function() {
          infowindow.open(marker.get('map'), marker);
        });
      }
    
      function getInfoString(reclamo) {
        var infostring = reclamo.descripcion;
        return infostring;
      }
