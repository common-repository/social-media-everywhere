<?php

include_once SME_PATH . 'admin/account/account.php';

final class SocialMediaEverywhereInstagramAccount extends AbstractSocialMediaEverywhereAccount
{
    protected function getClassName() {
        return 'account-instagram';
    }

    protected function getOptionName() {
        return SME_INSTAGRAM_ACCOUNT;
    }

    protected function getTitle() {
        return 'Instagram account';
    }
}
