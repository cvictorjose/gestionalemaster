<?phpreturn [		'user-management' => [		'title' => 'User Management',		'created_at' => 'Time',		'fields' => [		],	],		'permissions' => [		'title' => 'Permissions',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',		],	],		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'permission' => 'Permissions',		],	],		'users' => [		'title' => 'Users',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'roles' => 'Roles',			'remember-token' => 'Remember token',		],	],	'labs' => [		'title' => 'Laboratorio',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',		],		'num_labs' => 'Numero di Laboratorio',		'det_labs' => 'Dettagli Laboratorio',	],	'round' => [		'title' => 'Round',		'created_at' => 'Time',		'fields' => [			'name' => 'Name'		],	],	'app_create' => 'Registra',	'app_save' => 'Salva',	'app_edit' => 'Modifica',	'app_view' => 'Dettagli',	'app_update' => 'Aggiorna',	'app_list' => 'Registra',	'app_no_entries_in_table' => 'Non ci sono records registrati',	'custom_controller_index' => 'Custom controller index.',	'app_logout' => 'Esci',	'app_add_new' => 'Aggiungi',	'app_are_you_sure' => 'Sei sicuro che vuoi eliminare?',	'app_back_to_list' => 'torna alla lista',	'app_dashboard' => 'Dashboard',	'app_delete' => 'Elimina',	'global_title' => 'Laboratorio Manager',];