<?php
/**
 * Created by PhpStorm.
 * User: pjufre
 * Date: 06/01/2015
 * Time: 16:00
 */

class PersonnagesManager
{
    private $db;//instance de PDO

    function __construct($db)
    {
        $this->db = $db;
    }


    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @param \Personnage $perso
     * presparation de la requete d'insertion
     * assignation des valeurs pour le nom du personnage
     * execution de la requete
     * hydratation du personnage passé en parametreavec assignation de son identifiant et de des degats initiaux = 0
     */
    public function add(Personnage $perso)
    {
        $q = $this->db->prepare('INSERT INTO personnages SET nom = :nom');
        $q->bindValue(':nom', $perso->getNom());
        $q->execute();

        $perso->hydrate(array(
            'id' => $this->db->lastInsertid(),
            'degats' => 0
        ));
    }

    /**
     * execute une requete COUNT() et retourne le nombre de resultat retourné
     */
    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM personnages')->fetchColumn;
    }

    /**
     * @param \Personnage $perso
     * execute une requte de type delete
     */
    public function delete(Personnage $perso)
    {
        $this->db->exec('DELETE FROM personnage WHERE id = ' . $perso->getId());
    }

    /**
     * si le paramètre est un entier c'est qu'on a fourni un identifiant
     * on exécute alor une requete COUNT() avec une clause WHERE et on retourne un boolean
     * sinon c'est qu'on a passé un nom exécution d'une requete COUNT() avec une clause WHERE et on retourne un boolean
     *
     */
    public function exists($info)
    {
        if(is_int($info)){

        }
    }

    /**
     * si le parametre est un entier on veut récupéré le personnage avec son identifiant
     * execute une requete de type SELECT avec unce clause WHERE et retourne un objet personnage
     */
    public function get($info)
    {

    }

    /**
     * retourne la liste de personnage don le nom n'est pas $nom
     * le resultat sera un tableau d'instance de Personnage
     */
    public function getList($nom)
    {

    }

    /**
     * @param \Personnage $perso
     * prepare une requete de type UPDATE
     * assignation des valeur à la requte
     * execution de la requete
     */
    public function update(Personnage $perso)
    {

    }
}