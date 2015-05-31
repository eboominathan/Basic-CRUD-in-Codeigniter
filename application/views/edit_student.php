<title>..::Boominathan Demo Codeigniter Project::..</title>  
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css">
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

<div class"col-lg-6">
<div class="alert alert-warning">

<h4>Edit Student Record</h4>
</div>


<?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
                <div class="alert alert-success" >

                  <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php print_r($msg); ?>
                </div>
                <?php } ?>
                <?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
                <div class="alert alert-error" >

                  <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php print_r($msg); ?>
                </div>
                <?php } ?>
<form class="form-horizontal" action="<?php echo base_url();?>student/update_student" method="post">
<?php foreach($student as  $s):?>
<div class="pull-left">
 		<div class="form-group">
 			<label class="col-sm-5 control-label">Full Name</label>
  			<div class="col-md-7" >
				<input type="text" class="form-control" name="name" value="<?php echo $s->name;?>">
			</div>
		</div>
		<div class="form-group">
 			<label class="col-sm-5 control-label">Resident Address </label>
  			<div class="col-md-7" >
				<textarea class="form-control" name="address"><?php echo $s->address;?></textarea>
			</div>
		</div>
		<div class="form-group">
 			<label class="col-sm-5 control-label">Gender </label><br>
 			<div class="col-md-5" >
 			<div class="pull-left">
 			<?php  $gender = $s->gender; 
 				if($gender == "Male"){?>
 					<input type="radio" class="form-control" name="gender" value="Male" checked="checked">Male
 					</div>
				<div class="pull-left">
				<input type="radio" class="form-control"  name="gender"value="Female"> 
				Female
				</div>
				<?php } ?>
				<?php 
				if($gender =="Female"){?>	
								?>
				<input type="radio" class="form-control" name="gender" value="Male" >Male
 					</div>
				<div class="pull-left">
				<input type="radio" class="form-control"  name="gender" value="Female" checked="checked"> 
				Female
				</div>
				<?php }?>
			</div>
			</div>
			<div class="form-group">
 				<label class="col-sm-7 control-label">Expected Year of Passing</label><br>
 				<?php $year=$s->year; $db=array('2010','2011','2012','2013','2014');?>
  				<div class="col-md-5" >
  					<select name="year" class="form-control">
  						<?php foreach($db as $d ){ 
  							if($year==$d){	?>
  								<option value="<?php echo $d?>" selected="selected"><?php echo $d?></option>
  							<?}else{?>
  									<option value="<?php echo $d?>"><?php echo $d?></option>
  							<?php }		}?>
		  		
		  					
				  			
		  			</select>
  				</div>
  			</div>
		<div class="form-group">
 				<label class="col-sm-7 control-label">Extra Curricular Interest</label><br>
  			<div class="col-md-4" >
  			<?php $t=$s->interest;
  			$interest = explode(',',$t);
  			if (in_array("Sports", $interest)){?>
	  			<input type="checkbox" name="interest[]" value="Sports" checked="checked">Sports<br>
	  			<?php }else {?>
				<input type="checkbox" name="interest[]" value="Sports" >Sports<br>
	  			<?php }
				if (in_array("Programming", $interest)){?>
				<input type="checkbox" name="interest[]"  value="Programming" checked="checked">Programming<br>
				<?php }else {?>
	  			<input type="checkbox" name="interest[]"  value="Programming">Programming<br>
	  			<?php }
	  			if (in_array("Arts", $interest)){?>
	  				<input type="checkbox" name="interest[]"  value="Arts"  checked="checked">Arts<br>
	  				<?php }else {?>
	  			<input type="checkbox" name="interest[]"  value="Arts">Arts<br>
	  			<?php }
	  			if (in_array("Music", $interest)){?>
	  			<input type="checkbox" name="interest[]" value="Music" checked="checked">Music<br>
				<?php }else {?>
				<input type="checkbox" name="interest[]" value="Music">Music<br>
				<?php } ?>
  			</div>
  		</div>
	  		<div class="footer" align="center">
		  		<input type="hidden" value="<?php echo $s->id;?>" name="id"> 
		  		<input type="submit" value="Update" class="btn btn-default">
		  		<input type="reset" value="Cancel" class="btn btn-default">
	  		</div>
		</div>
	</div>
	<?php endforeach;?>
</form>


</body>
</html>