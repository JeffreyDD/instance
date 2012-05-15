<?php if($node['title'] && $node['title'] != ''){ ?>
	<h1><?php echo $node['title']; ?></h1>
<?php } ?>

<?php if($node['content']['teaser'] && $node['content']['teaser'] != ''){ ?>
<p>
	<strong>
	<?php echo $node['content']['teaser']; ?>
	</strong>
</p>
<?php } ?>

<p>
<?php echo $node['content']['body']; ?>
</p>
