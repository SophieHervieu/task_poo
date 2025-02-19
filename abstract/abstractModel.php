<?php
abstract class AbstractModel {
    private ?InterfaceBDD $bdd;

    public function __construct(?InterfaceBDD $bdd) {
        $this->bdd = $bdd;
    }

    public function getBdd(): ?InterfaceBDD {
        return $this->bdd;
    }

    public function setBdd(?InterfaceBDD $bdd): self {
        $this->bdd = $bdd;
        return $this;
    }

    public abstract function add(): void;
    public abstract function update(): void;
    public abstract function delete(): void;
    public abstract function getAll(): ?array;
    public abstract function getById(): ?array;
}