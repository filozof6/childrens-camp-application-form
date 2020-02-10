<html>
@include('partial.emailMetaHead')
<body>
<h2>Potvrdenie lekára o zdravotnej spôsobilosti dieťaťa</h2>
<br>
<br>
<br>
<table>
    <tr>
        <td nowrap>Potvrdzujem, že dieťa </td>
        <th>{{ $kid['firstName'] }} {{ $kid['lastName'] }}</th>
    </tr>
</table>
<table style="width: 100%">
    <tr style="width: 100%">
        <td>je spôsobilé absolvovať letný tábor SMAJLOVO </td>
    </tr>
</table>
<table>
    <tr>
        <td nowrap>V termíne:</td>
        <th>{{ $term }}</th>
    </tr>
</table>
<br>
<br>
<br>
<br>
<br>
<table style="width: 100%">
    <tr style="width: 100%">
        <td nowrap>Pečiatka a podpis detského lekára:</td>
    </tr>
</table>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<table>
    <tr>
        <td nowrap>Dňa:</td>
        <td style="width: 200px; border-bottom: 1px dotted black;">&nbsp;</td>
    </tr>
</table>
<br>
<br>
<table style="width: 100%">
    <tr style="width: 100%">
        <td style="width: 100%; text-align: center;">( potvrdenie lekára nesmie byť staršie ako 3 dni pred nástupom do tábora )</td>
    </tr>
</table>
@include('partial.emailFooter')
</body>
</html>