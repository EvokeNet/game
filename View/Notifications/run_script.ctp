<?php echo $this->Html->script('/components/jquery/jquery.min', array('inline' => false)); ?>
<script src="/socket.io/socket.io.js"></script>
<script>

	var socket = io('http://localhost');
  
	socket.emit('notification_from_server', { hey: 'it works' });

	//alert('YAY');
	
</script>