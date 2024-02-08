<?php
//MODEL : Gérer les Datas et l'Accès à la BDD

class ModelUser{
    //Attributs
    private ?int $idUser;
    private ?string $nameUser;
    private ?string $firstNameUser;
    private ?string $loginUser;
    private ?string $passwordUser;

    //Constructeur

    //GEtter et Setter
    public function getId():?int{
        return $this->idUser;
    }
    public function getName():?string{
        return $this->nameUser;
    }
    public function getFirstName():?string{
        return $this->firstNameUser;
    }
    public function getLogin():?string{
        return $this->loginUser;
    }
    public function getPassword():?string{
        return $this->passwordUser;
    }

    public function setId(?int $id):ModelUser{
        $this->idUser = $id;
        return $this;
    }
    public function setName(?string $name):ModelUser{
        $this->nameUser = $name;
        return $this;
    }
    public function setFirstName(?string $firstName):ModelUser{
        $this->firstNameUser = $firstName;
        return $this;
    }
    public function setLogin(?string $login):ModelUser{
        $this->loginUser = $login;
        return $this;
    }
    public function setPassword(?string $password):ModelUser{
        $this->passwordUser = $password;
        return $this;
    }

    //Méthode
    public function loginUser():array|Exception{
        //ETAPE 5 Du Diagramme de Sequence : demander à la BDD si l'utilisateur existe
        try{
            //Connexion à la BDD
            $bdd = new PDO('mysql:host=localhost;dbname=task','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
            //Préparation de la requête
            $req = $bdd->prepare('SELECT user.id_user, user.name_user, user.first_name_user, user.login_user, user.mdp_user FROM user WHERE login_user = ?');
    
            //Récupération du login
            $login = $this->getLogin();

            //Binding de Paramètre
            $req->bindParam(1,$login,PDO::PARAM_STR);
    
            //ETAPE 6 Du Diagramme de Sequence : exécution de la requête
            $req->execute();
    
            //ETAPE 7 Du Diagramme de Sequence : récupérer la réponse de la BDD
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
    
            return $data;
    
            
        }catch(Exception $error){
            return $error;
        }
    }
    
    public function signInUser():string{
        try{
            //Connexion à la BDD
            $bdd = new PDO('mysql:host=localhost;dbname=task','root','',array(
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
            ));
    
            //Prépare ma requête d'insertion
            $req=$bdd->prepare('INSERT INTO user (name_user, first_name_user, login_user, mdp_user) VALUES (?,?,?,?)');
    
            //Récupération des attributs
            $name = $this->getName();
            $firstname = $this->getFirstName();
            $login = $this->getLogin();
            $password = $this->getPassword();

            //Bindinng de Param
            $req->bindParam(1,$name,PDO::PARAM_STR);
            $req->bindParam(2,$firstname,PDO::PARAM_STR);
            $req->bindParam(3,$login,PDO::PARAM_STR);
            $req->bindParam(4,$password,PDO::PARAM_STR);
    
            //Executer la requête
            $req->execute();
    
            return "Inscription effectuée avec succès !";
    
        }catch(Exception $error){
            return $error->getMessage();
        }
    
    }
    
    public function updateUser():array{
        try{
            //ETAPE 9 Du Diagramme de Sequence : Connexion à la BDD
            $bdd = new PDO('mysql:host=localhost;dbname=task','root','',array(
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
            ));
    
            //ETAPE 9 Du Diagramme de Sequence : Préparer la requête
            $req = $bdd->prepare('UPDATE user SET name_user = ?, first_name_user = ? WHERE id_user = ?');

            //Recupération des attributs
            $name = $this->getName();
            $firstname = $this->getFirstName();
            $id = $this->getId();
    
            //ETAPE9 Du Diagramme de Sequence : Binding de Param
            $req->bindParam(1,$name,PDO::PARAM_STR);
            $req->bindParam(2,$firstname,PDO::PARAM_STR);
            $req->bindParam(3,$id,PDO::PARAM_INT);
    
            //ETAPE 10 Du Diagramme de Sequence : Execution de la requête
            $req->execute();
    
            ////ETAPE 12 Du Diagramme de Sequence : Renvoyer un message de confirmation
            return ['Mise à jour effectuée avec succès.',true];
    
        }catch(Exception $error){
            //ETAPE 11 et 12 Du Diagramme de Sequence : Reçoit et Retourne le message d'erreur
            return [$error->getMessage(),false];
        }
    }
}

?>