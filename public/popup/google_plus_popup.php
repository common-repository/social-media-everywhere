<?php

include_once SME_PATH . 'public/popup/popup.php';

final class SocialMediaEverywhereGooglePlusPopup extends SocialMediaEverywherePopup
{
    protected function getPopupOptionName() {
        return SME_GOOGLE_PLUS_ACCOUNT;
    }

    protected function getClassName() {
        return 'google-plus-g';
    }
}
