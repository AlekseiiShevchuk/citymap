<?php

return [
		'user-management' => [		'title' => 'User Management',		'created_at' => 'Time',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',		],	],
		'languages' => [		'title' => 'Languages',		'created_at' => 'Time',		'fields' => [			'abbreviation' => 'Abbreviation',			'name' => 'Name',			'is-active-for-admin' => 'Is active for admin',			'is-active-for-users' => 'Is active for users',		],	],
		'cities' => [		'title' => 'Cities',		'created_at' => 'Time',		'fields' => [			'name-en' => 'Name (in English)',			'population' => 'Population',			'year-of-foundation' => 'Year of foundation',			'latitude' => 'Latitude',			'longitude' => 'Longitude',			'cities-to-go' => 'Cities to go',		],	],
		'localized-city-data' => [		'title' => 'Localized city data',		'created_at' => 'Time',		'fields' => [			'city' => 'City',			'language' => 'Language',			'name' => 'Localized Name',			'description' => 'Localized Description',		],	],
		'players' => [		'title' => 'Players',		'created_at' => 'Time',		'fields' => [			'device-id' => 'Device id',			'nickname' => 'Nickname',			'language' => 'Language',		],	],
	'qa_create' => 'Toevoegen',
	'qa_save' => 'Opslaan',
	'qa_edit' => 'Bewerken',
	'qa_view' => 'Bekijken',
	'qa_update' => 'Bijwerken',
	'qa_list' => 'Lijst',
	'qa_no_entries_in_table' => 'Geen inhoud gevonden',
	'custom_controller_index' => 'Custom controller index.',
	'qa_logout' => 'Logout',
	'qa_add_new' => 'Toevoegen',
	'qa_are_you_sure' => 'Ben je zeker?',
	'qa_back_to_list' => 'Terug naar lijst',
	'qa_dashboard' => 'Boordtabel',
	'qa_delete' => 'Verwijderen',
	'quickadmin_title' => 'City Map RC1',
];