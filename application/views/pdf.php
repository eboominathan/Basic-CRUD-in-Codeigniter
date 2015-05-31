<?php 
        $mpdf = new mPDF('L',  // mode - default ''
                         'A4',    // format - A4, for example, default ''
                         0,     // font size - default 0
                         '',    // default font family
                         10,    // margin_left
                         10,    // margin right
                         16,     // margin top
                         16,    // margin bottom
                         9,     // margin header
                         9,     // margin footer
                         'L');  //
     
   
        
 $html = '<div align="center"><h1>..::PDF REPORT GENERATED::..</h1></div>
 <table style="width:100%;border-collapse:collapse;" border="1" > 
<thead>
<tr>
  <th style="text-align:center; padding:15px 15px; background-color:#4C9ED9; color: #fff;">S.NO</th>
  <th style="text-align:center;padding:15px 15px;  background-color:#4C9ED9; color: #fff;">Name</th>
    <th style="text-align:center;padding:15px 15px;  background-color:#4C9ED9; color: #fff;">Address</th>
    <th style="text-align:center;padding:15px 15px;  background-color:#4C9ED9; color: #fff;">Gender</th>  
    <th style="text-align:center;padding:15px 15px;  background-color:#4C9ED9; color: #fff;">Expected Year of Passing </th> 
       

  </tr>
</thead>
';
    $i=1; foreach($student as $s ):

$html .='<tr><td style="text-align:center;">'.$i++.'</td>
<td style="text-align:center; padding:15px 6px;">'.$s->name.'</td>
<td style="text-align:center; padding:15px 6px;">'. $s->address.'</td>
<td style="text-align:center; padding:15px 6px;">'. $s->gender.'</td>
<td style="text-align:center; padding:15px 6px;">'. $s->year.'</td>
</tr>';
 endforeach ;
$html .='</table>
<div align="right"><b>Happy to help! <br>Yours Boominathan!</b></div>';
   
     
    // Numeric Entities
    
    $str = preg_replace_callback('~&#x(0*[0-9a-f]{2,5});{0,1}~i',
    create_function ('$matches', 'return chr(hexdec($matches[1]));'), $ht);
     $str = preg_replace_callback('~&#([0-9]{2,4});{0,1}~',
    create_function ('$matches', 'return chr($matches[1]);'), $str);
     
       
         $mpdf->WriteHTML($html);
         $mpdf->Output();
     
    $str = preg_replace('~&#x(0*[0-9a-f]{2,5});{0,1}~ei', 'chr(hexdec("\\1"))', $str);
    $str = preg_replace('~&#([0-9]{2,4});{0,1}~e', 'chr(\\1)', $str);
    ?>

