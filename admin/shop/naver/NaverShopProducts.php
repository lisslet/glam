<?php

namespace Glam;

use Dot\File;

class NaverShopProducts
{
	protected $fields = [
		'mapid' => '',
		'pname' => '',
		'price' => '',
		'pgurl' => '',
		'igurl' => '',
		'cate1' => '',
		'cate2' => '',
		'cate3' => '',
		'cate4' => '',
		'caid1' => '',
		'caid2' => '',
		'caid3' => '',
		'caid4' => '',
		'model' => '',
		'brand' => '',
		'maker' => '',
		'origi' => '',
		'deliv' => 0,
		'event' => '',
		'pcard' => '',
		'point' => '',
		'revct' => ''
	];

	protected $products = [];

	/**
	 * filename as output
	 * @var string
	 */
	protected $fileName;

	function __construct(string $fileName)
	{
		$this->fileName = $fileName;
	}

	function add(array $product)
	{
		$this->products[] = $product;

		return $this;
	}

	function render()
	{
		$entries = [];

		$fields = &$this->fields;

		foreach ($this->products as $product) {
			$entries[] = '<<<begin>>>';

			foreach ($fields as $key => $value) {
				$entry = [];
				$entry[] = '<<<' . $key . '>>>';
				$entry[] = $product[$key] ?? $value;
				$entry = \implode('', $entry);
				$entries[] = $entry;
			}

			$entries[] = '<<<ftend>>>';
		}

		$entries = \implode("\n", $entries);

		$entries = \iconv('utf-8', 'euc-kr', $entries);

		File::write($this->fileName, $entries);
	}
}

