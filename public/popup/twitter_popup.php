<?php

include_once SME_PATH . 'public/popup/popup.php';

final class SocialMediaEverywhereTwitterPopup extends SocialMediaEverywherePopup
{
    protected function getPopupOptionName() {
        return SME_TWITTER_ACCOUNT;
    }

    protected function getClassName() {
        return 'twitter';
    }
}
