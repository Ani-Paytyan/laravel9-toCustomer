<?php

namespace App\Helpers;

use Carbon\Carbon;

class AppVersion
{
    private string $version;
    private Carbon $buildDate;

    public static function getEnvironment(): string
    {
        return ucfirst(config('app.env'));
    }

    /**
     * @return string
     */
    public static function getAppVersion(): string
    {
        self::createFromJson(json_decode(file_get_contents(storage_path() . "/version.json"), true));

        return ((new self())->getBuildDate() ? (new self())->getBuildDate()->format('Ymd') : '')
            . ' ' . __('attributes.version') . (new self())->getVersion()
            . ' ' . self::getEnvironment();
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return Carbon
     */
    public function getBuildDate(): Carbon
    {
        return $this->buildDate;
    }

    public function setBuildDate(Carbon $buildDate): self
    {
        $this->buildDate = $buildDate;

        return $this;
    }

    public static function createFromJson($data): self
    {
        return (new self())
            ->setVersion($data['version'])
            ->setBuildDate(Carbon::parse($data['buildDate']));
    }
}
