<?php

// colours
$variables = file_get_contents(resource_path('assets/variables.json'));
$variablesArray = json_decode($variables, JSON_OBJECT_AS_ARRAY);
$keys = array_keys((array)$variablesArray['colors']);
$colorsArr = [];
if (isset($variablesArray['colors']) && is_array($variablesArray['colors'])) {
	foreach ($variablesArray['colors'] as $key => $colors) {
		array_push($colorsArr, $key);
	}
}

// icons
function icon($file) {
	return str_replace('.svg', '', basename($file));
}

$iconFiles = glob('../resources/assets/sprite/*.svg');
$icons = [];

foreach ($iconFiles as $icon) {
	array_push($icons, [
		'name' => str_replace('.svg', '', basename($icon)),
	]);
}

return [
	'meta' => [
		'title' => 'Styleguide',
		'icon' => '/static/img/meta/favicon-32.png',
		'accent' => '#ff585d',
	],
	'sections' => [
		'foundation' => [
			'heading' => 'Foundations',
			'copy' => 'Basic elements such as fonts, typography and colours.',
			'blocks' => null,
		],
		'block' => [
			'heading' => 'Blocks',
			'copy' => 'More complex components',
			'blocks' => [
				'slider' => [
					'heading' => 'Sliders',
					'previews' => [
						[
							'component' => [
								'name' => 'type-a',
								'type' => 'vue',
							],
							'autoload' => true,
							'stack' => true,
							'container' => true,
							'attributes' => [
								[
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
										'classList' => [
											'wrapper' => 'flex flex-no-wrap',
											'item' => 'flex-shrink-0 w-full',
										],
									],
								],
								[
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
										'classList' => [
											'wrapper' => 'flex flex-no-wrap',
											'item' => 'flex-shrink-0 w-full',
										],
									],
								],
								[
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
										'infinite' => true,
										'duplicates' => 1,
										'classList' => [
											'wrapper' => 'flex flex-no-wrap',
											'item' => 'flex-shrink-0 w-full',
										],
									],
								],
								[
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
										'autoPlay' => false,
										'infinite' => true,
										'duplicates' => 3,
										'itemsToSlide' => 1,
										'classList' => [
											'wrapper' => 'flex flex-no-wrap -ml-5',
											'item' => 'flex-shrink-0 w-1/3 pl-5',
										],
									],
								],
								[
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
										'autoPlay' => false,
										'infinite' => true,
										'duplicates' => 3,
										'itemsToSlide' => 2,
										'classList' => [
											'wrapper' => 'flex flex-no-wrap -ml-5',
											'item' => 'flex-shrink-0 w-1/2 pl-5',
										],
									],
								],
							],
						],
					],
				],
			],
		],
	],
];
