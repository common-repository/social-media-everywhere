<?php

include_once SME_PATH . 'public/popup/popup_core.php';
include_once SME_PATH . 'shared/time_resolver.php';

final class SocialMediaEverywherePublic
{
    private $timeResolver;

    public function __construct() {
        $this->timeResolver = new SocialMediaEverywhereTimeResolver();
    }

    public function setup()
    {
        if ($this->isSMEEnabled()) {
            if ($this->isPopupEnabled()) {
                $popup = new SocialMediaEverywherePublicPopup();
                add_action('wp_footer', array($popup, 'setup'));
                if ($this->isPopupAtBottomEnabled()) {
                    add_filter('the_content', array($this, 'addBottomElementForPopup'));
                }
            }
            add_action('wp_enqueue_scripts', array($this, 'addStyle'));
            add_action('wp_enqueue_scripts', array($this, 'addScript'));
        }
    }

    public function addStyle()
    {
        wp_register_style('socialmediaeverywhere', SME_URL . 'public/css/socialmediaeverywhere.css');
        wp_register_style('socialmediaeverywhere-fontawesome', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css');
        wp_enqueue_style('socialmediaeverywhere');
        wp_enqueue_style('socialmediaeverywhere-fontawesome');
    }

    public function addScript()
    {
        wp_register_script('socialmediaeverywhere', SME_URL . 'public/js/socialmediaeverywhere.js', array('jquery'), '1.0', true);
        wp_enqueue_script('socialmediaeverywhere');
        wp_localize_script('socialmediaeverywhere', 'SME', array(
            'global' => array(
                'smeEnabled' => $this->isSMEEnabled(),
                'isPost' => $this->isBlogPost()
            ),
            'popup' => array(
                'enabled' => $this->isPopupEnabled(),
                'bottomPopupEnabled' => $this->isPopupAtBottomEnabled(),
                'timedPopupEnabled' => $this->isTimedPopupEnabled(),
                'timedPopupSeconds' => $this->getTimedPopupSeconds(),
                'expirationTimeInSeconds' => $this->getPopupExpirationTimeInSeconds()
            )
        ));
    }

    public function addBottomElementForPopup($content) {
        return $content . '<span id="sme-post-bottom" style="display:inline-block;width:1px;height:1px;"></span>';
    }

    public function isSMEEnabled()
    {
        return intval(get_option(SME_ENABLED)) === 1;
    }

    public function isPopupEnabled()
    {
        return intval(get_option(SME_POPUP_SHOW_SETTING)) !== 0;
    }

    public function isPopupAtBottomEnabled()
    {
        return intval(get_option(SME_POPUP_SHOW_SETTING)) === 1;
    }

    public function isBlogPost() {
        return !is_front_page() && !is_home();
    }

    public function isTimedPopupEnabled() {
        return intval(get_option(SME_POPUP_SHOW_SETTING)) === 2;
    }

    public function getTimedPopupSeconds() {
        return intval(get_option(SME_POPUP_TIMED_SEC));
    }

    public function getPopupExpirationTimeInSeconds() {
        $val = get_option(SME_POPUP_EXPIRATION);
        return $this->timeResolver->resolve($val);
    }
}
