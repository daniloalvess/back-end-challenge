<?php
namespace App\Http\Converters;

class USD 
{
	public function BRL($CotUsd, $brl)
	{
		$real = $brl * $CotUsd;

		return $real;
	}
}