<?php foreach($list as $data) : ?>
  <table style="border:solid 1px #000;">
    <tr>
      <td style="width:30%;">
        <?=$this->Html->link($data['Shop']['name'], array('action' => 'view', $data['Shop']['id'])); ?>
      </td>
      <td style="widh:70%;">
        登録日：<?=$this->Time->format($data['Shop']['created'], '%Y/%m/%d'); ?>
      </td>
    </tr>
    <tr>
        <td rowspan="2" style="text-align:center;">
        <?=$this->Html->image('square.jp')?>
        </td>
        <td>
          口コミ <?=count($data['Review'])?>
        </td>
    </tr>
    <tr>
        <td>
        <?php if(!empty($data['Review'])) : ?>
          <?php foreach($data['Review'] as $value) : ?>
          <?=$value['title']?>()<span style="color:#b22222">()</span><br>
        <?php endforeach; ?>
        <?php endif; ?>
        </td>
    </tr>
  </table>
<?php endforeach; ?>
<div style="text-align:center;">
<?php
echo $this->Paginator->prev('<前へ', array('update' => '#display'));
echo $this->Paginator->numbers(array('update' => '#display'));
echo $this->Paginator->next('次へ>', array('update' => '#display'));
?>
<?php echo $this->Js->writeBuffer(array('inline' => true))?>
</div>