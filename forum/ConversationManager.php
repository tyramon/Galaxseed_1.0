<?php


class ConversationManager extends PDOManager
{
    protected $pdo;
    protected $donnees;

    public function __construct()
    {
        $this->pdo=parent::getInstance()->getPDO();
        $this->donnees= array();
    }


    public function getListConversation() :array
    {
        $requete = $this->pdo->query('SELECT c_id, DATE_FORMAT(c_date,"%Y/%m/%d") AS c_date, DATE_FORMAT(c_date, "%T") AS c_heure, c_termine, COUNT(m_id) AS nbMessage 
                                                  FROM conversation 
                                                  LEFT JOIN message 
                                                  ON conversation.c_id = message.m_conversation_fk 
                                              GROUP BY c_id');

        $donnees = $requete ->fetchAll(PDO::FETCH_ASSOC);

        return $donnees;
    }

    public function conversationIdExist( int $id) : string
    {   $verif='bad';
        $requete = $this->pdo->query('SELECT c_id FROM conversation');
        $donnees=$requete->fetchAll(PDO::FETCH_ASSOC);

        foreach ($donnees as $key=>$val)
        {
            if ((int)$val['c_id'] === $id)
            {
                $verif='ok';
            }
        }
        return $verif;
    }



    public function erreur404()
    {
        header('Location: HTTP/1.0 404 Not Found');
        exit();
    }

}