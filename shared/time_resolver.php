<?php

define('SME_TIME_PATTERN', "/^(\d+)(s|m|h|d|mo|y)$/");

final class SocialMediaEverywhereTimeResolver {
    public function resolve($value) {
        if (empty($value)) {
            return 0;
        }
        if ($this->isInteger($value)) {
            return intval($value); // return pure seconds
        }
        if ($this->isTime($value)) {
            return $this->getTime($value)->toSeconds();
        }
        return 0;
    }

    private function getTime($value) {
        preg_match(SME_TIME_PATTERN, $value, $groups);
        return new SocialMediaEverywhereTime($groups[1], $groups[2]);
    }

    private function isTime($value) {
        return preg_match(SME_TIME_PATTERN, $value);
    }

    private function isInteger($value) {
        return preg_match("/^\d+$/", $value);
    }
}


final class SocialMediaEverywhereTime {
    private $number;
    private $unit;

    public function __construct($number, $unit) {
        $this->number = $number;
        $this->unit = $unit;
    }

    public function toSeconds() {
        $multiplier = 1;
        if ($this->unit === 'm') {
            $multiplier = 60;
        }
        if ($this->unit === 'h') {
            $multiplier = 60 * 60;
        }
        if ($this->unit === 'd') {
            $multiplier = 60 * 60 * 24;
        }
        if ($this->unit === 'mo') {
            $multiplier = 60 * 60 * 24 * 30;
        }
        if ($this->unit === 'y') {
            $multiplier = 60 * 60 * 24 * 365;
        }
        return $this->number * $multiplier;
    }
}