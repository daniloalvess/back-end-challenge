<?php
namespace App\Http\Converters;

class BRL 
{
	public function EUR($CotEur, $brl)
	{
		$euro = $brl / $CotEur;

		return $euro;
	}

	public function USD($CotDol, $brl)
	{
		$dolar = $brl / $CotDol;

		return $dolar; 
	}
}