<?php

declare(strict_types = 1);

namespace App\Presenters;

use App\Model\Carousel;
use App\Model\Files;
use App\Model\People;
use App\Model\Book;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{

    protected $files;
    protected $people;
    protected $book;

    /**
     * @var \Nette\Database\Context
     */
    protected $database;

    public function __construct(Files $files, People $ppl, Book $book, Nette\Database\Context $database)
    {
        parent::__construct();

        $this->files = $files;
        $this->people = $ppl;
        $this->book = $book;
        $this->database = $database;
    }

    public function renderDefault()
    {

        $carousel = new Carousel([
            'class' => 'slide carousel-fade col-lg-6',
            'id' => 'carouselExampleControls'
        ]);

        $this->template->videos = [
            [
                'https://www.youtube.com/embed/wpA2jYCl4EA',
                'Vzpomínky Mileny Štěpánkové',
                'Popisek osoby',
                'Milena Štěpánková je dlouholetá pracovnice Moravské zemské knihovny a jedna z pamětnic dění v knihovně v období sametové revoluce. „V knihovně se to odstartovalo seznámením s peticí Několik vět. S tou jsme chtěli seznámit co nejširší veřejnost, důvěryhodné známé,“ vzpomíná na první náznaky blížící se změny režimu.'
            ],
            [
                'https://www.youtube.com/embed/lTbW-vdz8Ag',
                'Vzpomínky Jaromíra Kubíčka',
                'Krátky popisek',
                'Jaromír Kubíček je celoživotní knihovník, který v době sametové revoluce působil jako ředitel Moravské zemské knihovny a dodnes s knihovnou spolupracuje. „Já byl divákem. V knihovně se všechno hýbalo, lidé se scházeli na schůzích. Bylo to bouřlivé. Já byl spíš pozorovatel toho, co se děje, než abych do něčeho zasahoval,“ popisuje překotné dění roku 1989.'
            ],
            [
                'https://www.youtube.com/embed/74eRzJ9wAQg',
                'Vzpomínky Věry Jelínkové',
                'Popis osoby',
                'Věra Jelínková působila v roce 1989 jako ředitelka jedné z částí dnešní Moravské zemské knihovny, a sice Státní vědecké knihovny. Patří mezi pamětníky režimů, které se lámaly právě při sametové revoluci. "Ve většině případů to byla beletrie autorů, kteří buď emigrovali nebo byli obsahově nežádoucí," říká o zakázané literatuře, kterou knihovna archivovala od roku 1973.'
            ]
        ];

        $res = $this->files->get_files_by_ID([6, 9, 12, 15, 18]);
        if (is_array($res)) {
            for ($i = 0; $i < count($res); $i++) {
                $img = $res[$i];
                $carousel->add_slide([
                    'class' => (0 == $i) ? ['active'] : null,
                    'img' => ['src' => $img['path'], 'alt' => $img['title']]
                ]);
            }
        }

        $this->template->carousel = $carousel->render();

        $this->template->knihy = [
            'REVOLUCE' => $this->book->get_books('REVOLUCE', 5),
            'ZIVOTOPIS' => $this->book->get_books('OSOBY', 5)
        ];


        $periodicals = [
            [
                'title' => 'Rudé právo',
                'year' => '11/1989',
                'items' => $items = $this->files->get_files_by_dir('files/img/obalky/Rudepravo/'),
                'cover' => $items[0]
            ],
            [
                'title' => 'Studentské listy',
                'year' => '1/1990',
                'items' => $items = $this->files->get_files_by_dir('files/img/obalky/Studentske listy/'),
                'cover' => $items[0]
            ],
            [
                'title' => 'Tribuna',
                'year' => '11-12/1990',
                'items' => $items = $this->files->get_files_by_dir('files/img/obalky/Tribuna/'),
                'cover' => $items[0]
            ],
            [
                'title' => 'Mladý svět',
                'year' => '1989',
                'items' => $items = $this->files->get_files_by_dir('files/img/obalky/Mlady_svet/'),
                'cover' => $items[0]
            ],
            [
                'title' => 'Duha',
                'year' => '1989/90',
                'items' => $items = $this->files->get_files_by_dir('files/img/obalky/Duha/'),
                'cover' => $items[0]
            ]
        ];

        foreach ($periodicals as &$paper) {
            $items = [];
            foreach ($paper['items'] as $item) {
                $items[] = [
                    'href' => $item['path'],
                    'title' => $item['title']
                ];
            }
            $paper['path'] = $paper['cover']->path ?? null;
            //encode other image data with JSON
            $paper['items'] = json_encode($items);
        }

        $this->template->periodicals = $periodicals;

        $this->template->photo = $this->files->get_files_by_dir('/files/img/foto');

        $this->template->people = $this->people->get_rand_people_from_group('GOOD', 99);

        $this->template->notgood_ppl = $this->people->get_rand_people_from_group('BAD', 99);

        $sources = $this->database->table('sources')
            ->fetchAll();
        $this->template->sources = $sources;

    }

    public function beforeRender()
    {
        parent::beforeRender();

        $this->template->utmCode = 'utm_source=1989-knihovny-cz&utm_medium=portal&utm_campaign=listopad89';
    }

}
