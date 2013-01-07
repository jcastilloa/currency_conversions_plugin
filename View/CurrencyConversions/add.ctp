<hgroup id="main-title" class="thin">
			<h1><?php echo __('Add Currency Conversion'); ?></h1>
			<?php echo $this->element('fecha'); ?>
</hgroup>

<div class="currencyConversions with-padding">

<p class="wrapped left-icon icon-info-round">
			Introduzca la informaci&oacute;n a agregar				
</p>

<?php echo $this->Form->create('CurrencyConversion'); ?>
	<fieldset class="fieldset">
		<legend class="legend"><?php echo __('Add Currency Conversion'); ?></legend>
			<?php
		echo $this->Form->input('dsc', array('class' => 'input', 'label' => array('class' => 'label'), 'div' => 'button-height inline-label'));
		echo $this->Form->input('value', array('class' => 'input', 'label' => array('class' => 'label'), 'div' => 'button-height inline-label'));
	?>
   
	</fieldset>
<div class="wrapped button-height">
<?php echo $this->Form->submit(__('Guardar'), array('class' => 'button silver-gradient', 'div'=>false, 'name'=>'submit'));
echo $this->Form->submit(__('Cancelar'), array('class' => 'button silver-gradient float-right','div'=>false, 'name'=>'cancel'));
echo $this->Form->end();?>
</div>
</div>
<div class="clear-both columns with-padding">
	<div class="boxed">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Currency Conversions'), array('action' => 'index')); ?></li>
	</ul>
	</div>
</div>
