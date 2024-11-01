<?php

include_once SME_PATH . 'admin/account/account.php';

final class SocialMediaEverywhereGooglePlusAccount extends AbstractSocialMediaEverywhereAccount
{
    protected function getClassName() {
        return 'account-google-plus';
    }

    protected function getOptionName() {
        return SME_GOOGLE_PLUS_ACCOUNT;
    }

    protected function getTitle() {
        return 'Google+ account';
    }
}
