<?php

include_once SME_PATH . 'admin/account/account.php';

final class SocialMediaEverywhereYoutubeAccount extends AbstractSocialMediaEverywhereAccount
{
    protected function getClassName() {
        return 'account-youtube';
    }

    protected function getOptionName() {
        return SME_YOUTUBE_ACCOUNT;
    }

    protected function getTitle() {
        return 'Youtube account';
    }
}
