 
function showAddress(evt) {
		var country = $(evt).parents('form').find('#country option:selected').text();
		var state = $(evt).parents('form').find('#state option:selected').text();
		var city = $(evt).parents('form').find('#city option:selected').text();
		var street = $(evt).parents('form').find('#address').val();
		var zip = $(evt).parents('form').find('#post_code').val();
//		var country = 'Malaysia';
		address = street+','+city+','+state+','+country+' '+zip;
	   var map = new GMap2(document.getElementById("map"));
       map.addControl(new GSmallMapControl());
       map.addControl(new GMapTypeControl());
       if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert("Address "+address + " not found");
              return false;
            } else {
            	$("#latitude").val(point.lat().toFixed(5));
            	$("#longitude").val(point.lng().toFixed(5));
            	$('#rental_address').submit();
            }
          }
        );
      }
    }
