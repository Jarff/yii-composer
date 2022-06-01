<?php
/**
 * This is the template for generating an action view file.
 * The following variables are available in this template:
 * - $this: the ControllerCode object
 * - $action: the action ID
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */

?>
<!-- Widget -->
<div class="widget  span12 clearfix">

	<div class="widget-header">
		<span>
			<i class="icon-align-left"></i>
			<?php echo '<?php'; ?> echo $this->id . '/' . $this->action->id; ?>			
		</span>
	</div><!-- End widget-header -->	
	
	<div class="widget-content">

		<p>
			Cambiar el Contenido en el archivo <tt><?php echo '<?php'; ?> echo __FILE__; ?></tt>.
		</p>
		
	</div>
	
</div>
