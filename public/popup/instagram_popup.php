<?php

include_once SME_PATH . 'public/popup/popup.php';

final class SocialMediaEverywhereInstagramPopup extends SocialMediaEverywherePopup
{
    protected function getPopupOptionName() {
        return SME_INSTAGRAM_ACCOUNT;
    }

    protected function getClassName() {
        return 'instagram';
    }
}
