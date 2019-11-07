<?php
declare(strict_types=1);

namespace App\Model;

use Nette\Database\Connection;

class Files {
    protected $db, $table;

    function __construct(Connection $connection) {
        /**
         * @var $db \Nette\Database\Connection
         */
        $this->db = $connection;
    }

    function scan_tree(string $path) {
        $files = [];
        for($dir = opendir($path); $entry = readdir($dir);) {
            if(!in_array($entry, [ '.', '..' ]) && is_dir($path . '/' . $entry)) {
                $files = array_merge($files, $this->scan_tree($path .'/'. $entry));
            } elseif(is_file($path . '/' . $entry)) {
                $files[] = $path . '/' . $entry;
            }
        }
        closedir($dir);
        return $files;
    }

    function add_file(string $path, array $param = []) {
        //list of allowed keys in []
        if(empty($path) || !file_exists($path) || count(array_diff(array_keys($param), [ 'path', 'date_added', 'title', 'mime_type' ])) > 0) {
            return;
        }
        $data = [
            'path' => $path,
            'title' => $param['title'] ?? strrev(explode('/', strrev($path))[0]),
            'date_added' => (new \DateTime())->format('Y-m-d H:m:s'),
            'mime_type' => mime_content_type($path)
        ];
        $this->db->query('INSERT INTO `upload` ?', $data);
    }

    function get_files_by_ID($id) {
        if(!is_numeric($id) && !is_array($id)) {
            return;
        }
        $res = $this->db->query('SELECT * FROM `upload` WHERE ?', [
            'ID' => $id
        ]);
        return $res->fetchAll();
    }

    function get_files_by_dir(string $dirName){
        $res = $this->db->query('SELECT * FROM `upload` WHERE `path` LIKE ?', "$dirName%", 'ORDER BY `order`, `path`');
        return $res->fetchAll();
    }
}