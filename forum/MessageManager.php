<?php
declare(strict_types=1);

class MessageManager extends PDOManager
{
    protected $pdo;
    protected $donnees;

    public function __construct()
    {
        $this->pdo = parent::getInstance()->getPDO();
        $this->donnees = array();
    }


    public function getNbMessageByConvID( int $id) : int
    {
        $requete = $this->pdo->prepare('SELECT COUNT(m_id) AS total
                                                    FROM message
                                                  WHERE m_conversation_fk=:id
                                                    ORDER BY m_date DESC');
        $requete->bindValue('id', $id);
        $requete->execute();
        $donnees = $requete ->fetchAll(PDO::FETCH_ASSOC);
        $total= (int)$donnees[0]['total'];

        return $total;
    }

    public function getnombrePagePagination( int $total, int $messageParPage) : int
    {
        $nbPage=($total/$messageParPage);
        $nbPage=(int)ceil($nbPage);

        return $nbPage;
    }

    public function getListLimitMessage(int $id, int $limit, int $offset, string $tri) : array
    {
        if ($tri === 'date')
        {
            $tri='m_date';
        }
        elseif($tri === 'id')
        {
            $tri='m_auteur_fk';
        }
        elseif ($tri === 'auteur')
        {
            $tri = 'u_nom';
        }

        $requete=$this->pdo->prepare('SELECT DATE_FORMAT(m_date,"%Y/%m/%d") AS m_date, DATE_FORMAT(m_date, "%T") AS m_heure, u_prenom, u_nom, m_contenu
                                                    FROM message
                                                      INNER JOIN user
                                                      ON  message.m_auteur_fk = user.u_id
                                                  WHERE m_conversation_fk=:id
                                                      ORDER BY '.$tri.' DESC
                                                      LIMIT :limit OFFSET :offset');
        $requete->bindValue('id', $id);
        $requete->bindValue('limit', $limit, PDO::PARAM_INT);
        $requete->bindValue('offset', $offset,PDO::PARAM_INT);
        $requete->execute();
        $donnees=$requete->fetchAll(PDO::FETCH_ASSOC);

        return $donnees;
    }


    public function insertMessage( string $message, int $idUser, int $id) : void
    {
        $requete=$this->pdo->prepare('INSERT INTO message (m_contenu, m_date, m_auteur_fk, m_conversation_fk) VALUES (:message, CURRENT_TIMESTAMP, :idUser , :idConv)');
        $requete->bindValue('message', $message);
        $requete->bindValue('idUser', $idUser);
        $requete->bindValue('idConv', $id);
        $requete->execute();
    }
}