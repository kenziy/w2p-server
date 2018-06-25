<?php $this->load->view('header'); ?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<h1>DASHBOARD</h1>
			<p>List of redeem request</p>
			<table class="table">
				<thead>
					<tr>
						<th>Tracking #</th>
						<th>Points</th>
						<th>Type</th>
						<th>Number</th>
						<th>Network</th>
						<th>Note</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($all as $a): $r = json_decode($a->request); ?>
						<tr>
							<td><?php echo $a->tracking_id; ?></td>
							<td><?php echo $a->points; ?></td>
							<td><?php echo $r->redeem; ?></td>
							<td><?php echo $r->phone; ?></td>
							<td><?php echo $r->opt; ?></td>
							<td><?php echo $r->note; ?></td>
							<td><?php echo $a->date_created; ?></td>
							<td><a href="javascript:void(0)" data-id="<?php echo $a->id; ?>" class="btn btn-warning approve">Action</a></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div> 
	</div>
</div>

<div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
            	<h3>Add Comment</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <?php echo form_open('admin/approve'); ?>
                  <input type="hidden" id="id">
                  <div class="form-group">
                  	<select class="form-control" name="action">
                  		<option value="1">Approve</option>
                  		<option value="3">Reject</option>
                  	</select>
                  </div>
                  <div class="form-group">
                  	<textarea class="form-control" rows="4" placeholder="Comment"></textarea>
                  </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Continue</button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
<?php $this->load->view('js'); ?>
<script type="text/javascript">
	$('.approve').on('click', function(){
		$('#id').val($(this).data('id'));
		$('#approve').modal('show');
	});
</script>
<?php $this->load->view('footer'); ?>