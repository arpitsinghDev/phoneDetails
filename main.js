function showcom(a,b){
    if(a==1){      
        pname=$('.tableone > tbody > tr:nth-child(2) > td:nth-child(2)').html();
        //console.log("in"+pname);
    }else{
        pname=$('.tabletwo > tbody > tr:nth-child(2) > td:nth-child(2)').html();
       // console.log("in"+pname);
    }

$('.imgrate').slideUp(400);
//$('.api').append(pname);
//console.log(pname)
$.ajax({
type: "POST",
url: "https://all-polling.in/phonedetails/php/fono.php",
data: {pname:pname},
dataType: "json",
success: function (response) {
   // console.log(response);
    //$('.imgrate').html('');
    $('.imgrate').slideDown(500);
    for(let i=0; i<response.length;i++){
       // console.log('.imgrate '+b);;
    if(response[i].hasOwnProperty("m_name")){
        $('.imgrate .'+b).append("<a target='_blank' href="+response[i]['m_producturl']+"><img src="+response[i]['m_img']+"></a>");
        $('.imgrate .'+b).append("<div class='details'><h3 id='name'>"+response[i]['m_name']+"</h3><span>"+response[i]['m_flipkardprice']['amount']+" "+response[i]['m_flipkardprice']['currency']+"</span> <span> " +response[i]['m_discount']+ "%off</span><br><span class='offer'>Flipkard "+response[j]['m_specialprice']['amount']+"/- "+response[j]['m_flipkardprice']['currency']+"<a target='_blank' href="+response[i]['m_producturl']+" class='buynow'>BUY NOW</a></div>")
    }
    else{
        $('.optional').append("<div class='opcont"+i+"'></div>")
        $('.optional>.opcont'+i).append("<a target='_blank' href="+response[i]['producturl']+"><img src="+response[i]['img']+"></a>");
        $('.optional>.opcont'+i).append("<div class='details'><h3 id='name'>"+response[i]['name']+"</h3><span>"+response[i]['flipkardprice']['amount']+" "+response[i]['flipkardprice']['currency']+"</span> <span> " +response[i]['discount']+ "%off</span><br><a target='_blank' href="+response[i]['producturl']+" class='buynow'>BUY NOW</a></div>")
    }
    }
    if($('.imgrate .'+b).html()==''){
        $('.imgrate .'+b).append("<a target='_blank' href="+response[0]['producturl']+"><img src="+response[0]['img']+"></a>");
        $('.imgrate .'+b).append("<div class='details'><h3 id='name'>"+response[0]['name']+"</h3><span>"+response[0]['flipkardprice']['amount']+" "+response[0]['flipkardprice']['currency']+"</span> <span> " +response[0]['discount']+ "%off</span><br><a target='_blank' href="+response[0]['producturl']+" class='buynow'>BUY NOW</a></div>")
    }
    //console.log(a  + " " +b);
},
});
}
function showimg(){
let pname=$('.table > tbody > tr:nth-child(2) > td:nth-child(2)').html();
$('.imgrate').slideUp(400);
//$('.api').append(pname);
// console.log(pname)
$.ajax({
type: "POST",
url: "https://all-polling.in/phonedetails/php/fono.php",
data: {pname:pname},
dataType: "json",
success: function (response) {
   // console.log(response);
    $('.imgrate').html('');
    $('.imgrate').slideDown(500);
    
    for(let i=0; i<response.length;i++){
        //console.log(i)
    if(response[i].hasOwnProperty("m_name")){
        $('.imgrate').html("<a target='_blank' href="+response[i]['m_producturl']+"><img src="+response[i]['m_img']+"></a>");
        $('.imgrate').append("<div class='details'><h3 id='name'>"+response[i]['m_name']+"</h3><span>"+response[i]['m_flipkardprice']['amount']+" "+response[i]['m_flipkardprice']['currency']+"</span> <span> " +response[i]['m_discount']+ "%off</span><br><a target='_blank' href="+response[i]['m_producturl']+" class='buynow'>BUY NOW</a></div>")
    }
    else{
       // console.log(i)
        $('.optional').append("<div class='opcont"+i+"'></div>")
        $('.optional>.opcont'+i).append("<a target='_blank' href="+response[i]['producturl']+"><img src="+response[i]['img']+"></a>");
        $('.optional>.opcont'+i).append("<div class='details'><h3 id='name'>"+response[i]['name']+"</h3><span>"+response[i]['flipkardprice']['amount']+" "+response[i]['flipkardprice']['currency']+"</span> <span> " +response[i]['discount']+ "%off</span><br><a target='_blank' href="+response[i]['producturl']+" class='buynow'>BUY NOW</a></div>")
    }
    
    }      
    if( $('.imgrate').html()==''){
        $('.imgrate').append("<a target='_blank' href="+response[0]['producturl']+"><img src="+response[0]['img']+"></a>");
        $('.imgrate').append("<div class='details'><h3 id='name'>"+response[0]['name']+"</h3><span>"+response[0]['flipkardprice']['amount']+" "+response[0]['flipkardprice']['currency']+"</span> <span> " +response[0]['discount']+ "%off</span><br><a target='_blank' href="+response[0]['producturl']+" class='buynow'>BUY NOW</a></div>")
    }
},
});
}
