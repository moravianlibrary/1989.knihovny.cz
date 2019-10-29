<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Carousel;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter {
    protected $data;

    function __construct() {
        $data = 42;
    }

    function renderDefault() {

        $this->template->carousel = (new Carousel([
            'class' => 'slide carousel-fade col-lg-6',
            'id' => 'carouselExampleControls'
        ]))->add_slide([
            'class' => 'active',
            'img' => [ 'src' => '/files/img/foto/SVKvDobeStavky/a0004.jpg', 'alt' => 'Fourth slide' ]
        ])->add_slide([
            'img' => [ 'src' => '/files/img/foto/SVKvDobeStavky/a0005.jpg', 'alt' => 'Fifth slide' ]
        ])->add_slide([
            'img' => [ 'src' => '/files/img/foto/SVKvDobeStavky/a0001.jpg', 'alt' => 'First slide' ]
        ])->add_slide([
            'img' => [ 'src' => '/files/img/foto/SVKvDobeStavky/a0002.jpg', 'alt' => 'Second slide' ]
        ])->add_slide([
            'img' => [ 'src' => '/files/img/foto/SVKvDobeStavky/a0003.jpg', 'alt' => 'Third slide' ]
        ])->add_slide([
            'img' => [ 'src' => '/files/img/foto/SVKvDobeStavky/a0006.jpg', 'alt' => 'Third slide' ]
        ])->add_slide([
            'img' => [ 'src' => '/files/img/foto/SVKvDobeStavky/a0007.jpg', 'alt' => 'Third slide' ]
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
                'img' => '/files/img/osoby/vhavel.jpeg',
                'name' => 'Václav Havel',
                'job' => 'Spisovatel a dramaturg, dramatik, prezident',
                'years' => '1936-2011',
                'desc' => 'Narozen 5. 10. 1936 v Praze, zemřel 18. 12. 2011 v Hrádečku u Vlčic. Spisovatel a dramaturg, dramatik, publicista v literárních a divadelních časopisech, esejista, politik, v letech 1989-1992 prezident Československa, v letech 1993-2003 prezident České republiky.',
                'authorof' => 'https://www.knihovny.cz/Search/Results/?bool0[]=AND&type0[]=adv_search_author_corporation&lookfor0[]=Václav+havel&join=AND&searchTypeTemplate=advanced&database=Solr&limit=20&sort=relevance&page=1',
                'about' => 'https://www.knihovny.cz/Search/Results/?bool0[]=AND&type0[]=adv_search_title_series&lookfor0[]=Václav+havel&join=AND&searchTypeTemplate=advanced&database=Solr&limit=20&sort=relevance&page=1'
            ], [
                'img' => '/files/img/osoby/jruml.jpeg',
                'name' => 'Jan Ruml',
                'job' => 'Novinář a politik',
                'years' => '1953-',
                'desc' => ''
            ], [
                'img' => '/files/img/osoby/jdienstbier.jpeg',
                'name' => 'Jiří Dienstbier',
                'job' => 'Novinář a publicista, politik',
                'years' => '1937-2011',
                'desc' => 'Narozen 20. 4. 1937 v Kladně, zemřel 8. 1. 2011 v Praze. Novinář a publicista, politik.'
            ], [
                'img' => '/files/img/osoby/spanek.jpeg',
                'name' => 'Šimon Pánek',
                'job' => 'Politický aktivista a humanitární manažer',
                'years' => '1967-',
                'desc' => 'Narozen 27. 12. 1967 v Praze. Nadační pracovník, jeden ze studentských vůdců roku 1989. Spoluautor řady dokumentů o krizových oblastech světa a o české historii.'
            ], [
                'img' => '/files/img/osoby/mmejstrik.jpeg',
                'name' => 'Martin Mejstřík',
                'job' => 'Loutkoherec a nezávislý publicista',
                'years' => '1962-',
                'desc' => 'Narozen 30.5.1962 v Kolíně. Loutkoherec a nezávislý publicista, redaktor revue kavárna, pulbicistické práce.'
            ], [
                'img' => '/files/img/osoby/jdienstbier.jpeg',
                'name' => 'Jiří Dienstbier',
                'job' => 'Novinář a publicista, politik',
                'years' => '1937-2011',
                'desc' => 'Narozen 20. 4. 1937 v Kladně, zemřel 8. 1. 2011 v Praze. Novinář a publicista, politik.'
            ], [
                'img' => '/files/img/osoby/jdienstbier.jpeg',
                'name' => 'Jiří Dienstbier',
                'job' => 'Novinář a publicista, politik',
                'years' => '1937-2011',
                'desc' => 'Narozen 20. 4. 1937 v Kladně, zemřel 8. 1. 2011 v Praze. Novinář a publicista, politik.'
            ]
        ];
        $this->template->people = $people;

        $this->template->notgood_ppl = [
            [
                'img' => '/files/img/osoby/ghusak.jpeg',
                'name' => 'Gustáv Husák',
                'job' => 'Právník, politik a státník, československý prezident',
                'years' => '1913-1991',
                'desc' => 'Narozen 10.1.1913 v Bratislavě, zemřel 18.11.1991 tamtéž. Právník, politik a státník, československý prezident, politické práce.'
            ], [
                'img' => '/files/img/osoby/mjakes.jpeg',
                'name' => 'Miloš Jakeš',
                'job' => 'Elektromechanik, člen KSČ',
                'years' => '1922-',
                'desc' => 'Narozen 12.8.1922 v Českých Chalupách u Českého Krumlova. Elektromechanik, RSDr., komunistický politik.'
            ]
        ];

        $this->template->links = [
            'https://www.knihovny.cz/Record/auth.AUT10-000038323' => 'Pavel Tigrid',
            'https://www.knihovny.cz/Record/auth.AUT10-000080482' => 'Anna Šabatová',
            'https://www.knihovny.cz/Record/auth.AUT10-000043794' => 'Michael Žantovský',
            'https://www.knihovny.cz/Record/auth.AUT10-000047615' => 'Olga Havlová',
            'https://www.knihovny.cz/Record/auth.AUT10-000004550' => 'Jiří Černý'
        ];
    }
}
