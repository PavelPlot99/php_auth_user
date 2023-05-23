<?php

namespace PavelPlot\App\Dtos;

class UserDto
{
    public function __construct(public string|null $name, public string $login, public string $password, public string|null $date_birth, public string|null $image)
    {
    }

    public static function fromArray(array $user): self
    {
        return new self($user['name'] ?? null, $user['login'], $user['password'], $user['date_birth'] ?? null, $user['image'] ?? null) ;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'login' => $this->login,
            'password' => $this->password,
            'date_birth' => $this->date_birth,
            'image' => $this->image,
        ];
    }

    public function toJson(): bool|string
    {
        return json_encode($this->toArray());
    }
}