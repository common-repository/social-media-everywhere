<?php

include_once SME_PATH . 'admin/general_settings.php';
include_once SME_PATH . 'admin/popup_settings.php';

final class SocialMediaEverywhereAdmin
{
    private $pages = [];

    public function setup()
    {
        array_push($this->pages, new SocialMediaEverywhereGeneralSettings());
        array_push($this->pages, new SocialMediaEverywherePopupSettings());
        
        add_action('admin_enqueue_scripts', array($this, 'addStyle'));
        add_action('admin_enqueue_scripts', array($this, 'addScript'));
        add_action('admin_menu', array($this, 'registerOptionsPage'));
    }

    public function addStyle()
    {
        wp_register_style('socialmediaeverywhere', SME_URL . 'admin/css/socialmediaeverywhere.css');
        wp_register_style('socialmediaeverywhere-fontawesome', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css');
        wp_enqueue_style('socialmediaeverywhere');
        wp_enqueue_style('socialmediaeverywhere-fontawesome');
    }

    public function addScript()
    {
        wp_register_script('socialmediaeverywhere', SME_URL . 'admin/js/socialmediaeverywhere.js', array('jquery'), '1.0', true);
        wp_enqueue_script('socialmediaeverywhere');
    }

    public function registerOptionsPage()
    {
        add_options_page('Social Media Everywhere settings', 'Social Media Everywhere', 'manage_options', 'socialmediaeverywhere', array($this, 'renderOptionsPage'));
    }

    public function renderOptionsPage()
    {
        ?>

<div>
    <?php screen_icon(); ?>
    <h1>Social Media Everywhere settings</h1>

    <form id="sme-settings" method="post" action="options.php">
        <?php settings_fields(SME_OPTIONS_GROUP); ?>

        <header>
            <?php for ($i=0; $i < count($this->pages); $i++): ?>
            <?php $page = $this->pages[$i]; ?>
            <h3 <?php if ($i==0) : echo 'class="active"'; endif; ?>>
                <?php echo $page->getHeaderLabel(); ?>
            </h3>
            <?php endfor; ?>
        </header>
        <main>
            <?php for ($i=0; $i < count($this->pages); $i++): ?>
            <?php $page = $this->pages[$i]; ?>
            <div <?php if ($i==0) : echo 'class="active"'; endif; ?>>
                <?php $page->render(); ?>
            </div>
            <?php endfor; ?>
        </main>
        <?php submit_button(); ?>
    </form>
</div>

<?php
    }
}
