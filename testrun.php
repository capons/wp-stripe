<?php

	//$_GET['action']
	
//	echo exec('whoami');
//	echo exec('forever start ');

echo '<pre>';

// Выводит весь результат шелл-команды "ls", и возвращает 
// последнюю строку вывода в переменной $last_line. Сохраняет код возврата
// шелл-команды в $retval.
//$last_line = system('ls', $retval);
//$last_line = system('pwd', $retval);

//$last_line = system('forever start /home/devmusicsuper/public_html/app.js --prod', $retval);

$last_line = system('sails lift /home/devmusicsuper/public_html/app.js --prod', $retval);


// Выводим дополнительную информацию
echo '
</pre>
<hr />Последняя строка вывода: ' . $last_line . '
<hr />Код возврата: ' . $retval;