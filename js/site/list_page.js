$(function()
{
$('#datepicker1').change(function(){
var from=$('#datepicker').val();
if(from !='')
{
		var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;

		if(range != '-1'){
		    args.city = $('#GetCity').val();
		    args.datefrom=$('#datepicker').val();
			args.dateto = range;
		} else {
		    
			/* delete args.city; */
		    delete args.datefrom;
			delete args.dateto;
			
		}

		if(query = $.param(args)) url += '?'+query;

		window.location=url;
}		
	});


$('#room_type1').click(function(){

		var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;

		if($(this).is(':checked')){
		    args.city = $('#GetCity').val();
			args.type1 = range;
		} else {
			 delete args.type1;
			 /* delete args.city; */
		}

		if(query = $.param(args)) url += '?'+query;
//alert(url);
		window.location=url;
	});

$('#room_type2').click(function(){

		var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;

		if($(this).is(':checked')){
		    args.city = $('#GetCity').val();
			args.type2 = range;
		} else {
		    /* delete args.city; */
			delete args.type2;
			
		}

		if(query = $.param(args)) url += '?'+query;
//alert(url);
		window.location=url;
	});

$('#room_type3').click(function(){

		var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;

		if($(this).is(':checked')){
		    city_value=$('#GetCity').val();
		    city_value=city_value.replace(/\s+/g,"+");
		    args.city =city_value;
			
			args.type3 = range;
		} else {
		    
			/* delete args.city; */
			delete args.type3;
		}

		if(query = $.param(args)) url += '?'+query;
//alert(url);
		window.location=url;
	});
	
	
$('#guests').change(function(){
var id=$(this).attr('id');
		var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;
//console.log(getQueryParams(document.location.search));
		if(range != '-1'){
		    args.city = $('#GetCity').val();
			args.guests = range;
		} else {
		
		     /* delete args.city; */
			 delete args.guests;
		}

		if(query = $.param(args)) url += '?'+query;

		window.location=url;
	});
	
	function getQueryParams(qs) {
		qs = qs.split("+").join(" ");
		var params = {},
			tokens,
			re = /[?&]?([^=]+)=([^&]*)/g;

		while (tokens = re.exec(qs)) {
			params[decodeURIComponent(tokens[1])]
				= decodeURIComponent(tokens[2]);
		}

		return params;
	}

$('#bedrooms').change(function(){

		var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;

		if(range != '-1'){
		    args.city = $('#GetCity').val();
			args.bedrooms = range;
		} else {
		   /*  delete args.city; */
			delete args.bedrooms;
		}

		if(query = $.param(args)) url += '?'+query;

		window.location=url;
	});

$('#bathrooms').change(function(){
        var id=$(this).attr('id');
		var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;

		if(range != '-1'){
		    args.city = $('#GetCity').val();
			args.bathrooms = range;
		} else {
		    /* delete args.city; */
			delete args.bathrooms;
		}

		if(query = $.param(args)) url += '?'+query;

		window.location=url;
	});

$('#beds').change(function(){
var id=$(this).attr('id');
//alert($('#GetCity').val());
		var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;

		if(range != '-1'){
		    args.city = $('#GetCity').val();
			args.beds = range;
		} else {
		    //delete args.city;
			delete args.beds;
		}

		if(query = $.param(args)) url += '?'+query;

		window.location=url;
	});

/*Custom filter by j*/
$('#bedtype').change(function(){
	var id=$(this).attr('id');
	var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;

	if(range != '-1'){
	    args.city = $('#GetCity').val();
		args.bedtype = range;
	} else {
		delete args.bedtype;
	}

	if(query = $.param(args)) url += '?'+query;
	window.location=url;
});
$('#noofbathrooms').change(function(){
	var id=$(this).attr('id');
	var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;

	if(range != '-1'){
	    args.city = $('#GetCity').val();
		args.noofbathrooms = range;
	} else {
		delete args.noofbathrooms;
	}

	if(query = $.param(args)) url += '?'+query;
	window.location=url;
});
$('#min_stay').change(function(){
	var id=$(this).attr('id');
	var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;

	if(range != '-1'){
	    args.city = $('#GetCity').val();
		args.min_stay = range;
	} else {
		delete args.min_stay;
	}

	if(query = $.param(args)) url += '?'+query;
	window.location=url;
});

/*Custom filter by j*/


	

$('#keywords').blur(function(){
		var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;

		if(range != '-1'){
		    args.city = $('#GetCity').val();
			args.keywords = range;
			
		} else {
		    /* delete args.city;*/
			delete args.keywords; 
		}

		if(query = $.param(args)) url += '?'+query;

		window.location=url;
	});
	
	
	$('.showlist5 input:checkbox').click(function(){
var list_value=$(this).val();
var list_name=$(this).attr('id');



var range = this.value, url = location.pathname, args = $.extend({}, getQueryParams(document.location.search)), query;

		/* if(range != '-1'){ */
		if($(this).is(':checked'))
        {
		    args.city = $('#GetCity').val();
			args[list_name] = list_value;
		} else {
			 delete args[list_name];
		}

		if(query = $.param(args)) url += '?'+query;

		window.location=url;
		
//}
		
})
});