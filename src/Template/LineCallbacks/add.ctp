<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Line Callbacks'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="lineCallbacks form large-9 medium-8 columns content">
    <?= $this->Form->create($lineCallback) ?>
    <fieldset>
        <legend><?= __('Add Line Callback') ?></legend>
        <?php
            echo $this->Form->input('result');
            echo $this->Form->input('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
