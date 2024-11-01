<?php

include_once SME_PATH . 'admin/account/account.php';

final class SocialMediaEverywhereLinkedInAccount extends AbstractSocialMediaEverywhereAccount
{
    protected function getClassName() {
        return 'account-linkedin';
    }

    protected function getOptionName() {
        return SME_LINKEDIN_ACCOUNT;
    }

    protected function getTitle() {
        return 'LinkedIn account';
    }
}
