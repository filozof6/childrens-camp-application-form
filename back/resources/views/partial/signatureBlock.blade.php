<?php
$now = new \DateTime();
$formattedNow = $now->format('d. m. Y');
?>
<div style="float: left; width: 50%;">
    <div style="width: 70%; margin: 20px auto 0 auto;">
        <div style="display: inline-block;width: 5%; ">V</div>
        <div style="display: inline-block; border-bottom: 1px dotted black;width: 38%;font-weight: bold;">
            @if($includeSignature)
                Trenčíne
            @endif
        </div>
        <div style="display: inline-block;width: 13%; ">,dňa</div>
        <div style="display: inline-block; border-bottom: 1px dotted black;width: 41%;font-weight: bold;">
            @if($includeSignature)
                {{ $formattedNow }}
            @endif
        </div>
    </div>
    <div style="margin: 0 auto 10px auto; border-bottom: 1px dotted black;width: 70%; height: 120px">
        @if($includeSignature)
        <img style="width: 100%; margin-top: 7px;" src="https://smajlovo.sk/orderForm/back/public/images/smajlovo-sifra.png" />
        @endif
    </div>
    <div style="margin: auto; text-align: center; width: 70%;">
        {{ $text }}
    </div>
</div>
