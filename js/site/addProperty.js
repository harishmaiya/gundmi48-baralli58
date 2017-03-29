function HomeType(evt,prdID)
{
	var data = evt.value;
		$.ajax({
			type:'post',
			url:baseURL+'site/product/insert_home_type',
			data:{'prd_id':prdID,'value':data},
			complete:function(){
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(2000).text('');
			}
		});
}

function RoomType(evt,prdID)
{
	var data = evt.value;
		$.ajax({
			type:'post',
			url:baseURL+'site/product/insert_room_type',
			data:{'prd_id':prdID,'value':data},
			complete:function(){
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(2000).text('');
			}
		});
}

function Accommodates(evt,prdID)
{
	var data = evt.value;
		$.ajax({
			type:'post',
			url:baseURL+'site/product/insert_accommodates',
			data:{'prd_id':prdID,'value':data},
			complete:function(){
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(1000).text('');
			}
		});
}

function Bedrooms(evt,prdID)
{
	var data = evt.value;
		$.ajax({
			type:'post',
			url:baseURL+'site/product/insert_bedrooms',
			data:{'prd_id':prdID,'value':data},
			complete:function(){
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(2000).text('');
			}
		});
}

function Beds(evt,prdID)
{
	var data = evt.value;
		$.ajax({
			type:'post',
			url:baseURL+'site/product/insert_beds',
			data:{'prd_id':prdID,'value':data},
			complete:function(){
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(2000).text('');
			}
		});
}

function BedType(evt,prdID)
{
	var data = evt.value;
		$.ajax({
			type:'post',
			url:baseURL+'site/product/insert_bed_type',
			data:{'prd_id':prdID,'value':data},
			complete:function(){
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(2000).text('');
			}
		});
}

function BathRooms(evt,prdID)
{
	var data = evt.value;
		$.ajax({
			type:'post',
			url:baseURL+'site/product/insert_bathrooms',
			data:{'prd_id':prdID,'value':data},
			complete:function(){
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(2000).text('');
			}
		});
}

function Price(evt,prdID)
{
	var data = evt.value;
		$.ajax({
			type:'post',
			url:baseURL+'site/product/ch_price',
			data:{'prd_id':prdID,'value':data},
			complete:function(){
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(2000).text('');
			}
		});
}

function Currency(evt,prdID)
{ 
	var data = evt.value;
		$.ajax({
			type:'post',
			url:baseURL+'site/product/ch_currency',
			data:{'prd_id':prdID,'value':data},
			complete:function(){
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(2000).text('');
			}
		});
}

function SocialConnections(evt,prdID)
{ 
	var data = evt.value;
	//alert(data);
		$.ajax({
			type:'post',
			url:baseURL+'site/product/ch_currency',
			data:{'prd_id':prdID,'value':data},
			complete:function(){
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(2000).text('');
			}
		});
}

function RentalTitle(evt,prdID)
{ 
	var data = evt.value;
	//alert(data);
		$.ajax({
			type:'post',
			url:baseURL+'site/product/ch_title',
			data:{'prd_id':prdID,'value':data},
			complete:function(){
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(2000).text('');
			}
		});
}

function RentalDescription(evt,prdID)
{ 
	var data = evt.value;
	//alert(data);
		$.ajax({
			type:'post',
			url:baseURL+'site/product/ch_description',
			data:{'prd_id':prdID,'value':data},
			complete:function(){
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(2000).text('');
			}
		});
}


function ChangeSiteImagetitle(evt,catID){
	var title = evt.value;
	//alert(title);
	
		$.ajax({
			type:'post',
			url:baseURL+'site/product/changeImagetitle',
			data:{'catID':catID,'title':title},
			complete:function(){
				$('#imgmsg_'+catID).hide();
				$('#imgmsg_'+catID).show().text('Done').delay(800).text('');
			}
		});
}

<!-- code added 13/05/2014 ---------------------------->

function ChangeOVerview(evt,catID){
	var title = evt.value;
	
	//alert(title);
		$.ajax({
			type:'post',
			url:baseURL+'site/product/saveOverviewtitle',
			data:{'catID':catID,'title':title},
			
			complete:function(){
				$('#imgmsg_'+catID).hide();
				$('#imgmsg_'+catID).show().text('Done').delay(800).text('');
			}
		});
}



function ChangeOVerviewdesc(evt,catID){
	var title = evt.value;
		$.ajax({
			type:'post',
			url:baseURL+'site/product/saveOverviewListDesc',
			data:{'catID':catID,'title':title},
			
			complete:function(){
				$('#imgmsg_'+catID).hide();
				$('#imgmsg_'+catID).show().text('Done').delay(800).text('');
			}
		});
}
$(document).ready(function(){

$("#description").keypress(function(event){

var title = $("#description").val();

	s = title;
	s = s.replace(/(^\s*)|(\s*$)/gi,"");
	s = s.replace(/[ ]{2,}/gi," ");
	s = s.replace(/\n /,"\n");
	var wordscount =  s.split(' ').length;
	if( wordscount > 150 ){
		
			event.preventDefault();
			return false;
	}
	
})

})
function Detailview(evt,catID,chk){
	var title = evt.value;
	/*document.getElementById('priceErr').innerHTML='';*/
	if(chk=="price" && title <= '0')
	{
		document.getElementById('priceErr').innerHTML="Please enter the price greater than zero";
		return false;
	}
	//alert(chk);
		$.ajax({
			type:'post',
			url:baseURL+'site/product/saveDetailPage',
			data:{'catID':catID,'title':title,'chk':chk},
			
			complete:function(){
				
				$('#imgmsg_'+catID).hide();
				$('#imgmsg_'+catID).show().text('Saved');
			}
		});
}
function Detaillist(evt,catID,chk){
	var title = evt.value;
	
		$.ajax({
			type:'post',
			url:baseURL+'site/product/Save_Listing_Details',
			data:{'catID':catID,'title':title,'chk':chk},
			
			complete:function(){
				
				$('#imgmsg_'+catID).hide();
				$('#imgmsg_'+catID).show().text('Saved');
			}
		});
}
function DetaillistValues(evt,catID,chk){
	var title = evt.value;
	//alert(title);
		$.ajax({
			type:'post',
			url:baseURL+'admin/product/Save_DetailsValues',
			data:{'catID':catID,'title':title,'chk':chk},
			
			complete:function(){
				
				$('#imgmsg_'+catID).hide();
				$('#imgmsg_'+catID).show().text('Saved');
			}
		});
}

<!-- detail page date save end -->


<!-- Admin Detail Page Save -->
function AdminDetailview(evt,catID,chk){
	//alert("Welcome"+evt.value);
	var title = evt.value;
	
	//alert(title+catID);
	if(catID==0) {
	
		$.ajax({
			type:'post',
			url:baseURL+'admin/product/saveAdminDetailPage',
			data:{'title':title,'chk':chk,'catID':catID,'user_ids':$("#user_ids").val()},
			dataType:'json',
			success:function(json){
				
				$('#prdiii').val(json.resultval);
				$('#imgmsg_'+catID).hide();
				$('#imgmsg_'+catID).show().text('Done').delay(800).text('');
				//window.location.href = "admin/product/edit_product_form/"+json.resultval;
				//alert(json.resultval);
				window.location.hash=json.resultval;
				
			}
		});
	}
	else {

	}
	
	
}



function PriceInsert(evt,catID,chk){
	var title = evt.value;
	//alert(evt+catID+chk);
		$.ajax({
			type:'post',
			url:baseURL+'admin/product/OtherDetailInsert',
			data:{'chk':chk,'catID':catID,'val':evt},
			dataType:'json',
			success:function(json){
				// alert(json.resultval);
				//$('#prdiii').val(json.resultval);
				$('#imgmsg_'+catID).hide();
				$('#imgmsg_'+catID).show().text('Done').delay(800).text('');
				//window.location.href = "admin/product/edit_product_form/"+json.resultval;
				window.location.hash;
				
			}
		});
}


function DeleteProductImage(prdID,Id){
	//alert("Product ID"+prdID+Id);
	//alert(baseURL+'admin/product/deleteProductImage');
		$.ajax({
			type:'post',
			url:baseURL+'admin/product/deleteProductImage',
			data:{'prdID':prdID},
			dataType:'json',
			success:function(json){
				 //alert(json.resultval);
				
				$('#img_'+prdID).hide();
				$('#img_'+prdID).show().text('Done').delay(800).text('');
				//window.location.href = baseURL+"admin/product/add_product_form/"+prdID;
				//window.location.hash;
				
			}
		});
}



function SiteDeleteProductImage(prdID,imgID){
	
		 $.ajax({
			type:'post',
			url:'site/product/deleteProductImage',
			data:{prdID:prdID},
			dataType:'json',
			success:function(json){
				//alert(json);
				
				$('#imgmsg_'+prdID).hide();
				$('#imgmsg_'+prdID).show().text('Done').delay(800).text('');
				window.location.href = "photos_listing/"+imgID;
				
				
			}
		}); 
}


<!-- Admin Detail Page End -->






function BookingAvailability(sDate,eDate){
	var sDate = sDate;	
	//alert("Date"+sDate+eDate);
		/*$.ajax({
			type:'post',
			url:baseURL+'site/product/saveDetailPage',
			data:{'catID':catID,'title':title,'chk':chk},
			
			complete:function(){
				$('#imgmsg_'+catID).hide();
				$('#imgmsg_'+catID).show().text('Done').delay(800).text('');
			}
		});*/
}