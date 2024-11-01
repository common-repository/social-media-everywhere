<?php

include_once SME_PATH . 'public/popup/popup.php';

final class SocialMediaEverywhereFacebookPopup extends SocialMediaEverywherePopup
{
    protected function getPopupOptionName() {
        return SME_FACEBOOK_ACCOUNT;
    }

    protected function getClassName() {
        return 'facebook-f';
    }
}
