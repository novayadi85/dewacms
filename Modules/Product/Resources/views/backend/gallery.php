<div class="form-group row">
	<?php if(sizeof($images)) : ?>
		<?php foreach($images as $image): 
		if(empty($image->guid) || $image->guid == null) $image->guid = 'http://fakeimg.pl/365x365/';
		?>
		<div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe" style="margin-bottom:25px;">
			<img src="<?php echo $image->guid;?>" class="img-responsive"><br>
			<center><a ng-click="removeImage(<?=$image->id;?>)" class="btn red">Remove</a></center>
		</div>
		<?php endforeach;?>
	<?php endif;?>
</div>
