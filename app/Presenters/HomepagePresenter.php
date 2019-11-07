<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Carousel;
use App\Model\Files;
use App\Model\People;
use App\Model\Book;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter {
    protected $files, $people, $book;

    /**
     * @var \Nette\Database\Context
     */
    protected $database;

    public function injectDatabase(Nette\Database\Context $database){
        $this->database = $database;
    }

    function __construct(Files $files, People $ppl, Book $book) {
        parent::__construct();

        $this->files = $files;
        $this->people = $ppl;
        $this->book = $book;
    }

    function renderDefault() {

        $carousel = new Carousel([
            'class' => 'slide carousel-fade col-lg-6',
            'id' => 'carouselExampleControls'
        ]);

        $this->template->videos = [
            [ 'https://www.youtube.com/embed/wpA2jYCl4EA',
                'Vzpomínky Mileny Štěpánkové',
                'Popisek osoby',
                'Milena Štěpánková je dlouholetá pracovnice Moravské zemské knihovny a jedna z pamětnic dění v knihovně v období sametové revoluce. „V knihovně se to odstartovalo seznámením s peticí Několik vět. S tou jsme chtěli seznámit co nejširší veřejnost, důvěryhodné známé,“ vzpomíná na první náznaky blížící se změny režimu.'],
            [ 'https://www.youtube.com/embed/lTbW-vdz8Ag',
                'Vzpomínky Jaromíra Kubíčka',
                'Krátky popisek',
                'Jaromír Kubíček je celoživotní knihovník, který v době sametové revoluce působil jako ředitel Moravské zemské knihovny a dodnes s knihovnou spolupracuje. „Já byl divákem. V knihovně se všechno hýbalo, lidé se scházeli na schůzích. Bylo to bouřlivé. Já byl spíš pozorovatel toho, co se děje, než abych do něčeho zasahoval,“ popisuje překotné dění roku 1989.'],
            [ 'https://www.youtube.com/embed/74eRzJ9wAQg',
                'Vzpomínky Věry Jelínkové',
                'Popis osoby',
                'Věra Jelínková působila v roce 1989 jako ředitelka jedné z částí dnešní Moravské zemské knihovny, a sice Státní vědecké knihovny. Patří mezi pamětníky režimů, které se lámaly právě při sametové revoluci. "Ve většině případů to byla beletrie autorů, kteří buď emigrovali nebo byli obsahově nežádoucí," říká o zakázané literatuře, kterou knihovna archivovala od roku 1973.']
        ];

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

        $this->template->books = $this->book->get_books('REVOLUCE');

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

        foreach($periodicals as &$paper) {
            $items = [];
            foreach($paper['items'] as $item) {
                $items[] = [
                    'href' => $item['path'],
                    'title' => $item['title']
                ];
            }
            $paper['path'] = $this->files->get_files_by_dir($paper['cover'])[0]['path'] ?? null;
            //encode other image data with JSON
            $paper['items'] = json_encode($items);
        }

        $this->template->periodicals = $periodicals;

        $this->template->photo = $this->files->get_files_by_dir('/files/img/foto');

        $this->template->people = $this->people->get_rand_people_from_group('GOOD', 8);

        $this->template->notgood_ppl = $this->people->get_rand_people_from_group('BAD', 8);

        $this->template->links = [
            'https://www.knihovny.cz/Record/auth.AUT10-000038323' => 'Pavel Tigrid',
            'https://www.knihovny.cz/Record/auth.AUT10-000080482' => 'Anna Šabatová',
            'https://www.knihovny.cz/Record/auth.AUT10-000043794' => 'Michael Žantovský',
            'https://www.knihovny.cz/Record/auth.AUT10-000047615' => 'Olga Havlová',
            'https://www.knihovny.cz/Record/auth.AUT10-000004550' => 'Jiří Černý'
        ];

        $sources = $this->database->table('sources')
            ->fetchAll();
        $this->template->sources = $sources;

        foreach ($this->files->scan_tree('files/img/osoby') as $item){
            //add all files from dir
            //$this->files->add_file($item);
        }

    }
}
