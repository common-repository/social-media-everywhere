<?php

include_once SME_PATH . 'public/popup/twitter_popup.php';
include_once SME_PATH . 'public/popup/linkedin_popup.php';
include_once SME_PATH . 'public/popup/facebook_popup.php';
include_once SME_PATH . 'public/popup/google_plus_popup.php';
include_once SME_PATH . 'public/popup/instagram_popup.php';
include_once SME_PATH . 'public/popup/youtube_popup.php';

final class SocialMediaEverywherePublicPopup
{
    private $popups = [];

    public function __construct()
    {
        array_push($this->popups, new SocialMediaEverywhereFacebookPopup());
        array_push($this->popups, new SocialMediaEverywhereTwitterPopup());
        array_push($this->popups, new SocialMediaEverywhereLinkedInPopup());
        array_push($this->popups, new SocialMediaEverywhereGooglePlusPopup());
        array_push($this->popups, new SocialMediaEverywhereInstagramPopup());
        array_push($this->popups, new SocialMediaEverywhereYoutubePopup());
    }

    public function setup()
    {
        ?>

<div id="social-media-everywhere-modal" class="social-media-everywhere-modal">
    <div id="social-media-everywhere-popup">
        <div id="social-media-everywhere-popup-content">
            <h2><?php echo get_option(SME_POPUP_TITLE); ?></h2>
            <div class="icons">
                <?php foreach ($this->popups as $popup): ?>
                <?php echo $popup->render(); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php
    }
}
