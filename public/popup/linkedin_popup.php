<?php

include_once SME_PATH . 'public/popup/popup.php';

final class SocialMediaEverywhereLinkedInPopup extends SocialMediaEverywherePopup
{
    protected function getPopupOptionName() {
        return SME_LINKEDIN_ACCOUNT;
    }

    protected function getClassName() {
        return 'linkedin-in';
    }
}
