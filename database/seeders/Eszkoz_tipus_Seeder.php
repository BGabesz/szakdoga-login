<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Eszkoz_tipus_Seeder extends Seeder

{
    public function run(){
        DB::table('eszkoz_tipuses')->insert([
            ['eszkoz_neve' => 'Kézisúlyzó','suly' => '1','kep' => 'Kép1','leiras' => 'Talán a legegyszerűbb eszköz. Rengeteg gyakorlatot lehet vele csinálni és szimplán csak emelgetni kell.'],
            ['eszkoz_neve' => 'Fekvenyomó Pad','suly' => '1','kep' => 'Kép2','leiras' => 'Ezt a fajtát padot fekve kinyomáshoz használják rúddal, de lehet súlyzóval is.'],
            ['eszkoz_neve' => 'Keresztcsiga','suly' => '1','kep' => 'Kép5','leiras' => 'Leginkább váll etősítéshez használják, húzni kell egy kötelet, vagy egy vas rudat. Kéinek mi a kényelmesebb, cserégethető.'],
            ['eszkoz_neve' => 'Mellnyomó Gép','suly' => '1','kep' => 'Kép6','leiras' => 'A gépek a padok ellentétei, amíg egy padon neked kell figyelni mindenre egy gép pár dolgban segít, ez a gép olyan mint egy egyesnes fekvenyomód pad.'],
            ['eszkoz_neve' => 'Pec-deck Gép','suly' => '1','kep' => 'Kép7','leiras' => 'Ez a gép mell izomra megy már, feszítened kell és összezárni mindkét kezed. A használata egyszerű és nem lehet elrontani.'],
            ['eszkoz_neve' => 'Smith Keret','suly' => '1','kep' => 'Kép8','leiras' => 'Segítségedre van ez a keret a gugolásban, többféle helyre tuodod betenni a rudat amivel gugolsz, ezzel is elő segítve az alacsonyabb embereket és a biztonságot.'],
            ['eszkoz_neve' => 'Húzódzkodó Rúd','suly' => '1','kep' => 'Kép9','leiras' => 'Az egyik legközkedveltebb eszköz ez, bárhol tudod használni és az egyik legjobban formáló gyakorlat a húzodszkodás.'],
            ['eszkoz_neve' => 'Csigás Hátgép','suly' => '1','kep' => 'Kép10','leiras' => 'A csigás gépek előnye hogy több gyakorlatot is végezhetsz egy egyszerű fogantyú változtatásával, ennél a gépnél 3 félét minimum és csak le kell húznod.'],
            ['eszkoz_neve' => 'Evezőgép','suly' => '1','kep' => 'Kép11','leiras' => 'Ez a gép a hátizomra megy rá de arra nagyon. Itt is cserélgethető a fogantyú és csak húzni kell magad felé.'],
            ['eszkoz_neve' => 'Hiperextenzív pad','suly' => '1','kep' => 'Kép14','leiras' => 'A hasprés forítottja ez a gép. Nem a hasadon feszül be az izom hanem a derekadon, csak hajolgatni kell rajta.'],
            ['eszkoz_neve' => 'Vállból Nyomó Gép','suly' => '2','kep' => 'Kép17','leiras' => 'Hasznós váll erősítő gép, egyens háttal le kell üni a padra és a két kart egyszerre ki nyomni a fejed fölé.'],
            ['eszkoz_neve' => 'Lábtoló Gép','suly' => '2','kep' => 'Kép18','leiras' => 'Az legközkedveltebb láb edző gép a lábtoló. Egyszerően le kell üni, 90 fokos szöget tartva egy kissebb döntésben, ki kell nyomni a súlyokat páros lábbal.'],
            ['eszkoz_neve' => 'Lábfeszítő Gép','suly' => '2','kep' => 'Kép19','leiras' => 'Egyszerű gép és ha nincs könnyen potolható, hasonlít egy gugoláshozz csak a lábakat kell emelegetni egyszerre. Combra egy erős gyakorlat.'],
            ['eszkoz_neve' => 'Hack Guggoló Gép','suly' => '2','kep' => 'Kép21','leiras' => 'A lábtoló és láb feszítőgép kombinációja. Egy ferde felüóleten állva súllyal a válladon le ülsz mint ha egy székre ülnél szék nélkül és utána vissza jössz.'],
            ['eszkoz_neve' => 'Comb Távolító Gép','suly' => '2','kep' => 'Kép23','leiras' => 'Kedvelt gép a nőknél, két használata van. Egyszer össze kell szrítani a két lábadat, a másiknál pedig szét kell feszíteni. Mindkettő lehet nehéz.'],
            ['eszkoz_neve' => 'Vízszintes Lábtoló Gép','suly' => '2','kep' => 'Kép25','leiras' => 'A sima lábtoloóhoz hasonlóan itt nem súlyt hanem a saját testsúlyodat nyomod ki. Ha kevésnek találod a gép tud plusszba súlyt rakni rá.'],
            ['eszkoz_neve' => 'Csípőemelő Gép','suly' => '2','kep' => 'Kép26','leiras' => 'Nagyon hasznós gép, a csípődet csak ki kell nyomni, azzal a ruddal amit a gépráhelyez és utána vissza engedni.'],
            ['eszkoz_neve' => 'Francia rúd','suly' => '2','kep' => 'Kép27','leiras' => 'Egy hullámos rúd amire súlyokat tehetünk és a hullámoknak köszönhetően könnyeb felhúzni magad elé.'],
            ['eszkoz_neve' => 'Scott Pad','suly' => '2','kep' => 'Kép30','leiras' => 'Ez a pad hasznós mivel a támlája állítható, a 0 foktól a 90 fokig általában 5 állásra.']
	]);
    }
}