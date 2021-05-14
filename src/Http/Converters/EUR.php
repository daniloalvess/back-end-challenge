<?php
namespace App\Http\Converters;

class EUR
{
	public function BRL($CotEur, $brl)
	{
		$real = $brl * $CotEur;

		return $real;
	}
}