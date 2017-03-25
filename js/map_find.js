 function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
		var loadLat = $("#load_lat").val();
		var loadLan = $("#load_lan").val();
        var center = new GLatLng(loadLat, loadLan);
        map.setCenter(center, 15);
        geocoder = new GClientGeocoder();
        var marker = new GMarker(center, {draggable: true});  
        map.addOverlay(marker);
        document.getElementById("lat").innerHTML = center.lat().toFixed(5);
        document.getElementById("lng").innerHTML = center.lng().toFixed(5);

	  GEvent.addListener(marker, "dragend", function() {
       var point = marker.getPoint();
	      map.panTo(point);
       document.getElementById("lat").innerHTML = point.lat().toFixed(5);
       document.getElementById("lng").innerHTML = point.lng().toFixed(5);

        });


	 GEvent.addListener(map, "moveend", function() {
		  map.clearOverlays();
    var center = map.getCenter();
		  var marker = new GMarker(center, {draggable: true});
		  map.addOverlay(marker);
		  document.getElementById("lat").innerHTML = center.lat().toFixed(5);
	   document.getElementById("lng").innerHTML = center.lng().toFixed(5);


	 GEvent.addListener(marker, "dragend", function() {
      var point =marker.getPoint();
	     map.panTo(point);
      document.getElementById("lat").innerHTML = point.lat().toFixed(5);
	     document.getElementById("lng").innerHTML = point.lng().toFixed(5);

        });
 
        });

      }
}

function showAddress(evt) {
		load();
		var address = $(evt).val();
		var city = $(evt).parents('li').prev().find('select option:selected').text();
		var state = $(evt).parents('li').prev().prev().find('select option:selected').text();
		var country = $(evt).parents('li').prev().prev().prev().prev().find('select option:selected').text();
//		var country = 'Malaysia';
		address = address+','+city+','+state+','+country;
	   var map = new GMap2(document.getElementById("map"));
       map.addControl(new GSmallMapControl());
       map.addControl(new GMapTypeControl());
       if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert("Address "+address + " not found");
            } else {
		  document.getElementById("lat").innerHTML = point.lat().toFixed(5);
		  $("#latitude").val(point.lat().toFixed(5));
	   document.getElementById("lng").innerHTML = point.lng().toFixed(5);
	   $("#longitude").val(point.lng().toFixed(5));
		 map.clearOverlays()
			map.setCenter(point, 14);
   var marker = new GMarker(point, {draggable: true});  
		 map.addOverlay(marker);

		GEvent.addListener(marker, "dragend", function() {
      var pt = marker.getPoint();
	     map.panTo(pt);
      document.getElementById("lat").innerHTML = pt.lat().toFixed(5);
	     document.getElementById("lng").innerHTML = pt.lng().toFixed(5);
        });


	 GEvent.addListener(map, "moveend", function() {
		  map.clearOverlays();
    var center = map.getCenter();
		  var marker = new GMarker(center, {draggable: true});
		  map.addOverlay(marker);
		  document.getElementById("lat").innerHTML = center.lat().toFixed(5);
	   document.getElementById("lng").innerHTML = center.lng().toFixed(5);

	 GEvent.addListener(marker, "dragend", function() {
     var pt = marker.getPoint();
	    map.panTo(pt);
    document.getElementById("lat").innerHTML = pt.lat().toFixed(5);
	   document.getElementById("lng").innerHTML = pt.lng().toFixed(5);
        });
 
        });

            }
          }
        );
      }
    }
	
	
function loadMap() {
		//alert('Hi');
		load();return false;
		//var address = $("#txtEmail").val();
		var city = $(".city_sel option:selected").text();
		var state = $(".state_sel option:selected").text();
		var country = $(".chzn-select option:selected").text();
		alert(city+state+country);return false;
		address = address+','+city+','+state+','+country;
	   var map = new GMap2(document.getElementById("map"));
       map.addControl(new GSmallMapControl());
       map.addControl(new GMapTypeControl());
       if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert("Address "+address + " not found");
            } else {
		  document.getElementById("lat").innerHTML = point.lat().toFixed(5);
		  $("#latitude").val(point.lat().toFixed(5));
	   document.getElementById("lng").innerHTML = point.lng().toFixed(5);
	   $("#longitude").val(point.lng().toFixed(5));
		 map.clearOverlays()
			map.setCenter(point, 14);
   var marker = new GMarker(point, {draggable: true});  
		 map.addOverlay(marker);

		GEvent.addListener(marker, "dragend", function() {
      var pt = marker.getPoint();
	     map.panTo(pt);
      document.getElementById("lat").innerHTML = pt.lat().toFixed(5);
	     document.getElementById("lng").innerHTML = pt.lng().toFixed(5);
        });


	 GEvent.addListener(map, "moveend", function() {
		  map.clearOverlays();
    var center = map.getCenter();
		  var marker = new GMarker(center, {draggable: true});
		  map.addOverlay(marker);
		  document.getElementById("lat").innerHTML = center.lat().toFixed(5);
	   document.getElementById("lng").innerHTML = center.lng().toFixed(5);

	 GEvent.addListener(marker, "dragend", function() {
     var pt = marker.getPoint();
	    map.panTo(pt);
    document.getElementById("lat").innerHTML = pt.lat().toFixed(5);
	   document.getElementById("lng").innerHTML = pt.lng().toFixed(5);
        });
 
        });

            }
          }
        );
      }
    }
