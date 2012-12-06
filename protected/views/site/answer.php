<div>
	<div>等待您来回答</div>
	<div>
		<table>
			<?php foreach ($answer as $onw){?>
			<?php if(count($onw->answer)==0){?>
			<tr>
				<td><?php echo CHtml::value($onw, 'title')?></td>
				<td><?php echo date("Y/m/d",$onw->createdat)?></td>
				<td><?php echo count($onw->answer) ?>个答案</td>
				<?php var_dump($onw->answer);?>
				<td><?php echo CHtml::value($onw, 'answer.top')?></td>
			</tr>
			<?php }?>
			<?php }?>
		</table>
	</div>
</div>