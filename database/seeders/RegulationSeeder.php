<?php

namespace Database\Seeders;

use App\Models\Regulation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Regulation::create([
            'name' => 'მშენებლობის ნებართვის გაცემისა და შენობა-ნაგებობის ექსპლუატაციაში მიღების წესი',
            'description' => 'საქართველოს მთავრობის 2019 წლის 31 მაისის №255 დადგენილება მშენებლობის ნებართვის გაცემისა და შენობა-ნაგებობის ექსპლუატაციაში მიღების წესისა და პირობების შესახებ',
            'link' => 'https://matsne.gov.ge/ka/document/view/4578072?publication=0',
            'date_applied' => new \DateTime('2019-05-31'),
        ]);

        Regulation::create([
            'name' => 'ტერიტორიების გამოყენების და განაშენიანების რეგულირების ძირითადი დებულებები',
            'description' => 'საქართველოს მთავრობის 2019 წლის 3 ივნისის №261 დადგენილება ტერიტორიების გამოყენების და განაშენიანების რეგულირების ძირითადი დებულებების შესახებ',
            'link' => 'https://matsne.gov.ge/ka/document/view/4579383?publication=0',
            'date_applied' => new \DateTime('2019-06-03'),
        ]);

        Regulation::create([
            'name' => 'კანონი არქიტექტურული საქმიანობის შესახებ',
            'description' => 'საქართველოს კანონი, რომელიც არეგულირებს არქიტექტურულ საქმიანობას',
            'link' => 'https://faolex.fao.org/docs/pdf/geo200047GEO.pdf',
            'date_applied' => null,
        ]);

        Regulation::create([
            'name' => 'საქართველოს სივრცის დაგეგმარების, არქიტექტურული და სამშენებლო საქმიანობის კოდექსი',
            'description' => 'კოდექსი, რომელიც არეგულირებს სივრცის დაგეგმარების, არქიტექტურული და სამშენებლო საქმიანობის სფეროებს',
            'link' => 'https://matsne.gov.ge/ka/document/download/4276845/16/ge/pdf',
            'date_applied' => null,
        ]);

        Regulation::create([
            'name' => 'ტექნიკური რეგლამენტი - შენობა-ნაგებობის უსაფრთხოების წესები',
            'description' => 'საქართველოს მთავრობის 2016 წლის 28 იანვრის №41 დადგენილება ტექნიკური რეგლამენტის შენობა-ნაგებობის უსაფრთხოების წესების დამტკიცების თაობაზე',
            'link' => 'https://www.matsne.gov.ge/ka/document/view/3176389?publication=0',
            'date_applied' => new \DateTime('2016-01-28'),
        ]);

        Regulation::create([
            'name' => 'მისაწვდომობის ეროვნული სტანდარტები',
            'description' => 'საქართველოს მთავრობის 2020 წლის 4 დეკემბრის №732 დადგენილება ტექნიკური რეგლამენტის – მისაწვდომობის ეროვნული სტანდარტების დამტკიცების თაობაზე',
            'link' => 'https://www.rtc.edu.ge/files/%E1%83%A1%E1%83%90%E1%83%A5%E1%83%90%E1%83%A0%E1%83%97%E1%83%95%E1%83%94%E1%83%9A%E1%83%9D%E1%83%A1%20%E1%83%9B%E1%83%97%E1%83%90%E1%83%95%E1%83%A0%E1%83%9D%E1%83%91%E1%83%98%E1%83%A1%20732-%E1%83%94%20%E1%83%93%E1%83%90%E1%83%93%E1%83%92%E1%83%94%E1%83%9C%E1%83%98%E1%83%9A%E1%83%94%E1%83%91%E1%83%90.pdf',
            'date_applied' => new \DateTime('2020-12-04'),
        ]);
    }
}
