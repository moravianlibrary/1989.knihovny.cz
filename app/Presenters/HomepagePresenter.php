<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Carousel;
use Nette;
use Nette\ComponentModel\IComponent;


final class HomepagePresenter extends Nette\Application\UI\Presenter {

    function renderDefault() {

        $this->template->carousel = (new Carousel([
            'class' => 'slide carousel-fade col-lg-6',
            'id' => 'carouselExampleControls'
        ]))->add_slide([
            'class' => 'active',
            'img' => [ 'src' => '/files/img/foto/a0004.png', 'alt' => 'Fourth slide' ]
        ])->add_slide([
            'img' => [ 'src' => '/files/img/foto/a0005.png', 'alt' => 'Fifth slide' ]
        ])->add_slide([
            'img' => [ 'src' => '/files/img/foto/a0001.png', 'alt' => 'First slide' ]
        ])->add_slide([
            'img' => [ 'src' => '/files/img/foto/a0002.png', 'alt' => 'Second slide' ]
        ])->add_slide([
            'img' => [ 'src' => '/files/img/foto/a0003.png', 'alt' => 'Third slide' ]
        ])->add_slide([
            'img' => [ 'src' => '/files/img/foto/a0006.png', 'alt' => 'Third slide' ]
        ])->add_slide([
            'img' => [ 'src' => '/files/img/foto/a0007.png', 'alt' => 'Third slide' ]
        ])->render();

        $books = [
            [
                'img' => 'https://cache.obalkyknih.cz/api/cover?multi=%7B%22isbn%22%3A%22809036389X%22%2C%22nbn%22%3A%22cnb001831818%22%7D&type=medium&keywords=advert%20record',
                'title' => 'Zvonění klíčů',
                'author' => 'Jiří Slavíček',
                'record' => 'mzk.MZK01-000922762'
            ],
            [
                'img' => 'https://cache.obalkyknih.cz/api/cover?multi=%7B%22isbn%22%3A%228087493206%22%2C%22nbn%22%3A%22cnb002389711%22%7D&type=medium&keywords=advert%20record',
                'title' => 'Téma: Alexander Dubček',
                'author' => 'Antonín Benčík',
                'record' => 'nkp.NKC01-002389711'
            ],
            [
                'img' => 'https://cache.obalkyknih.cz/api/cover?multi=%7B%22isbn%22%3A%228087090438%22%2C%22nbn%22%3A%22cnb002157762%22%7D&type=medium&keywords=advert%20record',
                'title' => 'Muž nad stolem, aneb, Byl jsem Štrougalovým poradcem',
                'author' => 'Jaromír Sedlák',
                'record' => 'svkpk.PNA01-000537283'
            ]
        ];

        $books = array_merge($books, $books);
        shuffle($books);
        $this->template->books = $books;

        $this->template->periodicals_home = '/files/img/obalky';
        $this->template->periodicals = [
            [
                'title' => 'Rudé právo',
                'year' => '11/1989',
                'dir' => 'Rude_pravo11',
                'cover' => 'UC_2e24be91-9d63-11e3-8e84-005056827e51_0001.jpg'
            ], [
                'title' => 'Rudé právo',
                'year' => '12/1989',
                'dir' => 'Rude_pravo12',
                'cover' => 'UC_1e662d00-985d-11e3-ad99-001018b5eb5c_0001.jpg'
            ], [
                'title' => 'Studentské listy',
                'year' => '1/1990',
                'dir' => 'Studentske_listy',
                'cover' => 'UC_1eeee350-530d-11e4-90c9-005056825209_0001.jpg'
            ], [
                'title' => 'Tribuna',
                'year' => '11-12/1990',
                'dir' => 'Tribuna',
                'cover' => 'uc_02a906c0-bd17-11e9-b601-005056825209_0001.jpg'
            ], [
                'title' => 'Mladý svět',
                'year' => '1989',
                'dir' => 'Mlady_svet',
                'cover' => 'UC_4eff0740-3054-11e4-8e0d-005056827e51_0001.jpg'
            ], [
                'title' => 'Duha',
                'year' => '1989/90',
                'dir' => 'Duha',
                'cover' => 'ABA000_0001028963198940002.jpg'
            ]
        ];


        $people = [
            [
                'img' => 'https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Ftse4.mm.bing.net%2Fth%3Fid%3DOIP.YfLelYg0Xm_V68xuDFCwsgAAAA%26pid%3DApi&f=1',
                'name' => 'Jan Novák',
                'job' => 'Iniciátor',
                'years' => '1942-1942',
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam auctor sem eget sollicitudin pellentesque. Fusce eget nibh tincidunt lacus pretium consequat a eu sapien.'
            ]
        ];

        $people = array_fill(0, 6, $people[0]);
        $this->template->people = $people;


        $this->template->links = [
            'https://www.knihovny.cz/Record/auth.AUT10-000038323' => 'Pavel Tigrid',
            'https://www.knihovny.cz/Record/auth.AUT10-000080482' => 'Anna Šabatová',
            'https://www.knihovny.cz/Record/auth.AUT10-000043794' => 'Michael Žantovský',
            'https://www.knihovny.cz/Record/auth.AUT10-000047615' => 'Olga Havlová',
            'https://www.knihovny.cz/Record/auth.AUT10-000004550' => 'Jiří Černý'
        ];
    }
}
