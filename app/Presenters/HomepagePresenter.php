<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Carousel;
use App\Model\Files;
use App\Model\People;
use Latte\Engine;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter {
    protected $files, $people;

    function __construct(Files $files, People $ppl) {
        $this->files = $files;
        $this->people = $ppl;
    }

    function renderDefault() {

        $carousel = new Carousel([
            'class' => 'slide carousel-fade col-lg-6',
            'id' => 'carouselExampleControls'
        ]);

        $res = $this->files->get_files_by_ID([ 6, 9, 12, 15, 18 ]);
        if(is_array($res)) {
            for($i = 0; $i < count($res); $i++) {
                $img = $res[ $i ];
                $carousel->add_slide([
                    'class' => (0 == $i) ? [ 'active' ] : NULL,
                    'img' => [ 'src' => $img['path'], 'alt' => $img['title'] ]
                ]);
            }
        }

        $this->template->carousel = $carousel->render();

        $books = [
            [
                'img' => $this->files->get_files_by_ID(119)[0]['path'],
                'title' => 'Zvonění klíčů',
                'author' => 'Jiří Slavíček',
                'record' => 'mzk.MZK01-000922762'
            ],
            [
                'img' => $this->files->get_files_by_ID(120)[0]['path'],
                'title' => 'Téma: Alexander Dubček',
                'author' => 'Antonín Benčík',
                'record' => 'nkp.NKC01-002389711'
            ],
            [
                'img' => $this->files->get_files_by_ID(121)[0]['path'],
                'title' => 'Muž nad stolem, aneb, Byl jsem Štrougalovým poradcem',
                'author' => 'Jaromír Sedlák',
                'record' => 'svkpk.PNA01-000537283'
            ]
        ];

        $books = array_merge($books, $books);
        shuffle($books);
        $this->template->books = $books;

        $periodicals = [
            [
                'title' => 'Rudé právo XI.',
                'year' => '11/1989',
                'cover' => 'UC_2e24be91-9d63-11e3-8e84-005056827e51_0001.jpg',
                'items' => $this->files->get_files_by_dir('Rude_pravo11')
            ], [
                'title' => 'Rudé právo XII.',
                'year' => '12/1989',
                'cover' => 'UC_1e662d00-985d-11e3-ad99-001018b5eb5c_0001.jpg',
                'items' => $this->files->get_files_by_dir('Rude_pravo12')
            ], [
                'title' => 'Studentské listy',
                'year' => '1/1990',
                'cover' => 'UC_1eeee350-530d-11e4-90c9-005056825209_0001.jpg',
                'items' => $this->files->get_files_by_dir('Studentske_listy')
            ], [
                'title' => 'Tribuna',
                'year' => '11-12/1990',
                'cover' => 'uc_02a906c0-bd17-11e9-b601-005056825209_0001.jpg',
                'items' => $this->files->get_files_by_dir('Tribuna')
            ], [
                'title' => 'Mladý svět',
                'year' => '1989',
                'cover' => 'UC_4eff0740-3054-11e4-8e0d-005056827e51_0001.jpg',
                'items' => $this->files->get_files_by_dir('Mlady_svet')
            ], [
                'title' => 'Duha',
                'year' => '1989/90',
                'cover' => 'ABA000_0001028963198940002.jpg',
                'items' => $this->files->get_files_by_dir('Duha')
            ]
        ];

        foreach($periodicals as &$paper){
            $items = [];
            foreach($paper['items'] as $item){
                $items[] = [
                    'href' => $item['path'],
                    'title' => $item['title']
                ];
            }

            $paper['path'] = $this->files->get_files_by_dir($paper['cover'])[0]['path'];
            $paper['items'] = json_encode($items);
        }

        $this->template->periodicals = $periodicals;

        $this->template->people = $this->people->get_person_by_ID([1]);

        $this->template->notgood_ppl = $this->people->get_person_by_ID([1]);

        $this->template->links = [
            'https://www.knihovny.cz/Record/auth.AUT10-000038323' => 'Pavel Tigrid',
            'https://www.knihovny.cz/Record/auth.AUT10-000080482' => 'Anna Šabatová',
            'https://www.knihovny.cz/Record/auth.AUT10-000043794' => 'Michael Žantovský',
            'https://www.knihovny.cz/Record/auth.AUT10-000047615' => 'Olga Havlová',
            'https://www.knihovny.cz/Record/auth.AUT10-000004550' => 'Jiří Černý'
        ];
    }
}
