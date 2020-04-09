                <?php
                $link = MySQLi_connect("localhost", "localhost", "localhost", "localhost")
                or die("<h3>Ошибка подключения к базе данных" . mysql_error() . "</h3>");
                $opts = array(
                    'http' => array(
                        'method' => "GET",
                        'header' => "Accept-language: en\r\n" .
                            "Cookie: foo=bar\r\n"
                    )
                );
                $context = stream_context_create($opts);
                // Открываем файл с помощью установленных выше HTTP-заголовков
                $jsontimezone2 = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js', false, $context);
                $obj123 = json_decode($jsontimezone2);
                $val1 = $obj123->Valute->USD->Value;
                $valName1 = $obj123->Valute->USD->Name;
                $valNominal1 = $obj123->Valute->USD->Nominal;
                $val2 = $obj123->Valute->EUR->Value;
                $valName2 = $obj123->Valute->EUR->Name;
                $valNominal2 = $obj123->Valute->EUR->Nominal;
                   $result = MySQLi_query($link, "select today, eurtoday from valute;");
                $current_valute = MySQLi_fetch_assoc($result);
                $todayusd = $current_valute['today'];
                $inBase = MySQLi_query($link, "UPDATE valute SET yestoday = '$todayusd';");//обновляем доллар за вчера
                $todayeur = $current_valute['eurtoday'];
                $inBase2 = MySQLi_query($link, "UPDATE valute SET euryestoday = '$todayeur';");//обновляем евро за вчера
                $inBase3 = MySQLi_query($link, "UPDATE valute SET today = '$val1';");//обновляем доллар за сегодня
                $inBase4 = MySQLi_query($link, "UPDATE valute SET eurtoday = '$val2';");//обновляем евро за сегодня
                ?>


