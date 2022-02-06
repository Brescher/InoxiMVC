<?php

namespace App\Models;

class User extends \App\Core\Model
{

    public function __construct(
        public int     $id = 0,
        public ?string $email = null,
        public ?string $username = null,
        public ?string $password = null,
        public ?string $userType = null
    )
    {

    }

    static public function setDbColumns()
    {
        return ['id', 'email', 'username', 'password', 'userType'];
    }

    static public function setTableName()
    {
        return 'users';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getUserType(): ?string
    {
        return $this->userType;
    }

    /**
     * @param string|null $userType
     */
    public function setUserType(?string $userType): void
    {
        $this->userType = $userType;
    }


}