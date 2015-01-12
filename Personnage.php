<?php

/**
 * Created by PhpStorm.
 * User: pjufre
 * Date: 02/01/2015
 * Time: 15:58
 */
class Personnage
{
    private $id;
    private $nom;
    private $degats;

    const CEST_MOI = 1; //constante renvonyer par la methode frapper si on se frappe soi meme
    const PERSONNAGE_TUE = 2; //constante renvoyer par la methode frapper si on a tué le personnage en frappant
    const PERSONNAGE_FRAPPE = 3;//constante renvoyer par la methode frapper si on a bien frapper le personnage

    function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }


    public function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value){
            $method = 'set' . ucfirst($key);
            if(method_exists($this, $method))
                $this->$method($value);
        }
    }
    /**
     * @param \Personnage $perso
     * Avant tout vérifier qu'on ne se frappe pas soi-même
     * si c'est le cas on stoppe tout
     * en renvoyant une valeur signifiant que le personnage ciblé
     * est le personnage qui attaque
     * on indique au perssonage frappé qu'il doit recevoir des dégats
     */
    public function frapper(Personnage $perso)
    {
        if($perso->id == $this->id){
            return self::CEST_MOI;
        }
        //on indique au personnage qu'il doit recevoir des degats
        //puis on retourne la valeur renvoyer par la methode : self::PERSONNAGE_TUE ou PERSONNAGE_FRAPPE
        return $perso->recevoirDegats();
    }

    /**
     * on augmente de 5 les degats
     * si on a 100 de degat ou plus la methode renverra une valeur signifiant que le personnage a été tué
     * sinon elle renverra une valeur signifiant que le personnage a bien été frappé
     */
    public function recevoirDegats()
    {
        $this->degats +=5;
        if($this->degats >= 100){
            return self::PERSONNAGE_TUE;
        }
        else{
            return self::PERSONNAGE_FRAPPE;
        }

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getDegats()
    {
        return $this->degats;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $id = (int)$id;
        if ($id > 0) {
            $this->id = $id;
        }
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        if (is_string($nom)) {
            $this->nom = $nom;
        }
    }

    /**
     * @param mixed $degats
     */
    public function setDegats($degats)
    {
        $degats = (int)$degats;
        if ($degats >= 0 && $degats <= 100) {
            $this->degats = $degats;
        }
    }
}