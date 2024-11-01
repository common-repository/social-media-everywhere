<?php
abstract class SocialMediaEverywherePopup
{
    public function render()
    {
        ?>
<?php if (!empty(get_option($this->getPopupOptionName()))): ?>
<a href="<?php echo get_option($this->getPopupOptionName()); ?>" class="icon social <?php echo $this->getClassName(); ?>" target="_blank">
    <i class="fab fa-<?php echo $this->getClassName(); ?>"></i>
</a>
<?php endif; ?>
<?php
    }

    abstract protected function getPopupOptionName();

    abstract protected function getClassName();
}
