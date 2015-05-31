
	<div id="maindiv">
		<div id="first">
			<div id="title"><p><h2>BASIC CRUD FOR BEGINNERS</h2></p></div>

			<form id="login" action=" <?php echo base_url('login/validate'); ?>" method="post">
 				<?php $msg = $this->session->flashdata('msg');
      				if((isset($msg)) && (!empty($msg))) { ?>
					<div id="message" class="alert alert-danger">
						<?php print_r($msg); ?>
						</div>
						<?php } ?>
						</br></br>
						<input class="textbox"  name="email" type="text" Placeholder="Username">
							</br>
							</br>
						<input class="textbox" id="password" name="password" type="password" Placeholder="Password">
						</br>
						<input  type="submit" id="login_button" value="Login "/>

					</div>
				</div> 
			</body>
			<style> 
.foot {
    border-top: 1px solid #999999;
    position:fixed;
    width: 600px;
    z-index: 10000;
    text-align:center;
    height: 500px;
     font-family:verdana;
    font-size:14px;
    color: #000;
    background: #FFF;
    display: flex;
    justify-content: center; /* align horizontal */
    border-top-left-radius:25px;
    border-top-right-radius:25px;
    right: 0;
    left: 0;
    margin-right: auto;
    margin-left: auto;
    bottom: -475px;
}
</style>   
<div class="foot">
Happy to help ! &copy; <a href="http://www.facebook.com/eboominathan" target="_blank">Boominathan</a>
</div>
	</html>



