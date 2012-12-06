<div>
	<div>精彩推荐</div>
	<div>
		<table>
			<?php foreach ($recommend as $onw){?>
			<tr>
				<td><?php echo CHtml::value($onw, 'title')?></td>
				<td><?php echo date("Y/m/d",$onw->createdat)?></td>
				<td><?php echo count($onw->answer) ?>个答案</td>
				<?php var_dump($onw);?>
				<td><?php echo CHtml::value($onw, 'answer.top')?></td>
			</tr>
			<?php }?>
		</table>
	</div>
</div>