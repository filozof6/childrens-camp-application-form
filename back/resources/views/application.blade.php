<html>
@include('partial.emailMetaHead')
<body>
<h2 style="text-align: center">Objednávka</h2>
<h2 style="text-align: center">detského tábora SMAJLOVO</h2>
<br>
<p>
    <strong>Termín:</strong>
    <?php
    $index = $input['trip']['selected'] - $input['trip']['options'][0]['value'];
    echo explode(';', $input['trip']['options'][$index]['text'])[0];
    ?>
</p>
<br>
<h4>Objednávateľ</h4>
<table style="width: 100%">
    <tr style="width: 100%">
        <td style="width: 50%">
            <table class="form-data-table">
                <tr>
                    <td>Titul:</td>
                    <th>{{ $input['customer']['title'] }}</th>
                </tr>
                <tr>
                    <td>Meno:</td>
                    <th>{{ $input['customer']['firstName'] }}</th>
                </tr>
                <tr>
                    <td>Priezvisko:</td>
                    <th>{{ $input['customer']['lastName'] }}</th>
                </tr>
                <tr>
                    <td>Telefónne číslo:</td>
                    <th>{{ $input['customer']['mobile'] }}</th>
                </tr>
                <tr>
                    <td>Osobný e-mail:</td>
                    <th>{{ $input['customer']['email'] }}</th>
                </tr>
            </table>
        </td>
        <td style="vertical-align: text-top">
            <table class="form-data-table">
                <tr>
                    <td>Ulica:</td>
                    <th>{{ $input['customer']['address']['streetNumber'] }}</th>
                </tr>
                <tr>
                    <td>Mesto:</td>
                    <th>{{ $input['customer']['address']['city']  }}</th>
                </tr>
                <tr>
                    <td>PSČ:</td>
                    <th>{{ $input['customer']['address']['zipCode']  }}</th>
                </tr>
            </table>
        </td>
    </tr>
</table>
<br>
<table  class="form-data-table" style="width: 100%">
    <tr style="width: 100%">
        <td style="width: 50%">
            <h4>Údaje o dieťati</h4>
            @include('partial.kidTable', ['kid' => $input['children'][0]])
        </td>
        @if ($input['anotherKid'])
            <td style="width: 50%">
                <h4>Údaje o súrodencovi</h4>
                @include('partial.kidTable', ['kid' => $input['children'][1]])
            </td>
        @endif
    </tr>
</table>
<br>
<br>
<h4>Poznámky</h4>
<p>{{ $input['notes'] }}</p>
<br>
<table style="width: 100%">
    <tr style="width: 100%">
        <td style="width: 50%">
            <h4>Doprava do/z tábora</h4>
            @if ($input['transportation'] === 'individual')
                <p>Individuálna</p>
            @else
                <p>Spoločná</p>
            @endif
        </td>
        @if ($input['transportation'] === 'group')
            <td style="width: 50%">
                <h4>Miesto nástupu</h4>
                <p>
                    <?php
                    $index = $input['groupTransport']['selected'] - $input['groupTransport']['options'][0]['value'];
                    echo $input['groupTransport']['options'][$index]['text'];
                    ?>
                </p>
            </td>
        @endif
    </tr>
</table>
<br>
<p>Celková cena: <strong>{{ $input['totalPrice'] }} EUR</strong></p>
<br>
<p>Dňa: <strong>{{ (new \DateTime())->format('d. m. Y') }}</strong></p>
@include('partial.emailFooter')
</body>
</html>