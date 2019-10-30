<?php
use yii\helpers\Html;

$this->title = 'AJAX-Chat';
$this->params['breadcrumbs'][] = $this->title;

echo Html::tag('h1', $this->title);

echo Html::beginTag('div', ['id' => 'chat']);

foreach ($messages as $messag) {

    echo Html::tag('div', $messag->datum . " " . $messag->name . " " . $messag->inhalt);
}

echo Html::endTag('div'); // chat

echo Html::textInput('name', '', ['id' => 'name']);
echo Html::textInput('inhalt', '', ['id' => 'inh']);

echo Html::button('Absenden', ['id' => 'derbutton']);

echo $this->registerJs("

    // einen event beim button hinterlegen, der ausgeführt wird, wenn der button gedrückt wird

    $( '#derbutton' ).click(function() {
        var api_url = 'api/newmessage';

        // im event wird name und inhalt ausgelesen und in eine js-var gespeichert

        var name = $('#name').val();
        var inhalt = $('#inh').val();
        console.log(name, inhalt);

        // url (rest-api) aufruf an server zum speichern von name und inhalt

        $.ajax({
            method:'GET',
            url: '/yii2-basic/basic/web/index.php?r=api/newmessage',
            data: {
                name: name,
                inhalt: inhalt
            }

          })
            .done(function( data ) {
              //if ( console && console.log ) {
               // console.log( 'Sample of data:', data.slice( 0, 100 ) );
             // }
             console.log(data);
            });

        // anzeige inhalt/name direkt in chat-div anhängen

        $('#chat').append(inhalt + ' ' + name);

        // alert-box mit 'danke'


        alert( 'Danke.' );
    })

");
