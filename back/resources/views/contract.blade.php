<html>
@include('partial.emailMetaHead')
<body>
<header><h1>Zmluva</h1></header>
<h4 style="text-align: center">Zmluva o účasti v detskom tábore</h4>
<div style="width: 100%; text-align: center;">podľa ustanovení § 51 Občianskeho zákonníka v znení neskorších predpisov
    medzi
</div>

<br>
<table class="form-data-table">
    <tr>
        <td>názov:</td>
        <th>SMAJLOVO</th>
    </tr>
    <tr>
        <td>právna forma:</td>
        <th>občianske združenie</th>
    </tr>
    <tr>
        <td>adresa, ulica:</td>
        <th>Kostolná - Záriečie č. 127</th>
    </tr>
    <tr>
        <td>adresa, mesto:</td>
        <th>913 04 Kostolná-Záriečie</th>
    </tr>
</table>
<br>
<table class="form-data-table">
    <tr>
        <td>IČO:</td>
        <th>50 001 680</th>
    </tr>
    <tr>
        <td>zastúpený:</td>
        <th>Mgr. Janka Gáborová, štatutár</th>
    </tr>
    <tr>
        <td>e-mail:</td>
        <th>smajlovo@smajlovo.sk</th>
    </tr>
    <tr>
        <td>telefón:</td>
        <th>0903 467 612</th>
    </tr>
</table>
<p>
    (ďalej aj „Poskytovateľ“ a/alebo „OZ“),
</p>
<p>
    a
</p>
<p>
    (ďalej aj „Užívateľ“ a/alebo „Rodič“)
</p>
<table class="form-data-table">
    <tr>
        <td>meno, priezvisko:</td>
        <th>
            {{ $input['customer']['title'] ? $input['customer']['title'] . ' ' : '' }}
            {{ $input['customer']['firstName'] }}
            {{ $input['customer']['lastName'] }}
        </th>
    </tr>
    <tr>
        <td>bydlisko, ulica:</td>
        <th>{{ $input['customer']['address']['streetNumber'] }}</th>
    </tr>
    <tr>
        <td>bydlisko, mesto:</td>
        <th>{{ $input['customer']['address']['city'] }}</th>
    </tr>
    <tr>
        <td style="height: 30px"></td>
    </tr>
    <tr>
        <td>e-mail:</td>
        <th>{{ $input['customer']['email'] }}</th>
    </tr>
    <tr>
        <td>telefón:</td>
        <th>{{ $input['customer']['mobile'] }}</th>
    </tr>
</table>
<p>
    (ďalej aj „Užívateľ“ a/alebo „Rodič“)
</p>
<p>
    Poskytovateľ organizuje detské tábory SMAJLOVO. Užívateľ má záujem prihlásiť do tábora dieťa/deti v súlade s touto
    Zmluvou,
    preto sa Poskytovateľ a Užívateľ dohodli na tejto Zmluve. Pre vylúčenie pochybností, ak je niektoré ustanovenie
    Zmluvy a Všeobecných podmienok poskytovania služieb vo vzájomnom rozpore, tak v takom prípade platí to ustanovenie,
    ktoré je uvedené v Zmluve. <br>
    Všetky dôležité dokumenty a informácie sa nachádzajú na web stránke <a href="https://www.smajlovo.sk">www.smajlovo.sk</a>
</p>
<p>
    Predmetom Zmluvy je to, že Užívateľ objednal detský tábor SMAJLOVO pre maloleté dieťa/deti
</p>
<table>
    <tr>
        <td>meno dieťaťa:</td>
        <th>{{ $input['children'][0]['firstName'] }} {{ $input['children'][0]['lastName'] }}</th>
    </tr>
    @if($input['anotherKid'])
        <tr>
            <td>meno dieťaťa:</td>
            <th>{{ $input['children'][1]['firstName'] }} {{ $input['children'][1]['lastName'] }}</th>
        </tr>]
    @endif
</table>

@if(!$input['anotherKid'])
    <br>
    <br>
@endif
<style>
    ol {
        counter-reset: item;
        margin-left: 0;
        padding-left: 0;
    }

    ol > li {
        display: block;
        padding-top: 20px;
    }

    ol > li:before {
        font-weight: bold;
        content: counters(item, ".") ". ";
        counter-increment: item;
        /*margin-left: -28px;*/
    }

    ul {
        margin-left: 0;
        padding-left: 15px;
    }

    /*.li-content {*/
    /*    padding-left: 20px;*/
    /*}*/

    /*ul > li {*/
    /*    margin-left: 0;*/
    /*    padding-left: 0;*/
    /*}*/

    /*ul >  li:before {*/
    /*    !*content: "-";*!*/
    /*    !*padding-right: 5px;*!*/
    /*    margin-left: 0;*/
    /*    padding-left: 0;*/
    /*}*/
</style>
<br>
<ol>
    <li><strong>Vznik zmluvného vzťahu</strong><br>
        <div class="li-content">Zmluvný vzťah medzi Poskytovateľom a Užívateľom vzniká vyplnením a odoslaním
            riadne vyplnenej Objednávky, ktorej formulár sa nachádza na web stránke
            <a href="https://www.smajlovo.sk/">www.smajlovo.sk</a> , a zaplatením stanovenej čiastky v zmysle Cenníka.
        </div>
    </li>
    <li><strong>Povinnosti užívateľa</strong><br>
        <div class="li-content">
            <ul>
                <li>riadne vyplniť a odoslať Objednávku, ktorej formulár sa nachádza na web stránke
                    <a href="https://www.smajlovo.sk/">www.smajlovo.sk</a>,
                </li>
                <li>zaplatiť Poskytovateľovi stanovenú čiastku za účasť dieťaťa/detí v tábore
                    SMAJLOVO,
                </li>
                <li>odovzdať Poskytovateľovi „Prehlásenie o bezinfekčnosti a zdravotnom stave
                    dieťaťa“ a „Potvrdenie od lekára o zdravotnej spôsobilosti dieťaťa“, spolu s kópiou
                    preukazu poistenca,
                </li>
                <li>priviesť dieťa včas na stanovené miesto v určený čas, pričom pri odchode autobus
                    čaká max.20 min. po stanovenom čase,
                </li>
                <li>pri návrate z tábora je rodič (prípadne iná dospelá osoba písomne poverená
                    rodičom ) povinný prevziať dieťa osobne ( bez ohľadu na vek dieťaťa ).
                </li>
            </ul>
            <ol>
                <li><strong>Užívateľ má právo:</strong><br>
                    <div class="li-content">
                        <ul>
                            <li>vyžadovať poskytnutie objednaných a zaplatených služieb v dohodnutom
                                rozsahu a kvalite,
                            </li>
                            <li>prípadné nedostatky bezodkladne reklamovať a požadovať nápravu,</li>
                            <li>ak je to nutné, tak najneskôr 10 dní pred nástupom dieťaťa do tábora oznámiť
                                Poskytovateľovi, že sa tábora namiesto prihláseného dieťaťa zúčastní iné dieťa
                                ako náhradník.
                            </li>
                        </ul>
                    </div>
                </li>
            </ol>
        </div>
    </li>
    <li><strong>Povinnosti poskytovateľa</strong><br>
        <div class="li-content">
            <ul>
                <li>poskytnúť Užívateľovi všetky dostupné informácie o podrobnostiach tábora, o
                    mieste a hodine stretnutia a spoločného odchodu do tábora,
                </li>
                <li>v priebehu tábora riadne a kvalitne poskytovať dohodnuté služby,</li>
                <li>riešiť reklamácie do 30 dní po nahlásení reklamácie,</li>
                <li>v prípade prekážok brániacich Poskytovateľovi poskytnúť dohodnuté služby,
                    zabezpečiť adekvátnu náhradu.
                </li>
            </ul>
            <ol>
                <li><strong>Poskytovateľ má právo:</strong><br>
                    <div class="li-content">
                        <ul>
                            <li>odstúpiť od Zmluvy pri dodržaní stornovacích podmienok, ak Užívateľ
                                najneskôr 14 dní pred odchodom na tábor nezaplatí celú dohodnutú cenu,
                                alebo celý jej doplatok,
                            </li>
                            <li>v prípade opakovaného či hrubého porušenia táborového poriadku (alkohol,
                                cigarety, drogy, agresivita, neslušné správanie a pod.) predčasne ukončiť
                                dieťaťu pobyt a poslať ho domov na náklady Užívateľa,
                            </li>
                            <li>robiť operatívne zmeny programu v priebehu zájazdu, pokiaľ z vážnych
                                dôvodov nie je možné zabezpečiť pôvodne dohodnutý program. V takomto
                                prípade je Poskytovateľ povinný zabezpečiť náhradný program a služby v
                                kvalite a rozsahu pokiaľ možno zhodne k pôvodným podmienkam.
                            </li>
                            <li>zrušiť tábor v týchto prípadoch (Užívateľovi bude vrátená celá ním uhradená
                                cena za pobyt dieťaťa v tábore)
                                <ul>
                                    <li>z dôvodu vyššej moci (politické udalosti, extrémne podnebné javy,
                                        karanténa, zlyhanie prevádzkyschopnosti zariadenia a pod.)
                                    </li>
                                    <li>z dôvodu neobsadenosti tábora dostatočným počtom účastníkov (do 15
                                        dní pred nástupom).
                                    </li>
                                </ul>
                            </li>
                            <li>odstúpiť od Zmluvy, ak Užívateľ nesplnil zmluvné podmienky,</li>
                            <li> zmeniť čas a miesto odchodu do tábora a príchodu z tábora, o tejto
                                skutočnosti je Poskytovateľ povinný bezodkladne informovať Užívateľa.
                            </li>
                        </ul>
                    </div>
                </li>
                <li><strong>Ochorenie detí v tábore</strong><br>
                    <div class="li-content">
                        Ochorenie detí v tábore
                        Na zdravotný stav detí bude dohliadať zdravotník. <strong>Bežné ochorenie sa rodičom
                            neoznamuje (ak si to rodič želá, uvedie to v Prehlásení o bezinfekčnosti).</strong> Ak dieťa
                        ochorie infekčnou chorobou, alebo jeho ochorenie vyžaduje ležať na lôžku viac ako tri
                        dni, musí pobyt v tábore ukončiť. Rodič je povinný na svoje náklady choré dieťa
                        z tábora prevziať. Ak má dieťa <strong>uzatvorené poistenie pre prípad predčasného
                            odchodu z tábora zo zdravotného dôvodu</strong>, príslušnú čiastku za tábor si bude
                        uplatňovať v poisťovni, ak dieťa nie je poistené proti predčasnému odchodu z tábora,
                        OZ za nevyčerpané služby peniaze nevracia. Ak rodič predčasne ukončí pobyt dieťaťa
                        z iných dôvodov, Užívateľ nemá nárok na vrátenie peňazí z nevyčerpaných služieb. V
                        <strong>Prehlásení o bezinfekčnosti a zdravotnom stave dieťaťa je rodič povinný
                            zodpovedne prehlásiť, že v blízkosti dieťaťa sa nevyskytla v poslednom období
                            (1 mesiac) žiadna infekčná choroba</strong>. V opačnom prípade pri zatajovaných
                        skutočnostiach, bude dieťa ihneď vrátené na vlastné náklady rodičov domov, v tomto
                        prípade sa zvyšná čiastka za pobyt nebude rodičom vracať.
                    </div>
                </li>
                <li><strong>Služby</strong><br>
                    <div class="li-content">
                        Poskytovateľ zabezpečí ubytovanie odsúhlasené miestne príslušným Regionálnym
                        úradom verejného zdravotníctva, odborný pedagogický dozor, celodenný program,
                        zdravotnú službu a ďalšie služby odsúhlasené Užívateľom v zmysle Cenníka. Uvedené
                        služby sú zahrnuté v cene tábora.
                    </div>
                </li>
                <li><strong>Cena tábora</strong><br>
                    <div class="li-content">
                        Poskytovateľ nie je platca DPH. Cena tábora je uvedená v Cenníku.
                        Poskytovateľ môže cenu zmeniť iba v prípade zvýšenia vstupných cien voči
                        kalkulovanej cene o viac ako 5% a to najneskôr 21 dní pred nástupom na turnus.
                    </div>
                </li>
                <li><strong>Odstúpenie od zmluvy, storno poplatky</strong><br>
                    <div class="li-content">
                        Užívateľ môže odstúpiť od Zmluvy iba písomnou formou odoslaním Odstúpenia na
                        poštovú adresu Poskytovateľa, rozhodujúcim je dátum odoslania Odstúpenia. Užívateľ
                        je povinný uhradiť Poskytovateľovi storno poplatok závislý od dňa dátumu odoslania
                        Odstúpenia<br>
                        Odstúpenie odoslané 30–21 dní pred nástupom dieťaťa do tábora: 30 % z ceny pobytu.<br>
                        Odstúpenie odoslané 20–11 dní pred nástupom dieťaťa do tábora: 50 % z ceny pobytu.<br>
                        Odstúpenie odoslané 10–3 dni pred nástupom dieťaťa do tábora: 90 % z ceny pobytu.<br><br>
                        Odstúpenie odoslané menej ako 3 dní pred nástupom dieťaťa do tábora: 100 % z ceny
                        pobytu.<br><br>
                        Pri odstúpení od Zmluvy 31 a viac dní pred nástupom sa účtuje manipulačný storno
                        poplatok vo výške 15,00 EUR/dieťa.
                    </div>
                </li>
                <li><strong>Poistenie</strong><br>
                    <div class="li-content">
                        Ak má Užívateľ záujem o poistenie, zabezpečí si toto poistenie dieťaťa individuálne.
                    </div>
                </li>
                <li><strong>Reklamácie</strong><br>
                    <div class="li-content">
                        V prípade, že pri plnení Zmluvy dôjde zo strany Poskytovateľa k závažným
                        nedostatkom, Užívateľ má právo reklamácie. Nedostatky poskytovaných služieb je
                        povinný bezodkladne oznámiť Poskytovateľovi a požadovať nápravu. Poskytovateľ
                        prijíma len písomné reklamácie, najneskôr 3 mesiace po skončenia tábora, inak právo
                        na reklamáciu zaniká. Poskytovateľ rozhodne o oprávnenosti reklamácie najneskôr do
                        30 dní.
                    </div>
                </li>
                <li><strong>Záverečné ustanovenia</strong><br>
                    <div class="li-content">
                        Užívateľ potvrdzuje podpisom tejto Zmluvy, že Zmluvu uzatvoril slobodne, vážne, bez
                        nátlaku, s ustanoveniami Zmluvy súhlasí a v plnom rozsahu ich prijíma.<br>
                        Neoddeliteľnou súčasťou tejto Zmluvy sú<br>
                        <ul>
                            <li>Všeobecné podmienky poskytovania služieb,</li>
                            <li>Cenník,</li>
                            <li>Informácia o spracúvaní osobných údajov v rámci táborových aktivít.</li>
                        </ul>
                    </div>
                </li>
            </ol>
        </div>
    </li>
</ol>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@include('partial.signatureBlock', ['text' => 'Objednávateľ/užívateľ: ', 'includeSignature'=> false, ])
@include('partial.signatureBlock', ['text' => 'Poskytovateľ: ', 'includeSignature' => true])
<span style="clear: both"></span>

@include('partial.emailFooter')
</body>
</html>