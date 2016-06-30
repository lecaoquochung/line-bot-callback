<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Line Callback'), ['action' => 'edit', $lineCallback->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Line Callback'), ['action' => 'delete', $lineCallback->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lineCallback->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Line Callbacks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Line Callback'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lineCallbacks view large-9 medium-8 columns content">
    <h3><?= h($lineCallback->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Result') ?></th>
            <td><?= h($lineCallback->result) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($lineCallback->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($lineCallback->date) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($lineCallback->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($lineCallback->modified) ?></td>
        </tr>
    </table>
</div>
