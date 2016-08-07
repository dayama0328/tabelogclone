<div style="float:right;">
<?=$this->Html->link('レストラン登録', array('controller' => 'shops', 'action' => 'add')); ?>

</div>
<h2>レストラン一覧</h2>
<?=$this->Session->Flash('auth')?>
<script>
<?php echo $this->Js->request(array('action' => 'shoplist'), array('async' => true, 'update' => '#display')); ?>
</script>
<div id="display">

</div>