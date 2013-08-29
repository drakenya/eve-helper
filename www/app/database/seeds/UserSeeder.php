<?php

class UserSeeder extends DatabaseSeeder
{

	public function run()
	{
		$users = [
			[
				'username' => 'drakenya',
				'password' => Hash::make('password'),
				'email'    => 'drakenya@example.com',
			],
		];

		foreach ($users as $user)
		{
			User::create($user);
		}
	}

}
