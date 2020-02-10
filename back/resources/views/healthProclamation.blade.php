<html>
@include('partial.emailMetaHead')
<body>
<h2>Prehlásenie rodičov o bezinfekčnosti a zdravotnom stave dieťaťa</h2>
<p>( odovzdáva sa pri nástupe do tábora )</p>
<table style="width: 100%">
    <tr style="width: 100%">
        <td>Meno a priezvisko dieťaťa:</td>
        <th>{{ $kid['firstName'] }} {{ $kid['lastName'] }}</th>
    </tr>
</table>
<p>
    Prehlasujem, že dieťa neprejavuje príznaky akútneho ochorenia a že regionálny úrad zdravotníctva ani lekár
    všeobecnej
    zdravotnej starostlivosti pre deti a dorast menovanému dieťaťu nenariadil karanténne opatrenie (karanténu, zvýšený
    zdravotný dozor alebo lekársky dohľad).
</p>
<p>
    Nie je mi známe, že by dieťa, jeho rodičia, alebo iné osoby, ktoré s ním žijú spoločne v domácnosti, prišli v
    priebehu posledného mesiaca do styku s osobami, ktoré ochoreli na prenosné ochorenia (napr. hnačka, angína, vírusový
    zápal pečene, zápal mozgových blán, horúčkové ochorenie s vyrážkami).
</p>
<p>
    Som si vedomý(á) právnych následkov v prípade nepravdivého vyhlásenia, najmä som si vedomý(á), že by som sa
    dopustil(a)
    priestupku podľa § 56 zákona č. 355/2007 Z. z. o ochrane, podpore a rozvoji verejného zdravia a o zmene a doplnení
    niektorých zákonov.
</p>

<br/>
<p><strong>Ďalšie informácie o zdravotnom stave dieťaťa</strong></p>
@include('partial.inputTable', ['text' => 'Užíva dieťa pravidelne lieky (aké)?'])
@include('partial.inputTable', ['text' => 'Je dieťa alergické ( napr. poštípanie hmyzom, peľ, lieky – uveďte presne):'])
@include('partial.inputTable', ['text' => 'Iné možné zdravotné problémy:'])
@include('partial.inputTable', ['text' => 'Iné problémy:'])
<br/>
<br/>
<br/>
<table style="width: 100%">
    <tr style="width: 100%">
        <td style="width: 50%">
            <table>
                <tr>
                    <td nowrap>Dňa:</td>
                    <td style="width: 200px; border-bottom: 1px dotted black;">&nbsp;</td>
                </tr>
            </table>
        </td>
        <td style="width: 50%">
            <table style="margin-left: auto; margin-right: 0">
                <tr>
                    <td nowrap>Podpis rodiča:</td>
                    <td style="width: 250px; border-bottom: 1px dotted black;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@include('partial.emailFooter')
</body>
</html>