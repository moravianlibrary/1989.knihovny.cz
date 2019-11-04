<?php
declare(strict_types=1);

namespace App\Model;

use Nette\Database\Connection;
use func;

class People {
    protected $db;

    function __construct(Connection $connection, Files $files) {
        /**
         * @var $db \Nette\Database\Connection
         */
        $this->db = $connection;
    }

    function add_person(array $prop) {
        if(empty($prop) || !empty(array_diff(array_keys($prop), ['img', 'name', 'born', 'dead', 'job', 'desc', 'wrote', 'theywrote']))) {
            return;
        }
        $this->db->query('INSERT INTO person', $prop);
    }

    function get_person_by_ID(array $ids){
        if(empty($ids)){
            return;
        }
        $res = $this->db->query('SELECT `name`, `born`, `dead`, `job`, `desc`, `wrote`, `theywrote`, b.path as `img` FROM `person` a JOIN upload b ON b.ID=a.img WHERE',[
            'a.ID' => $ids
        ]);
        return $res->fetchAll();
    }

    function get_rand_people_from_group($group, $limit = 8){
        $res = $this->db->query('SELECT `name`, `born`, `dead`, `job`, `desc`, `wrote`, `theywrote`, b.path as `img` FROM `person` a JOIN upload b ON b.ID=a.img WHERE', [
            'a.cat' => $group
        ], 'ORDER BY a.`order` LIMIT ?', $limit);
        foreach($res = $res->fetchAll() as &$item){
            $item['wrote'] = func::link_to_knihovnycz($item['wrote']);
            $item['theywrote'] = func::link_to_knihovnycz($item['theywrote']);
        }
        return $res;
    }
}