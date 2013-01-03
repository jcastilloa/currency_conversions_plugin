<hgroup id="main-title" class="thin">
			<h1><?php  echo __('Currency Conversion'); ?></h1>
			<?php echo $this->element('fecha'); ?>
</hgroup>

<div class="currencyConversions with-padding">
<div class="block margin-bottom">
     <div class="block-title">
			<h3><?php echo __('Visualizar Currency Conversion'); ?></h3>		
			<div class="button-group absolute-right compact">
							<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $id), array('class' => 'button icon-pencil with-tooltip', 'title' =>  __('Editar'))); ?>
			
			</div>
	</div>	
	<div class="with-padding">	
	<table class="table responsive-table responsive-table-on dataTable" id="sorting-advanced" aria-describedby="sorting-advanced_info">	
			<tbody role="alert" aria-live="polite" aria-relevant="all">	
		<tr class='odd'>
		<td><?php echo __('Id'); ?></td>
		<td>
			<?php echo h($currencyConversion['CurrencyConversion']['id']); ?>
			&nbsp;
		</td>
		</tr>
		<tr class='even'>
		<td><?php echo __('Dsc'); ?></td>
		<td>
			<?php echo h($currencyConversion['CurrencyConversion']['dsc']); ?>
			&nbsp;
		</td>
		</tr>
		<tr class='odd'>
		<td><?php echo __('Value'); ?></td>
		<td>
			<?php echo h($currencyConversion['CurrencyConversion']['value']); ?>
			&nbsp;
		</td>
		</tr>
		<tr class='even'>
		<td><?php echo __('Created'); ?></td>
		<td>
			<?php echo h($currencyConversion['CurrencyConversion']['created']); ?>
			&nbsp;
		</td>
		</tr>
		<tr class='odd'>
		<td><?php echo __('Modified'); ?></td>
		<td>
			<?php echo h($currencyConversion['CurrencyConversion']['modified']); ?>
			&nbsp;
		</td>
		</tr>

			</tbody>
    </table>   

	</div>
</div>

	<div class="wrapped button-height">
	<?php echo $this->Form->create('cancel');?>
<?php echo $this->Form->submit(__('Volver'), array('class' => 'button green-gradient', 'div'=>false, 'name'=>'cancel'));?>
<?php echo $this->Form->end();?>
	</div>

</div>
<div class="clear-both columns with-padding">
	<div class="boxed">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Currency Conversion'), array('action' => 'edit', $currencyConversion['CurrencyConversion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Currency Conversion'), array('action' => 'delete', $currencyConversion['CurrencyConversion']['id']), null, __('Are you sure you want to delete # %s?', $currencyConversion['CurrencyConversion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Currency Conversions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency Conversion'), array('action' => 'add')); ?> </li>
	</ul>
	</div>
		
</div>

