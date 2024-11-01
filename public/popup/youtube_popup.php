<?php

include_once SME_PATH . 'public/popup/popup.php';

final class SocialMediaEverywhereYoutubePopup extends SocialMediaEverywherePopup
{
    protected function getPopupOptionName() {
        return SME_YOUTUBE_ACCOUNT;
    }

    protected function getClassName() {
        return 'youtube';
    }
}
