<?php

use Illuminate\Database\Seeder;
use App\ReadingBook;
class bookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('readingBooks')->delete();
        $books = [
            ['title' => 'De Rattenvanger', 'numberOfPages' => 42, 'author' => 'Paul Wauters',
                'shortDescription' => 'Hamelen, dat zoals iedereen weet net naast Bamelen ligt, wordt overspoeld door ratten. Dat is niet naar de zin van de bevolking. Maar Gouverneur Hans J. Drumpf is niet onder de indruk. Hij wil vooral Hamelen moderniseren door er een muur rond te bouwen. Ook op school voert hij stevige hervormingen door. Die zijn dan weer niet niet naar de zin van Noisette, plaatselijke bakkerin en plaatsvervangende moeder van haar jongere broertje Tuurke. Om van de ratten af te geraken legt de gouverneur zijn oor te luisteren bij de muzikale Hervé, die zijn oog heeft laten vallen op Noisette... 
Dit hoorspel brengt de politiek dichter bij de gewone man, maar ook ratten dichter bij de beschaving, energie dichter bij sport, kinderen dichter bij de uitputting, het schoolhoofd dichter bij haar ambities en de luisteraar dichter bij de waanzin. Hoe het afloopt, vertellen we niet maar we kunnen al wel meegeven dàt het afloopt. ',
                'addedBy_id' => 1],
            ['title' => 'Sprookjes voor kleine kinderen', 'numberOfPages' => 141, 'author' => 'Catalina Steenkoop',
                'shortDescription' => 'Deze mooie collectie van 5 gekende verhalen introduceert kinderen in de magische wereld van sprookjes.',
                'addedBy_id' => 1],
            ['title' => 'Ik hou van dino\'s', 'numberOfPages' => 16, 'author' => 'Roger Priddy',
                'shortDescription' => 'In dit spannende kartonboek valt veel te beleven. De realistische afbeeldingen nemen kinderen mee in de wereld van de dinosauriërs. Bij elke dino staan specifieke kenmerken om deze oude reuzen goed van elkaar te leren onderscheiden. De stripachtige vormgeving geeft het boek een gevaarlijk stoere look.',
                'addedBy_id' => 1]
        ];
        foreach ($books as $book) {
            ReadingBook::create($book);
        }
    }
}
