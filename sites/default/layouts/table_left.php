<?php echo html_header($node['title']); ?>

<table>
	<tr>
		<td width="200">
			<?php $block=block_get('1'); echo block_format($block); ?>
		</td>
		<td>
			<?php echo node_format($node); ?>
		</td>
	</tr>
</table>
<?php echo html_footer(); ?>
