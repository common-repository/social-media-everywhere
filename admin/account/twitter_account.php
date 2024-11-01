<?php

include_once SME_PATH . 'admin/account/account.php';

final class SocialMediaEverywhereTwitterAccount extends AbstractSocialMediaEverywhereAccount
{
    protected function getClassName() {
        return 'account-twitter';
    }

    protected function getOptionName() {
        return SME_TWITTER_ACCOUNT;
    }

    protected function getTitle() {
        return 'Twitter account';
    }
}
