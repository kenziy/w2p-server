<?php $this->load->view('header'); ?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="login-form">
					<h1>Admin Login</h1>
					<?php echo form_open('admin/login');
						if($error != "") {
							echo "<div class='text-danger'>".$error."</div>";
						}
					?>
					<div class="form-group">
						Username
						<input type="text" name="username" class="form-control" value="<?php echo set_value('username'); ?>">
						<?php echo form_error('username', '<div class="text-danger">','</div>'); ?>
					</div>
					<div class="form_group">
						Password
						<input type="password" name="password" class="form-control">
						<?php echo form_error('password', '<div class="text-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<br />
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('footer'); ?>