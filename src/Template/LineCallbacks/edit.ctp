<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $lineCallback->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lineCallback->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Line Callbacks'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="lineCallbacks form large-9 medium-8 columns content">
    <?= $this->Form->create($lineCallback) ?>
    <fieldset>
        <legend><?= __('Edit Line Callback') ?></legend>
        <?php
            echo $this->Form->input('result');
            echo $this->Form->input('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
