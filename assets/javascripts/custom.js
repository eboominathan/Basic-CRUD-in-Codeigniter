<script>

function isAlphaKey(evt)

{
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 65 || charCode > 90 ) && ( charCode < 97 || charCode > 122))

     {
        return false;

     }

     return true;

}   
/*Get Location*/

function getloc()
{
var i=$('#tag').val();
 $("#tag").autocomplete("<?php echo base_url();?>location/ajax/"+i+"", 
 {
    selectFirst: true
    });
}
        /*Get Area */

function getarea()
{
    
    var i=$('#area').val();
    var l=$('#tag').val();
 $("#area").autocomplete("<?php echo base_url();?>area/ajax1/"+i+"/"+l+"",
  {
    selectFirst: true
    });
}
/*Get Customer Name*/
function getcust()
{
    var i=$('#area').val();
    var l=$('#tag').val();
    var c=$('#tag2').val();
 $("#tag2").autocomplete("<?php echo base_url();?>cash_bill/ajax2/"+i+"/"+l+""+c+"", {
    selectFirst: true
    });
}

/*Put Numbers Only*/

 function isNumberKey(evt)

{     var charCode = (evt.which) ? evt.which : event.keyCode

     if (charCode > 31 && (charCode < 48 || charCode > 57))
     {
        return false;
     }
     return true;
}


/*Get Ajax Autocomplete*/

function getfield()

{
    var area=$('.area').val();
    var location=$('.tag').val();
    var b=$('.b').val();
    
    var str=$('.cust').val();
    var substr = str.split('-');
    var id=substr[1];
    $.post('<?php echo base_url()?>cash_bill/check',{id:id,area:area,location:location,str:str,b:b},function (tt) {
        
        $('.content').html(tt);
        $('#s_no').focus();

    });
}

/*Get Area Name*/

    $(function(){
    $('.area').on('keyup', function(){
        $location = $('.tag').val();
        $area = $('.area').val();
        $.post('<?php echo base_url("area/ajax");?>',{loc:$location, area:$area},
         function(res){$('#area').html(res);});
        });
    });

/*Get Customer Name*/
$(function(){
        $('.cust').on('keyup', function(){
            $name = $('.cust').val();
     $.post('<?php echo base_url("cash_bill/ajax");?>',{loc:$location, area:$area,name:$name}, function(res){

        $('#cust').html(res);});
    });
});

/*Add Row */

    $(function(){
        $('#add1').on('click', function(){
            $count = $('.no tr').length;
            $c = $count + 1;
 $field = '<tr id="'+$c+'"><td width="5%" align="center">'+$c+'</td><td width="23%" align="center"><input type="text" name="itemname_'+$c+'" id="itemname_'+$c+'" style="width:140px;" onkeyup="getitem_'+$c+'()" onblur="getrate_'+$c+'()" data-parsley-error-message="Enter item Name Here" required></td><td align="center" width="24%" class="rrate"><div class="rt'+$c+'"><input type="text" name="rate_'+$c+'" id="rate_'+$c+'"/></div></td><td width="10%" align="center" "><input name="qty_'+$c+'" id="qty_'+$c+'" type="text" style="width:90px;" onKeyUp="getamount'+$c+'()" data-parsley-error-message="Enter Quantity Here" required></td><td width="10%" align="center"><input type="text" name="amount_'+$c+'" id="amount_'+$c+'" size="10"></td><td width="10%" align="center" class="rrtax"><input type="text" name="tax_'+$c+'" size="10" id="tax_'+$c+'" onKeyUp="return tot'+$c+'()"></td><td width="10%" align="center" id="qty_1"><input name="total_'+$c+'" id="total_'+$c+'" type="text" style="width:90px;"></td><td><input type="button" class="btn btn-primary" onclick="add()"  Value="+"></td></tr>';
               if($c<=10){
                $('.no').append($field);
                     }
                     else{
                        alert('Sorry You Cant Add More than 10 Rows');                        
                     }
            
        });
    });  
/*Delete Row */

      $(function(){
        $('.del').on('click', function(){

            if($c <= 1)
            {
                alert('Atleast 1 Field is required');
            } 
            else 
            {
                $('#'+$c).remove();
                $c = $c-1;
            }    
        });
     });

/* Add row with Side button*/

function add(){

  $count = $('.no tr').length;
            $c = $count + 1;
 $field = '<tr id="'+$c+'"><td width="5%" align="center">'+$c+'</td><td width="23%" align="center"><input type="text" name="itemname_'+$c+'" id="itemname_'+$c+'" style="width:140px;" onkeyup="getitem_'+$c+'()" onblur="getrate_'+$c+'()" data-parsley-error-message="Enter item Name Here" required></td><td align="center" width="24%" class="rrate"><div class="rt'+$c+'"><input type="text" name="rate_'+$c+'" id="rate_'+$c+'"/></div></td><td width="10%" align="center" "><input name="qty_'+$c+'" id="qty_'+$c+'" type="text" style="width:90px;" onKeyUp="getamount'+$c+'()" data-parsley-error-message="Enter Quantity Here" required></td><td width="10%" align="center"><input type="text" name="amount_'+$c+'" id="amount_'+$c+'" size="10"></td><td width="10%" align="center" class="rrtax"><input type="text" name="tax_'+$c+'" size="10" id="tax_'+$c+'" onKeyUp="return tot'+$c+'()"></td><td width="10%" align="center" id="qty_1"><input name="total_'+$c+'" id="total_'+$c+'" type="text" style="width:90px;"></td><td><input type="button" class="btn btn-primary" onclick="add()"  Value="+"></td></tr>';
                if($c<=10){
                $('.no').append($field);
                     }
                     else{
                        alert('Sorry You Cant Add More than 10 Rows');                        
                     }               
            
        }
  

/*Item Rate */

function getrate_1()
{
    var i=$('#itemname_1').val();
    var t=$('#type').val();
    var loc=$('.tag').val();
   
    $.post('<?php echo base_url()?>item/ajaxrate1',{i:i,t:t,loc:loc},function (tt) {
        
    $('.rt1').html(tt);
    });
}

function getrate_2()
{
    var i2=$('#itemname_2').val();
    var t2=$('#type').val();
    var loc2=$('.tag').val();   
    $.post('<?php echo base_url()?>item/ajaxrate2',{i:i2,t:t2,loc:loc2},function (tt2) {
        
    $('.rt2').html(tt2);
    });
}

function getrate_3()
{
    var i2=$('#itemname_3').val();
    var t2=$('#type').val();
    var loc2=$('.tag').val();   
    $.post('<?php echo base_url()?>item/ajaxrate3',{i:i2,t:t2,loc:loc2},function (tt3) {
        
    $('.rt3').html(tt3);
    });
}
function getrate_4()
{
    var i2=$('#itemname_4').val();
    var t2=$('#type').val();
    var loc2=$('.tag').val();   
    $.post('<?php echo base_url()?>item/ajaxrate4',{i:i2,t:t2,loc:loc2},function (tt4) {
        
    $('.rt4').html(tt4);
    });
}

function getrate_5()
{
    var i2=$('#itemname_5').val();
    var t2=$('#type').val();
    var loc2=$('.tag').val();   
    $.post('<?php echo base_url()?>item/ajaxrate5',{i:i2,t:t2,loc:loc2},function (tt5) {
        
    $('.rt5').html(tt5);
    });
}
function getrate_6()
{
    var i2=$('#itemname_6').val();
    var t2=$('#type').val();
    var loc2=$('.tag').val();   
    $.post('<?php echo base_url()?>item/ajaxrate6',{i:i2,t:t2,loc:loc2},function (tt6) {
        
    $('.rt6').html(tt6);
    });
}
function getrate_7()
{
    var i2=$('#itemname_7').val();
    var t2=$('#type').val();
    var loc2=$('.tag').val();   
    $.post('<?php echo base_url()?>item/ajaxrate7',{i:i2,t:t2,loc:loc2},function (tt7) {
        
    $('.rt7').html(tt7);
    });
}
function getrate_8()
{
    var i2=$('#itemname_8').val();
    var t2=$('#type').val();
    var loc2=$('.tag').val();   
    $.post('<?php echo base_url()?>item/ajaxrate8',{i:i2,t:t2,loc:loc2},function (tt8) {
        
    $('.rt8').html(tt8);
    });
}
function getrate_9()
{
    var i2=$('#itemname_9').val();
    var t2=$('#type').val();
    var loc2=$('.tag').val();   
    $.post('<?php echo base_url()?>item/ajaxrate9',{i:i2,t:t2,loc:loc2},function (tt9) {
        
    $('.rt9').html(tt9);
    });
}
function getrate_10()
{
    var i2=$('#itemname_10').val();
    var t2=$('#type').val();
    var loc2=$('.tag').val();   
    $.post('<?php echo base_url()?>item/ajaxrate10',{i:i2,t:t2,loc:loc2},function (tt0) {
    alert(tt0);    
    $('.rt10').html(tt0);

    });
}




/*Item Name autocomplete*/

function getitem_1()
{
    var i=$('#itemname_1').val();
 $("#itemname_1").autocomplete("<?php echo base_url();?>item/ajaxitem/"+i+"", {
    selectFirst: true
    });
}
function getitem_2()
{
    var i=$('#itemname_2').val();
 $("#itemname_2").autocomplete("<?php echo base_url();?>item/ajaxitem/"+i+"", {
    selectFirst: true
    });
}
function getitem_3()
{
    var i=$('#itemname_3').val();
 $("#itemname_3").autocomplete("<?php echo base_url();?>item/ajaxitem/"+i+"", {
    selectFirst: true
    });
}
function getitem_4()
{
    var i=$('#itemname_4').val();
 $("#itemname_4").autocomplete("<?php echo base_url();?>item/ajaxitem/"+i+"", {
    selectFirst: true
    });
}
function getitem_5()
{
    var i=$('#itemname_5').val();
 $("#itemname_5").autocomplete("<?php echo base_url();?>item/ajaxitem/"+i+"", {
    selectFirst: true
    });
}
function getitem_6()
{
    var i=$('#itemname_6').val();
 $("#itemname_6").autocomplete("<?php echo base_url();?>item/ajaxitem/"+i+"", {
    selectFirst: true
    });
}
function getitem_7()
{
    var i=$('#itemname_7').val();
 $("#itemname_7").autocomplete("<?php echo base_url();?>item/ajaxitem/"+i+"", {
    selectFirst: true
    });
}
function getitem_8()
{
    var i=$('#itemname_8').val();
 $("#itemname_8").autocomplete("<?php echo base_url();?>item/ajaxitem/"+i+"", {
    selectFirst: true
    });
}
function getitem_9()
{
    var i=$('#itemname_9').val();
 $("#itemname_9").autocomplete("<?php echo base_url();?>item/ajaxitem/"+i+"", {
    selectFirst: true
    });
}
function getitem_10()
{
    var i=$('#itemname_10').val();
 $("#itemname_10").autocomplete("<?php echo base_url();?>item/ajaxitem/"+i+"", {
    selectFirst: true
    });
}
    
/*Get Amount */

function getamount1()
{    
    var i=$('#rate_1').val();
    var q = $('#qty_1').val();
    var a = i * q;
    $('#amount_1').val(a);
}

function getamount2()
{  
    var i2=$('#rate_2').val();
    var q2 = $('#qty_2').val();

    var a2 = i2 * q2;
    $('#amount_2').val(a2);
}
function getamount3()
{  
    var i3=$('#rate_3').val();
    var q3 = $('#qty_3').val();

    var a3 = i3 * q3;
    $('#amount_3').val(a3);
}
function getamount4()
{  
    var i4=$('#rate_4').val();
    var q4 = $('#qty_4').val();

    var a4 = i4 * q4;
    $('#amount_4').val(a4);
}
function getamount5()
{  
    var i5=$('#rate_5').val();
    var q5 = $('#qty_5').val();

    var a5 = i5 * q5;
    $('#amount_5').val(a5);
}
function getamount6()
{  
    var i6=$('#rate_6').val();
    var q6 = $('#qty_6').val();

    var a6 = i6 * q6;
    $('#amount_6').val(a6);
}
function getamount7()
{  
    var i7=$('#rate_7').val();
    var q7 = $('#qty_7').val();

    var a7 = i7 * q7;
    $('#amount_7').val(a7);
}
function getamount8()
{  
    var i8=$('#rate_8').val();
    var q8 = $('#qty_8').val();

    var a8 = i8 * q8;
    $('#amount_8').val(a8);
}
function getamount9()
{  
    var i9=$('#rate_9').val();
    var q9 = $('#qty_9').val();

    var a9 = i9 * q9;
    $('#amount_9').val(a9);
}
function getamount10()
{  
    var i10=$('#rate_10').val();
    var q10 = $('#qty_10').val();

    var a10 = i10 * q10;
    $('#amount_10').val(a10);
}


/*Get Total */
function tot1()
{    
    var a=$('#amount_1').val();
    var t = $('#tax_1').val();
    var tot =  parseInt(a) + parseInt(t);
    $('#total_1').val(tot);
}
function tot2()
{    
    var a2=$('#amount_2').val();
    var t2 = $('#tax_2').val();
    var tot2 =  parseInt(a2) + parseInt(t2);
    $('#total_2').val(tot2);
}
function tot3()
{    
    var a3=$('#amount_3').val();
    var t3 = $('#tax_3').val();
    var tot3=  parseInt(a3) + parseInt(t3);
    $('#total_3').val(tot3);
}
function tot4()
{    
    var a4=$('#amount_4').val();
    var t4 = $('#tax_4').val();
    var tot4=  parseInt(a4) + parseInt(t4);
    $('#total_4').val(tot4);
}
function tot5()
{    
    var a5=$('#amount_5').val();
    var t5 = $('#tax_5').val();
    var tot5=  parseInt(a5) + parseInt(t5);
    $('#total_5').val(tot5);
}
function tot6()
{    
    var a6=$('#amount_6').val();
    var t6 = $('#tax_6').val();
    var tot6=  parseInt(a6) + parseInt(t6);
    $('#total_6').val(tot6);
}
function tot7()
{    
    var a7=$('#amount_7').val();
    var t7 = $('#tax_7').val();
    var tot7=  parseInt(a7) + parseInt(t7);
    $('#total_7').val(tot7);
}
function tot8()
{    
    var a8=$('#amount_8').val();
    var t8 = $('#tax_8').val();
    var tot8=  parseInt(a8) + parseInt(t8);
    $('#total_8').val(tot8);
}
function tot9()
{    
    var a9=$('#amount_9').val();
    var t9 = $('#tax_9').val();
    var tot9=  parseInt(a9) + parseInt(t9);
    $('#total_9').val(tot9);
}
function tot10()
{    
    var a10=$('#amount_10').val();
    var t10 = $('#tax_10').val();
    var tot10=  parseInt(a10) + parseInt(t10);
    $('#total_10').val(tot10);
}

</script>
