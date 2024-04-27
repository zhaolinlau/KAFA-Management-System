<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$users = [
			[
				'name' => 'Admin Lau',
				'email' => 'admin@gmail.com',
				'role' => 'admin',
				'password' => bcrypt('qweasdzxc'),
				'email_verified_at' => '2024-03-21 17:07:11'
			],
			[
				'name' => 'Teacher Lau',
				'email' => 'teacher@gmail.com',
				'role' => 'teacher',
				'password' => bcrypt('qweasdzxc'),
				'email_verified_at' => '2024-03-21 17:07:11'
			],
			[
				'name' => 'Parent Lau',
				'email' => 'parent@gmail.com',
				'password' => bcrypt('qweasdzxc'),
				'email_verified_at' => '2024-03-21 17:07:11'
			]
		];

		foreach ($users as $user) {
			User::create($user);
		}
	}
}
