<?php
declare(strict_types=1);

namespace App\Model;

use Nette\Database\Connection;

class Book {

    protected $db, $table;

    function __construct(Connection $connection, \Nette\Database\Context $context) {
        /**
         * @var $db \Nette\Database\Connection
         */
        $this->db = $connection;
        $this->table = $context->table('books');
    }


    function get_books($cat, $limit = 5){
        $res = $this->db->query('SELECT a.`year`,a.`title`,a.`author`,a.`record`,b.`path` as img FROM `books` a JOIN `upload` b ON a.`cover`=b.`ID` WHERE `cat`=? LIMIT ?', $cat, $limit);
        return $res->fetchAll();
    }
}