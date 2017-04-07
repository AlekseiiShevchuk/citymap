<?php

return [
		'user-management' => [		'title' => 'User Management',		'created_at' => 'Time',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',		],	],
		'languages' => [		'title' => 'Languages',		'created_at' => 'Time',		'fields' => [			'abbreviation' => 'Abbreviation',			'name' => 'Name',			'is-active-for-admin' => 'Is active for admin',			'is-active-for-users' => 'Is active for users',		],	],
		'cities' => [		'title' => 'Cities',		'created_at' => 'Time',		'fields' => [			'name-en' => 'Name (in English)',			'population' => 'Population',			'year-of-foundation' => 'Year of foundation',			'latitude' => 'Latitude',			'longitude' => 'Longitude',			'cities-to-go' => 'Cities to go',		],	],
		'localized-city-data' => [		'title' => 'Localized city data',		'created_at' => 'Time',		'fields' => [			'city' => 'City',			'language' => 'Language',			'name' => 'Localized Name',			'description' => 'Localized Description',		],	],
		'players' => [		'title' => 'Players',		'created_at' => 'Time',		'fields' => [			'device-id' => 'Device id',			'nickname' => 'Nickname',			'language' => 'Language',		],	],
		'city-steps' => [		'title' => 'City steps',		'created_at' => 'Time',		'fields' => [			'by-player' => 'By player',			'to-city' => 'To city',		],	],
		'transfer-settings' => [		'title' => 'Transfer settings',		'created_at' => 'Time',		'fields' => [			'is-possible-by-train' => 'Is possible to get city by train',			'price-by-train' => 'Price by train',			'is-possible-by-plane' => 'Is possible to get city by plane',			'price-by-plane' => 'Price by plane',			'is-possible-by-car' => 'Is possible to get city by car',			'price-by-car' => 'Price by car',		],	],
		'city-transfer' => [		'title' => 'City transfer',		'created_at' => 'Time',		'fields' => [			'city-start' => 'City start',			'city-end' => 'City end',			'points' => 'Points',			'settings' => 'Settings',		],	],
		'sea-zone' => [		'title' => 'Sea zone',		'created_at' => 'Time',		'fields' => [			'start-point-latitude' => 'Start point latitude',			'start-point-longitude' => 'Start point longitude',			'end-point-lalitude' => 'End point lalitude',			'end-point-longitude' => 'End point longitude',			'city-transfer' => 'City transfer',		],	],
	'qa_create' => 'Create',
	'qa_save' => 'Save',
	'qa_edit' => 'Edit',
	'qa_view' => 'View',
	'qa_update' => 'Update',
	'qa_list' => 'List',
	'qa_no_entries_in_table' => 'No entries in table',
	'custom_controller_index' => 'Custom controller index.',
	'qa_logout' => 'Logout',
	'qa_add_new' => 'Add new',
	'qa_are_you_sure' => 'Are you sure?',
	'qa_back_to_list' => 'Back to list',
	'qa_dashboard' => 'Dashboard',
	'qa_delete' => 'Delete',
	'quickadmin_title' => 'City Map RC1',
];