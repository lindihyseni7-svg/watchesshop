<?php
declare(strict_types=1);

namespace App\Content;

final class BlogCatalog
{
    public static function all(): array
    {
        return [
            [
                'slug' => 'si-ta-zgjedhesh-oren-e-pare-premium',
                'title' => 'Si ta zgjedhesh oren e pare premium',
                'category' => 'Udhezues',
                'date' => '28 Korrik 2026',
                'read_time' => '6 min lexim',
                'image' => 'img/artikulli-1.jpg',
                'excerpt' => 'Buxheti, madhesia, mekanizmi dhe stili: kater vendime qe e bejne zgjedhjen shume me te qarte.',
                'intro' => 'Ora e pare premium nuk duhet zgjedhur vetem nga logoja. Zgjedhja e mire fillon nga menyra si do ta perdorosh, proporcioni ne dore dhe kostoja reale e pronesise.',
                'sections' => [
                    ['Nis me menyren e perdorimit', 'Per pune dhe veshje formale kerko profil te holle dhe dial te paster. Per perdorim aktiv, rezistenca ne uje, lexueshmeria dhe bracelet-i solid kane me shume rendesi.'],
                    ['Provo proporcionin, jo vetem diametrin', 'Diametri eshte vetem nje numer. Distanca lug-to-lug, trashesia dhe forma e kases vendosin nese ora ulet mire ne dore.'],
                    ['Llogarit sherbimin afatgjate', 'Mekanizmat automatike kerkojne servis periodik. Quartz-i eshte me praktik dhe preciz, ndersa mekanika ofron me shume karakter dhe tradite.'],
                ],
            ],
            [
                'slug' => 'automatic-apo-quartz',
                'title' => 'Automatic apo quartz: cili mekanizem te pershtatet?',
                'category' => 'Mekanizma',
                'date' => '21 Korrik 2026',
                'read_time' => '5 min lexim',
                'image' => 'img/artikulli-2.jpg',
                'excerpt' => 'Dy filozofi te ndryshme te matjes se kohes, me avantazhe reale per perdorues te ndryshem.',
                'intro' => 'Mekanizmi percakton menyren si ora mat kohen, si mire mbahet dhe si ndihet ne perdorim. Asnjera zgjedhje nuk eshte automatikisht me e mire per te gjithe.',
                'sections' => [
                    ['Automatic', 'Energjia krijohet nga levizja e dores dhe ruhet ne susten kryesore. Eshte zgjedhje emocionale dhe mekanike, por kerkon servis dhe rregullim me kalimin e viteve.'],
                    ['Quartz', 'Bateria dhe kristali quartz japin precizion te larte, kosto me te ulet sherbimi dhe perdorim pa shqetesim. Eshte ideal per nje ore qe duhet te jete gjithmone gati.'],
                    ['Zgjedhja praktike', 'Zgjidh automatic nese vlereson mekaniken dhe ritualin. Zgjidh quartz nese prioriteti yt eshte precizioni, qendrueshmeria dhe mirembajtja minimale.'],
                ],
            ],
            [
                'slug' => 'udhezues-per-ora-diver',
                'title' => 'Ora diver: cfare ka rendesi pertej pamjes',
                'category' => 'Teknologji',
                'date' => '12 Korrik 2026',
                'read_time' => '7 min lexim',
                'image' => 'img/artikulli-3.jpg',
                'excerpt' => 'Bezel-i, lume, kurora dhe rezistenca ne uje shpjegohen ne gjuhe te thjeshte.',
                'intro' => 'Nje diver serioz eshte instrument. Edhe kur nuk perdoret per zhytje, standardet e tij sjellin qendrueshmeri, lexueshmeri dhe siguri ne perdorim te perditshem.',
                'sections' => [
                    ['Rezistenca ne uje', 'Vlera 200 m ose 300 m nuk eshte vetem marketing. Ajo shoqerohet me kurore te vidhosur, guarnicione dhe testim te kases.'],
                    ['Bezel-i nje-drejtimor', 'Lejon matjen e kohes se kaluar dhe leviz vetem ne drejtimin qe zvogelon kohen e mbetur, nje detaj i projektuar per siguri.'],
                    ['Lexueshmeria', 'Indekset e medha, kontrasti dhe materiali luminescent duhet ta bejne oren te lexueshme shpejt ne drite te ulet.'],
                ],
            ],
            [
                'slug' => 'historia-e-bulova',
                'title' => 'Bulova: inovacion, dizajn dhe momente historike',
                'category' => 'Histori',
                'date' => '4 Korrik 2026',
                'read_time' => '8 min lexim',
                'image' => 'img/artikulli-4.jpg',
                'excerpt' => 'Nga reklamat e hershme te precizioni elektronik dhe kronografi Lunar Pilot.',
                'intro' => 'Bulova eshte nje shembull i mire se si nje marke mund te lidhe prodhimin industrial, komunikimin modern dhe inovacionin teknik ne nje identitet te vetem.',
                'sections' => [
                    ['Nje marke e ndertuar mbi precizionin', 'Qe ne fillimet e saj, Bulova investoi ne standardizim dhe prodhim te organizuar, duke e bere oren cilesore me te arritshme.'],
                    ['Accutron', 'Teknologjia tuning-fork solli nje nivel te ri precizioni dhe nje tingull karakteristik, duke shenuar nje kapitull te rendesishem para epokes quartz.'],
                    ['Lunar Pilot', 'Kronografi i lidhur me misionin Apollo 15 mbetet nje nga historite me te forta te markes dhe nje ure mes instrumentit dhe koleksionit modern.'],
                ],
            ],
            [
                'slug' => 'si-te-kujdesesh-per-oren',
                'title' => 'Si ta mbash oren ne gjendje te mire',
                'category' => 'Kujdes',
                'date' => '26 Qershor 2026',
                'read_time' => '4 min lexim',
                'image' => 'img/artikulli-5.jpg',
                'excerpt' => 'Pastrimi, magnetizmi, uji dhe servisi: zakone te vogla qe zgjasin jeten e ores.',
                'intro' => 'Kujdesi i mire nuk kerkon ritual te komplikuar. Disa zakone te thjeshta mbrojne kasen, mekanizmin dhe guarnicionet per vite.',
                'sections' => [
                    ['Pastroje me kujdes', 'Per kase dhe bracelet metalik perdor nje pecete te bute. Mos perdor kimikate agresive dhe mos e lag oren pa e njohur gjendjen e guarnicioneve.'],
                    ['Shmang magnetizmin e forte', 'Altosharlantet, kapaket magnetike dhe pajisjet e fuqishme mund te ndikojne ne mekanizmin mekanik dhe ne saktesine e tij.'],
                    ['Planifiko servisin', 'Nje kontroll periodik i rezistences ne uje dhe nje servis sipas rekomandimit te prodhuesit ndihmojne te shmangen demtime me te kushtueshme.'],
                ],
            ],
            [
                'slug' => 'si-te-lexosh-specifikimet-e-ores',
                'title' => 'Si te lexosh specifikimet e nje ore',
                'category' => 'Udhezues',
                'date' => '18 Qershor 2026',
                'read_time' => '6 min lexim',
                'image' => 'img/artikulli-3.jpg',
                'excerpt' => 'Materiali, xhami, rezerva e energjise dhe rezistenca ne uje pa terminologji te panevojshme.',
                'intro' => 'Specifikimet kane vlere kur lidhen me perdorimin real. Nje numer me i madh nuk eshte gjithmone me i mire nese e ben oren me te rende ose me te trashe per doren tende.',
                'sections' => [
                    ['Materiali i kases', 'Celiku eshte zgjedhja me e balancuar. Titani eshte me i lehte, ndersa qeramika i reziston mire gervishtjeve por kerkon kujdes ndaj goditjeve.'],
                    ['Xhami', 'Sapphire ka rezistence te larte ndaj gervishtjeve. Mineral crystal eshte me ekonomik dhe mund te jete me tolerant ndaj goditjeve te caktuara.'],
                    ['Rezerva e energjise', 'Tregon sa kohe vazhdon mekanizmi automatik ose manual pasi nuk vishet. Per rotacion me disa ora, 70-80 ore jane praktike.'],
                ],
            ],
        ];
    }

    public static function find(string $slug): ?array
    {
        foreach (self::all() as $post) {
            if ($post['slug'] === $slug) {
                return $post;
            }
        }

        return null;
    }
}
