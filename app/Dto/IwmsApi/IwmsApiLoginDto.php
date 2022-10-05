<?php

namespace App\Dto\IwmsApi;

class IwmsApiLoginDto
{
    private string $email;
    private string $password;
    private string $ip;
    private string $mac;
    private string $device;
    private string $system;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;
        return $this;
    }

    public function getMac(): string
    {
        return $this->mac;
    }

    public function setMac(string $mac): self
    {
        $this->mac = $mac;
        return $this;
    }

    public function getDevice(): string
    {
        return $this->device;
    }

    public function setDevice(string $device): self
    {
        $this->device = $device;
        return $this;
    }

    public function getSystem(): string
    {
        return $this->system;
    }

    public function setSystem(string $system): self
    {
        $this->system = $system;
        return $this;
    }
}