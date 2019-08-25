<?php
	$utf8 = header("Content-Type>text/html; charset=utf8"); // retorna os caracteres corrigidos
	$link = new mysqli('200.131.11.23', 'sw_pizza', 'obreiros', 'sw_pizza');
	$link->set_charset('utf8');