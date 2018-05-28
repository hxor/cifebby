<div class="well" style="padding-bottom: 50px;">
	<?= form_open('/home/status', ['class' => 'form-horizontal', 'role' => 'form']) ?>
        <h4>What's New</h4>
        <div class="form-group" style="padding:14px;">
			<?= form_hidden('user_id', $this->session->userdata('id')) ?>
			<?= form_textarea('body', $input->body, ['class' => 'form-control', 'placeholder' => 'Update your status', 'rows'=>"4",  'cols'=>"50"]) ?>
			<?= form_error('body') ?>
        </div>
        <button class="btn btn-primary pull-right" type="submit">Post</button>
        <ul class="list-inline">
        <!-- <li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
        <li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
        <li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li> -->
        </ul>
    <?= form_close() ?>
</div>

<div>
    <div class="col-sm-12">
        <?php foreach ($posts as $post): ?>
			<?php 
				$user = $this->db->where('id', $post->user_id)->get('users')->row();
			?>
			<div class="panel panel-white post">
				<div class="post-heading">
					<div class="pull-left meta">
						<div class="title h5">
							<a href="#"><b><?= $user->name ?></b></a>
							made a post.
						</div>
						<h6 class="text-muted time"><?= $post->date ?></h6>
					</div>
				</div> 
				<div class="post-description"> 
					<p><?= $post->body ?></p>
				</div>
				<div class="post-footer">
				<?= form_open('/home/comment', ['class' => 'form-horizontal', 'role' => 'form']) ?>
					<?= form_hidden('user_id', $this->session->userdata('id')) ?>
					<?= form_hidden('post_id', $post->id) ?>
					<div class="input-group">
						<?= form_input('body', $inputComment->body, ['class' => 'form-control', 'placeholder' => 'Add a comment']) ?>
						<?= form_error('body') ?>
						<span class="input-group-addon">
							<button type="submit"><i class="fa fa-edit"></i></button>  
						</span>
					</div>
					<?= form_close() ?>
					<ul class="comments-list">
					<?php
						$comments = $this->db->where('post_id', $post->id)->get('comments')->result();
					?>
					<?php foreach($comments as $comment) : ?>
						<?php 
							$userComment = $this->db->where('id', $comment->user_id)->get('users')->row();
						?>
						<li class="comment">
							<div class="comment-body">
								<div class="comment-heading">
									<h4 class="user"><?= $userComment->name ?></h4>
									<h5 class="time"><?= $comment->date ?></h5>
								</div>
								<p><?= $comment->body ?></p>
							</div>						
						</li>
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
		<?php endforeach; ?>
    </div>
</div>
