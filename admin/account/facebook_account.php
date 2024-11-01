<?php

include_once SME_PATH . 'admin/account/account.php';

final class SocialMediaEverywhereFacebookAccount extends AbstractSocialMediaEverywhereAccount
{
    protected function getClassName() {
        return 'account-facebook';
    }

    protected function getOptionName() {
        return SME_FACEBOOK_ACCOUNT;
    }

    protected function getTitle() {
        return 'Facebook account';
    }
}
