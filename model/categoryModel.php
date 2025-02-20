<?php
class categoryModel extends AbstractModel{
    private ?int $id;
    private ?string $name;

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): self {
        $this->name = $name;
        return $this;
    }

    public function add(): void {
        try {
            $bdd = $this->getBdd()->connexion();
            $name = $this->getName();
            
            $requete = "INSERT INTO category(name) VALUE(?)";
            $req = $bdd->prepare($requete);
            $req->bindParam(1, $name, PDO::PARAM_STR);
            $req->execute();
        } catch (Exception $e) {
            echo "Erreur" . $e->getMessage();
        }
    }

    public function update(): void {
        try {
            $bdd = $this->getBdd()->connexion();
            $name = $this->getName();

            $requete = "UPDATE category SET name=? WHERE name=?";
            $req = $bdd->prepare($requete);
            $req->bindParam(1, $name, PDO::PARAM_STR);
            $req->bindParam(2, $name, PDO::PARAM_STR);
            $req->execute();
        } catch (Exception $e) {
            echo "Erreur" . $e->getMessage();
        }
    }
    
    public function delete(): void {
        try {
            $bdd = $this->getBdd()->connexion();
            $name = $this->getName();

            $requete = "DELETE FROM category WHERE name = ?";
            $req = $bdd->prepare($requete);
            $req->bindParam(1, $name, PDO::PARAM_STR);
            $req->execute();
        } catch (Exception $e) {
            echo "Erreur" . $e->getMessage();
        }
    }

    public function getAll(): ?array {
        try {
            $bdd = $this->getBdd()->connexion();

            $requete = "SELECT id_category, name FROM category";
            $req = $bdd->prepare($requete);
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur" . $e->getMessage();
        }
    }

    public function getById(): ?array {
        try {
            $bdd = $this->getBdd()->connexion();
            $id = $this->getId();

            $requete = "SELECT id_category, name FROM category WHERE name=?";
            $req = $bdd->prepare($requete);
            $req->bindParam(1, $id, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur" . $e->getMessage();
        }
    }

    function getCategoryByName(PDO $bdd, string $name): array|null|string {
        try {
            $bdd = $this->getBdd()->connexion();
            $name = $this->getName();

            $requete = "SELECT id_category, name FROM category WHERE name=?";
            $req = $bdd->prepare($requete);
            $req->bindParam(1, $name, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur" . $e->getMessage();
        }
    }
}