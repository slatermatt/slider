@extends('app/home/home', [
	'model' => [
		'title' => 'Hello World!',
		'items' => [
			[
				'img' => '//placehold.it/1600x900/B335F7?text=1',
			],
			[
				'img' => '//placehold.it/1600x900/8A29BE?text=2',
			],
			[
				'img' => '//placehold.it/1600x900/7B25AA?text=3',
			],
			[
				'img' => '//placehold.it/1600x900/8527B7?text=4',
			],
			[
				'img' => '//placehold.it/1600x900/691F91?text=5',
			],
		],
		'options' => [
			'controls' => true,
			'autoPlay' => true,
			'itemsToSlide' => 1,
			'classList' => [
				'wrapper' => 'flex flex-no-wrap',
				'item' => 'flex-shrink-0 w-full',
			],
		],
	],
])
