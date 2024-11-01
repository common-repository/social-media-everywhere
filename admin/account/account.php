<?php 

abstract class AbstractSocialMediaEverywhereAccount
{
    public function render()
    {
    ?>
<div class="<?php echo $this->getClassName(); ?> setting-row">
    <label for="<?php echo $this->getOptionName(); ?>"><?php echo $this->getTitle(); ?></label>
    <input type="text" id="<?php echo $this->getOptionName(); ?>" name="<?php echo $this->getOptionName(); ?>" value="<?php echo get_option($this->getOptionName()); ?>" />
</div>
    <?php
    }

    protected abstract function getClassName();

    protected abstract function getOptionName();

    protected abstract function getTitle();
}
