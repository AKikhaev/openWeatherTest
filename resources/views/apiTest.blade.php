<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>API open weather test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 40px;
            }

            #result {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-align: left;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    API open weather test
                </div>

                Город:
                <input id="inpCity" type="text" value="Omsk">
                <button id="btnGet">Получить</button>

                <pre id="result">
                    Нажмите получить для выполнения запроса
                </pre>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $.when( $.ready ).then(function() {
            $('#btnGet').click(function(){
                $('#result').empty();

                $.ajax({
                    url: "/api/1.0/weather/"+encodeURIComponent($('#inpCity').val()),
                    cache: false,
                    //dataType: 'text'
                })
                    .done(function( json ) {

                        let str = JSON.stringify(json, null, 2);
                        $( "#result" ).html( str );
                    });

                // $.ajax( {
                //     url:"/api/1.0/weather/"+encodeURIComponent($('#inpCity').val()),
                //     dataType:'json'
                // })
                // .done(function(data) {
                //     $('#result').html(data);
                // })
                // .fail(function(e) {
                //     console.log(e);
                // });
            });
        });
    </script>
    </body>
</html>
