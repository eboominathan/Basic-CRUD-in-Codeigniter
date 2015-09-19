	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">	


		<?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
                <div class="alert alert-success" >

                  <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php print_r($msg); ?>
                </div>
                <?php } ?>
                <?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
                <div class="alert alert-danger" >

                  <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php print_r($msg); ?>
                </div>
                <?php } ?>
		
<style type="text/css">
  .upload
  {
    display: none;
  }
</style>		

	<script>
$(document).ready(function(){

    $('#table').dataTable();
    $('.excel').click(function(){
      $(".upload").fadeToggle("3000");
        
    });
});
</script>
    <div class="row-fluid" >
      <div class="pull-left" style="margin-left:104px">
          <button class="btn btn-primary excel">Upload Excel</button>
      </div>
	 <div class="span10"  style="margin-left:100px">          
      <div class="widget">
        <div class="widget-header">
         <i class="icon-truck"></i>
          <h3>List of students</h3>
        </div>

        <br><br>


        <?php echo $error;?>
        <?php echo form_open_multipart('student/upload_excel');?>
     <div class="form-group upload" >
              <label class="col-sm-3 control-label"> Upload Excel</label>
              <div class="col-sm-6">
                <i class="icon icon-file"></i>
                 <span class="fileupload-preview"></span>
              </div>
               <span class="btn btn-default btn-file">
               <span class="fileupload-new">Select file</span>
               <span class="fileupload-exists">Change</span>
                 <input type="file" name="userfile" required/>
              </span>
                 <input type="submit" class="btn btn-default fileupload-exists" value="Upload" >
                 <input type="reset" class="btn btn-default" value="Remove">
          
       </div><!--Upload form ends  -->
 </form>
     
 <div class="widget-content" align="center"> 
<table class="table table-bordered" id="table"> 
<thead>
<tr>
	<th style="text-align:center;  background-color:#4C9ED9; color: #fff;">S.NO</th>
	<th style="text-align:center;  background-color:#4C9ED9; color: #fff;">Name</th>
    <th style="text-align:center;  background-color:#4C9ED9; color: #fff;">Address</th>  
    <th style="text-align:center;  background-color:#4C9ED9; color: #fff;">Gender</th> 
    <th style="text-align:center;  background-color:#4C9ED9; color: #fff;">Year of Passing</th>  
	<th style="text-align:center;  background-color:#4C9ED9; color: #fff;">Edit</th>
	<th style="text-align:center;  background-color:#4C9ED9; color: #fff;">Delete</th>
	</tr>
</thead>
<tr>
<?php  $i=1; foreach($student as $s ):?>
<td style="text-align:center;" ><?php echo $i++;?></td>
<td style="text-align:center;"><?php echo $s->name;?></td>
<td style="text-align:center;"><?php echo $s->address;?></td>
<td style="text-align:center;"><?php echo $s->gender;?></td>
<td style="text-align:center;"><?php echo $s->year;?></td>
<td style="text-align:center;" >
	<a href="<?php echo base_url();?>student/edit_student/<?php echo $s->id?>" class="btn btn-primary">Edit </a>
</td>
<td style="text-align:center;">
	<a class="btn btn-default" href="#del_<?php echo $s->id?>" data-toggle="modal">Delete</a>
</td>
</tr>
<?php endforeach ;?>
</table>
<div class="export">
  <a href="<?php echo base_url();?>student/pdf" class="btn btn-default">Export as PDF</a>&nbsp;&nbsp;
  <a href="<?php echo base_url();?>student/excel" class="btn btn-default">Export as Excel</a>
  <a href="<?php echo base_url();?>student/word" class="btn btn-default">Export as Word</a>
</div>
<!--Modal Start here-->
        
<?php foreach($student as $d):?>  

<div class="modal fade" id="del_<?php echo $d->id;?>" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true" >   
<form action="<?php echo base_url();?>student/delete_student" method="post" data-parsley-validate>
 <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="myAddLabel">Warning!</h4>
            </div>
                    <div class="modal-body">                
                       <div class="box-body">
                          <div align="center" class="alert alert-error">
                          <h4>Are You Sure to Delete this Details</h4>
                          </div><br>
                         
                        </div><br><br>
                      <div align="center"> 
    
                      <input type="hidden" name="id" value="<?php echo $d->id;?>">
                     
                       <button type="submit" class="btn btn-primary">Yes</button>
                      <button class="btn btn-default"  data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
               

    </div>
     </form>
     </div>
<?php endforeach;?>
