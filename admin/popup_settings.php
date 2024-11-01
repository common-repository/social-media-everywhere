<?php

include_once SME_PATH . 'admin/settings.php';
include_once SME_PATH . 'shared/time_resolver.php';

final class SocialMediaEverywherePopupSettings implements Settings
{
    private $timeResolver;

    public function __construct()
    {
        $this->timeResolver = new SocialMediaEverywhereTimeResolver();
        add_action('admin_init', array($this, 'registerSettings'));
    }

    public function getHeaderLabel()
    {
        return "Popup settings";
    }

    public function render()
    {
    ?>
<div id="sme-popup-settings" class="settings">
    <div id="sme-popup-show-settings" class="settings-section">
        <div class="setting-row">
            <input type="radio" name="<?php echo SME_POPUP_SHOW_SETTING; ?>" value="0" <?php checked(get_option(SME_POPUP_SHOW_SETTING), 0); ?>>Disabled
        </div>
        <div class="setting-row">
            <input type="radio" name="<?php echo SME_POPUP_SHOW_SETTING; ?>" value="1" <?php checked(get_option(SME_POPUP_SHOW_SETTING), 1); ?>>At the end of the posts
        </div>
        <div class="popup-timed-setting setting-row">
            <input type="radio" name="<?php echo SME_POPUP_SHOW_SETTING; ?>" value="2" <?php checked(get_option(SME_POPUP_SHOW_SETTING), 2); ?>>After X seconds arriving to the page
        </div>
    </div>
    <div id="sme-popup-timing-settings" class="settings-section">
        <div class="popup-timed-setting setting-row">
            <label for="<?php echo SME_POPUP_TIMED_SEC; ?>">X seconds</label>
            <input type="text" id="<?php echo SME_POPUP_TIMED_SEC; ?>" name="<?php echo SME_POPUP_TIMED_SEC; ?>" value="<?php echo get_option(SME_POPUP_TIMED_SEC); ?>" />
            <i class="fas fa-question">
                <div class="tooltip">Determines the seconds after the popup should be shown to the user right after arriving to the page</div>
            </i>
        </div>
        <div class="popup-expiration-setting setting-row">
            <label for="<?php echo SME_POPUP_EXPIRATION; ?>">Popup seen expiration time</label>
            <input type="text" id="<?php echo SME_POPUP_EXPIRATION; ?>" name="<?php echo SME_POPUP_EXPIRATION; ?>" value="<?php echo get_option(SME_POPUP_EXPIRATION); ?>" />
            <i class="fas fa-question">
                <div class="tooltip">
                    <span>Determines the expiration time for showing the popup again.</span><br>
                    <span class="tooltip-title">The following modifiers are allowed:</span>
                    <ul>
                        <li>s - second</li>
                        <li>m - minute</li>
                        <li>h - hour</li>
                        <li>d - day</li>
                        <li>mo - month</li>
                        <li>y - year</li>
                    </ul>
                    <span class="tooltip-title">Examples:</span>
                    <ul>
                        <li>1d - once a day</li>
                        <li>1w - once a week</li>
                        <li>10h - once every 10 hours</li>
                    </ul>
                </div>
            </i>
        </div>
    </div>
    <div id="sme-popup-title-settings" class="settings-section">
        <div class="popup-title-setting setting-row">
            <label for="<?php echo SME_POPUP_TITLE; ?>">Title for popup: </label>
            <input type="text" id="<?php echo SME_POPUP_TITLE; ?>" name="<?php echo SME_POPUP_TITLE; ?>" value="<?php echo get_option(SME_POPUP_TITLE); ?>" />
        </div>
    </div>
    
</div>


<?php
    }

    public function registerSettings()
    {
        add_option(SME_POPUP_SHOW_SETTING, '0');
        register_setting(SME_OPTIONS_GROUP, SME_POPUP_SHOW_SETTING);
        
        add_option(SME_POPUP_TIMED_SEC, '0');
        register_setting(SME_OPTIONS_GROUP, SME_POPUP_TIMED_SEC, array(
            'sanitize_callback' => array($this, 'handleTimedPopupSecondsChange')
        ));

        add_option(SME_POPUP_TITLE, 'Follow me');
        register_setting(SME_OPTIONS_GROUP, SME_POPUP_TITLE);

        add_option(SME_POPUP_EXPIRATION, '0');
        register_setting(SME_OPTIONS_GROUP, SME_POPUP_EXPIRATION, array(
            'sanitize_callback' => array($this, 'handleExpirationChange')
        ));
    }

    public function handleExpirationChange($expirationValue) {
        $resolvedTime = $this->timeResolver->resolve($expirationValue);
        if ($resolvedTime === 0) {
            return 0;
        }
        return $expirationValue;
    }

    public function handleTimedPopupSecondsChange($seconds) {
        if (empty($seconds) || intval($seconds) < 1) {
            return 1;
        }
        return $seconds;
    }
}
