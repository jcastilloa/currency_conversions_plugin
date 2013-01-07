
<hgroup id="main-title" class="thin">
			<h1><?php echo __('Currency Conversions'); ?></h1>	
			<?php echo $this->element('fecha'); ?>
			
</hgroup>

<div class="currencyConversions with-padding">	

	
    <div class="table-header button-height silver-gradient glossy">
		 <?php echo $this->Form->create('Basica');?>
 <?php echo $this->Form->input('dsc', array('class' => 'input mid-margin-left', 'empty' => true, 'label' => array('class' => 'label'), 'div' => 'button-height inline-label float-left'));?>
 <?php echo $this->Form->submit(__('Filtrar'), array('div'=>false, 'name'=>'submit', 'class' => 'button margin-left')); ?>
 <?php echo $this->Form->submit(__('Limpiar'), array('div'=>false, 'name'=>'clear', 'class' => 'button margin-left')); ?>
 <?php echo $this->Form->end();?>
		
    </div>
	<table cellpadding="0" cellspacing="0" class="table responsive-table responsive-table-on dataTable">
	<thead>
	<tr>
			<th scope="col" class="header"><?php echo $this->Paginator->sort('id'); ?></th>
			<th scope="col" class="header"><?php echo $this->Paginator->sort('dsc'); ?></th>
			<th scope="col" class="header"><?php echo $this->Paginator->sort('value'); ?></th>
			<th scope="col" class="header"><?php echo $this->Paginator->sort('created'); ?></th>
			<th scope="col" class="header"><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions header"></th>
	</tr>
	</thead>
	<tfoot>
		<td colspan="6"><p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('P&aacute;gina {:page} de {:pages}. Se muestran {:current} registros de {:count}. Comienza en el registro {:start}, finaliza en el {:end}')
		));
		?>		</p></td>	
	</tfoot>
	<tbody>
	<?php
	foreach ($currencyConversions as $currencyConversion): ?>
	<tr>
		<td><?php echo h($currencyConversion['CurrencyConversion']['id']); ?>&nbsp;</td>
		<td><?php echo h($currencyConversion['CurrencyConversion']['dsc']); ?>&nbsp;</td>
		<td><?php echo h($currencyConversion['CurrencyConversion']['value']); ?>&nbsp;</td>
		<td><?php echo h($currencyConversion['CurrencyConversion']['created']); ?>&nbsp;</td>
		<td><?php echo h($currencyConversion['CurrencyConversion']['modified']); ?>&nbsp;</td>
		<td class="actions">
		<span class="button-group compact">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $currencyConversion['CurrencyConversion']['id']), array('class' => 'button icon-pencil with-tooltip', 'title' => __('Editar'))); ?>
			<?php echo $this->Html->link('', array('action' => 'view', $currencyConversion['CurrencyConversion']['id']), array('class' => 'button icon-gear with-tooltip', 'title' =>  __('Visualizar'))); ?>
			<?php echo $this->Form->postLink('', array('action' => 'delete', $currencyConversion['CurrencyConversion']['id']), array('class' => 'button icon-trash with-tooltip confirm', 'title' => __('Eliminar')), __('Está seguro de que desea eliminar # %s?', $currencyConversion['CurrencyConversion']['id'])); ?>
		</span>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	
	<div class="table-footer button-height silver-gradient glossy">	
		<div class="paging">
		<?php
		echo $this->Paginator->prev(__('anterior'), array('class' => 'icon-backward button blue-gradient glossy'), null, array('class' => 'icon-backward prev button disabled glossy'));
		echo $this->Paginator->numbers(array('separator' => '', 'class' => 'button blue-gradient glossy'));
		echo $this->Paginator->next(__('siguiente'), array('class' => 'icon-forward button blue-gradient glossy'), null, array('class' => 'icon-forward next button disabled glossy'));
	?>
		</div>
	</div>
</div>

    <div class="with-padding">
     <details class='details margin-bottom'>
 <summary role='button' aria-expanded='false'><?php echo __('Avanzado'); ?></summary>
 <div div class='with-padding'>
 <?php echo $this->Form->create('actualizar');?>
 	<div class='with-mid-padding'></div>
 	<span class='button-group compact'>
     <?php echo $this->Form->submit(__('Actualizar Ahora'), array('div'=>false, 'name'=>'actualizar', 'class' => 'button')); ?>     
 	</span>
 <?php echo $this->Form->end();?>
 </div>
 </details>
	
	</div>


