<?php

namespace App\Models;

class Product extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public ?string $name = null,
        public ?string $material = null,
        public ?string $description = null,
        public ?string $image = null
    )
    {

    }

    static public function setDbColumns()
    {
        return ['id', 'name', 'material', 'description', 'image', ];
    }

    static public function setTableName()
    {
        return "products";
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getMaterial(): ?string
    {
        return $this->material;
    }

    /**
     * @param string|null $material
     */
    public function setMaterial(?string $material): void
    {
        $this->material = $material;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }
}