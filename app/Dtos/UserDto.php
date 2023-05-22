<?php

namespace PavelPlot\App\Dtos;

class UserDto
{
    public function __construct(public string $name, public string $login, public string $password, public string $date_birth)
    {
    }

    public static function fromArray(array $user): self
    {
        return new self(...$user);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'login' => $this->login,
            'password' => $this->password,
            'date_birth' => $this->date_birth,
        ];
    }

    public function toJson(): bool|string
    {
        return json_encode($this->toArray());
    }
}