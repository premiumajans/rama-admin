<?php

namespace Database\Seeders;

use App\Models\AltCategory;
use App\Models\AltCategoryTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\SubCategory;
use App\Models\SubCategoryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'education' => [
                'translations' => ['az' => 'Təhsil', 'en' => 'Education', 'ru' => 'Образование'],
                'categories' =>
                    [
                        'master' => [
                            'translations' => ['az' => 'Maqistr', 'en' => 'Master degree', 'ru' => 'Степень магистра'],
                            'alt-categories' => [
                                'legal-normative-documents' => ['az' => 'HÜQUQI NORMATIV SƏNƏDLƏR', 'en' => 'LEGAL NORMATIVE DOCUMENTS', 'ru' => 'НОРМАТИВНО-ПРАВОВЫЕ ДОКУМЕНТЫ'],
                                'specialization-keys' => ['az' => 'İXTISAS ŞIFRLƏRI', 'en' => 'SPECIALIZATION Keys', 'ru' => 'ПАРОЛИ СПЕЦИАЛИЗАЦИИ'],
                                'about-mba' => ['az' => 'MBA HAQQINDA', 'en' => 'ABOUT MBA', 'ru' => 'О МВА'],
                                'gead-master-handbook' => ['az' => 'GEAD MAGISTR KITABÇASI', 'en' => 'GEAD MASTER HANDBOOK', 'ru' => 'РУКОВОДСТВО ПО GEAD MASTER'],
                            ]
                        ],
                        'doctorate' => [
                            'translations' => ['az' => 'Doktorantura', 'en' => 'Doctorate', 'ru' => 'Докторантура'],
                            'alt-categories' => [
                                'legal-normative-documents' => ['az' => 'HÜQUQI NORMATIV SƏNƏDLƏR', 'en' => 'LEGAL NORMATIVE DOCUMENTS', 'ru' => 'НОРМАТИВНО-ПРАВОВЫЕ ДОКУМЕНТЫ'],
                                'specialization-keys' => ['az' => 'İXTISAS ŞIFRLƏRI', 'en' => 'SPECIALIZATION Keys', 'ru' => 'ПАРОЛИ СПЕЦИАЛИЗАЦИИ'],
                            ]
                        ],
                        'residency' => [
                            'translations' => ['az' => 'Rezidentura', 'en' => 'Residency', 'ru' => 'Резиденция'],
                            'alt-categories' => [
                                'legal-normative-documents' => ['az' => 'HÜQUQI NORMATIV SƏNƏDLƏR', 'en' => 'LEGAL NORMATIVE DOCUMENTS', 'ru' => 'НОРМАТИВНО-ПРАВОВЫЕ ДОКУМЕНТЫ'],
                                'specialization-keys' => ['az' => 'İXTISAS ŞIFRLƏRI', 'en' => 'SPECIALIZATION Keys', 'ru' => 'ПАРОЛИ СПЕЦИАЛИЗАЦИИ'],
                            ]
                        ],
                    ],
            ],
            'education-abroad' => [
                'translations' => ['az' => 'Xaricdə təhsil', 'en' => 'Education abroad', 'ru' => 'Учеба за границей'],
                'categories' =>
                    [
                        'master' => ['translations' => ['az' => 'Maqistr', 'en' => 'Master degree', 'ru' => 'Степень магистра']],
                        'doctorate' => ['translations' => ['az' => 'Doktorantura', 'en' => 'Doctorate', 'ru' => 'Докторантура']],
                        'residency' => ['translations' => ['az' => 'Rezidentura', 'en' => 'Residency', 'ru' => 'Резиденция']],
                    ],
            ],
            'scientific-activity' => [
                'translations' => ['az' => 'Elmi fəaliyyət', 'en' => 'Scientific activity', 'ru' => 'Научная деятельность'],
                'categories' =>
                    [
                        'scientific-research-methods' => ['translations' => ['az' => 'Elmi tədqiqat üsulları', 'en' => 'Scientific research methods', 'ru' => 'Методы научных исследований']],
                        'dissertation-drafting-rules' => ['translations' => ['az' => 'Disertasiyanın tərtibi qaydaları', 'en' => 'Dissertation drafting rules', 'ru' => 'Правила оформления диссертации']],
                        'dissertation-boards' => ['translations' => ['az' => 'Dissertasiya şuraları', 'en' => 'Dissertation boards', 'ru' => 'Диссертационные советы']],
                        'scientific-names' => ['translations' => ['az' => 'Elmi adlar', 'en' => 'Scientific names', 'ru' => 'Научные названия']],
                    ],
            ],
            'scientific-publications' => [
                'translations' => ['az' => 'Elmi nəşrlər', 'en' => 'Scientific publications', 'ru' => 'Научные публикации'],
                'categories' =>
                    [
                        'internotional-young-researches-journal' =>
                            [
                                'translations' => ['az' => 'Beynəlxalq Gənc Tədqiqatçılar Jurnalı', 'en' => 'İnternotional Young Researches Journal', 'ru' => 'Международный журнал молодых исследователей'],
                                'alt-categories' => ['legal-normative-documents' => ['az' => 'Beynəlxalq Gənc Tədqiqatçılar Jurnalı 1', 'en' => 'İnternotional Young Researches Journal 1', 'ru' => 'Международный журнал молодых исследователей 1']],
                            ],
//                    ],
                        'memory-book-of-doctoral-students' => ['translations' => ['az' => 'Doktorantların yaddaş kitabçası', 'en' => 'Memory book of doctoral students', 'ru' => 'Докторантларин яддаш китабчасы']],
                        'victory-day-collection' => ['translations' => ['az' => 'Zəfər gününə həsr olunmuş gənc tədqiqatçıların elmi məqalələr toplusu', 'en' => 'A collection of scientific articles by young researchers dedicated to Victory Day', 'ru' => 'Сборник научных статей молодых исследователей, посвященный Дню Победы']],
                        'victory-day-collection-2' => ['translations' => ['az' => 'Zəfər gününə həsr olunmuş gənc tədqiqatçıların elmi məqalələr toplusu 2', 'en' => 'A collection of scientific articles by young researchers dedicated to Victory Day 2', 'ru' => 'Сборник научных статей молодых исследователей, посвященный Дню Победы 2']],
                        'akk-recommended-publications' => ['translations' => ['az' => 'AKK-ın tövsiyyə etdiyi nəşrlər', 'en' => 'AKK recommended publications', 'ru' => 'АКК рекомендуемые публикации']],
                        'scientific-publications-of-our-members' => ['translations' => ['az' => 'Üzvlərimizin elmi nəşrləri', 'en' => 'Scientific publications of our members', 'ru' => 'Научные публикации наших участников']],
                        'gead-scientific-compendium' => ['translations' => ['az' => 'GEAD elmi məcmusu', 'en' => 'GEAD scientific compendium', 'ru' => 'Научный сборник GEAD']],
                        'international-indexed-journals' => [
                            'translations' => ['az' => 'Beynəlxalq indeksli jurnallar'], ['en' => 'International indexed journals'], ['ru' => 'Международные индексируемые журналы'],
                            'alt-categories' => [
                                'exact-sciences' => ['az' => 'Dəqiq elmlər', 'en' => 'Exact sciences', 'ru' => 'Точные науки'],
                                'social-sciences' => ['az' => 'Sosial elmlər', 'en' => 'Social sciences', 'ru' => 'Социальные науки'],
                                'humanities' => ['az' => 'Humanitar elmlər', 'en' => 'Humanities', 'ru' => 'Гуманитарные науки'],
                            ]
                        ],
                        'links-to-foreign-scientific-journals' => ['translations' => ['az' => 'Xarici elmi jurnalların linkləri', 'en' => 'Links to foreign scientific journals', 'ru' => 'Ссылки на зарубежные научные журналы']],
                    ],
            ],
            'library' => [
                'translations' => ['az' => 'Kitabxana', 'en' => 'Library', 'ru' => 'Библиотека'],
                'categories' =>
                    [
                        'new-books' => ['translations' => ['az' => 'Yeni kitablar', 'en' => 'New books', 'ru' => 'Новые книги']],
                        'library-of-gead-pu' => ['translations' => ['az' => 'GEAD İB-nin kitabxanası', 'en' => 'Library of GEAD PU', 'ru' => 'Библиотека GEAD PU']],
                        'links-to-libraries' => ['translations' => ['az' => 'Kitabxanalara linklər', 'en' => 'Links to libraries', 'ru' => 'Ссылки на библиотеки']],
                        'international-libraries' => ['translations' => ['az' => 'Beynəlxalq kitabxanalar', 'en' => 'International libraries', 'ru' => 'Международные библиотеки']],
                    ],
            ],
            'projects' => [
                'translations' => ['az' => 'Layihələr', 'en' => 'Projects', 'ru' => 'Проекты'],
                'categories' =>
                    [
                        'new-books' => ['translations' => ['az' => 'İcra olunmuş layihələr', 'en' => 'Completed projects', 'ru' => 'Завершенные проекты']],
                        'ongoing-projects' => ['translations' => ['az' => 'Davam edən layihələr', 'en' => 'Ongoing projects', 'ru' => 'Текущие проекты']],
                        'grant-competition' => ['translations' => ['az' => 'Qrant müsabiqəsi', 'en' => 'Grant competition', 'ru' => 'Грантовый конкурс']],
                        'rules-for-writing-projects' => ['translations' => ['az' => 'Layihələrin yazılma qaydaları', 'en' => 'Rules for writing projects', 'ru' => 'Правила написания проектов']],
                    ],
            ],
            'news' => [
                'translations' => ['az' => 'Xəbərlər', 'en' => 'News', 'ru' => 'Новости'],
                'categories' =>
                    [
                        'new-books' => ['translations' => ['az' => 'Elmi yeniliklər', 'en' => 'Completed projects', 'ru' => 'Завершенные проекты']],
                        'local-news' => ['translations' => ['az' => 'Yerli xəbərlər', 'en' => 'Local news', 'ru' => 'Местные новости']],
                        'foreign-news' => ['translations' => ['az' => 'Xarici xəbərlər', 'en' => 'Foreign news', 'ru' => 'Зарубежные новости']],

                    ],
            ],
            'advertisements' => [
                'translations' => ['az' => 'Elanlar', 'en' => 'Advertisements', 'ru' => 'Объявления'],
                'categories' =>
                    [
                        'education' => ['translations' => ['az' => 'Təhsil', 'en' => 'Education', 'ru' => 'Образование']],
                        'seminars' => ['translations' => ['az' => 'Seminarlar', 'en' => 'Seminars', 'ru' => 'Семинары']],
                        'conferences-and-symposia' => ['translations' => ['az' => 'Konferans və Simpoziumlar', 'en' => 'Conferences and Symposia', 'ru' => 'Конференции и симпозиумы']],
                        'competitions' => ['translations' => ['az' => 'Müsabiqələr', 'en' => 'Competitions', 'ru' => 'Соревнования']],
                        'vacancies' => ['translations' => ['az' => 'Vakansiyalar', 'en' => 'Vacancies', 'ru' => 'Вакансии']],
                    ],
            ],
            'sections' => [
                'translations' => ['az' => 'Bölmələr', 'en' => 'Sections', 'ru' => 'Разделы'],
                'categories' =>
                    [
                        'activities' => ['translations' => ['az' => 'Fəaliyyətlərimiz', 'en' => 'Activities', 'ru' => 'Наша деятельность']],
                        'interviews' => ['translations' => ['az' => 'Müsahibələr', 'en' => 'Interviews', 'ru' => 'Интервью']],
                        'seminars' => ['translations' => ['az' => 'Seminarlarımız', 'en' => 'Seminars', 'ru' => 'Cеминары']],
                    ],
            ],
        ];
        foreach ($categories as $key => $category) {
            $cat = new Category();
            $cat->slug = $key;
            $cat->status = 1;
            $cat->save();
            foreach ($category['translations'] as $catTranslationKey => $translation1) {
                $trans1 = new CategoryTranslation();
                $trans1->locale = $catTranslationKey;
                $trans1->category_id = $cat->id;
                $trans1->name = $translation1;
                $trans1->save();
            }
            foreach ($category['categories'] as $catKey => $category1) {
                $altCatOriginal = new AltCategory();
                $altCatOriginal->slug = $catKey;
                $cat->alt()->save($altCatOriginal);
                foreach ($category1['translations'] as $langAlt2 => $altLang2) {
                    $trans2 = new AltCategoryTranslation();
                    $trans2->locale = $langAlt2;
                    $trans2->alt_category_id = $altCatOriginal->id;
                    $trans2->name = $altLang2;
                    $trans2->save();
                }
                if (array_key_exists('alt-categories', $category1)) {
                    foreach ($category1['alt-categories'] as $subCatKey => $subCat) {
                        $subCatOriginal = new SubCategory();
                        $subCatOriginal->slug = $subCatKey;
                        $altCatOriginal->sub()->save($subCatOriginal);
                        foreach ($subCat as $langSub2 => $subLang2) {
                            $trans3 = new SubCategoryTranslation();
                            $trans3->locale = $langSub2;
                            $trans3->sub_category_id = $subCatOriginal->id;
                            $trans3->name = $subLang2;
                            $trans3->save();
                        }
                    }
                }
            }
        }
    }
}
