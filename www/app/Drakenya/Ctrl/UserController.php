<?php

namespace Drakenya\Ctrl;

use Illuminate\Support\MessageBag;

class UserController extends \Controller
{

	public function loginAction()
	{
		$errors = new MessageBag();

		if ($old = \Input::old('errors'))
		{
			$errors = $old;
		}

		$data = [
			'errors' => $errors,
		];

		return \View::make('auth/login', $data);
	}

	public function loginProcessAction()
	{
		$validator = Validator::make(Input::all(), [
			'username' => 'required',
			'password' => 'required',
		]);

		if ($validator->passes())
		{
			$credentials = [
				'username' => Input::get('username'),
				'password' => Input::get('password'),
			];

			if (Auth::attempt($credentials))
			{
				return Redirect::route('user/profile');
			}
		}

		$data['errors'] = new MessageBag([
			'password' => ['Username and/or password invalid.'],
		]);

		$data['username'] = Input::get('username');

		return Redirect::route('auth/login')->withInput($data);
	}

	public function requestAction()
	{
		$data = [
			'requested' => Input::old('requested'),
		];

		if (Input::server('REQUEST_METHOD') == 'POST')
		{
			$validator = Validator::make(Input::all(), [
				'email' => 'required',
			]);

			if ($validator->passes()) {
				$credentials = [
					'email' => Input::get('email'),
				];

				Password::remind($credentials,
					function ($message, $user)
					{
						$message->from('chris@example.com');
					}
				);

				$data['requested'] = true;

				return Redirect::route('auth/request')->withInput($data);
			}
		}

		return View::make('auth/request', $data);
	}

	public function resetAction()
	{
		$token = '?token=' . Input::get('token');

		$errors = new MessageBag();

		if ($old = Input::old('errors'))
		{
			$errors = $old;
		}

		$data = [
			'token' => $token,
			'errors' => $errors,
		];

		if (Input::server('REQUEST_METHOD') == 'POST')
		{
			$validator = Validator::make(Input::all(), [
				'email' => 'required|email',
				'password' => 'required:min:6',
				'password_confirmation' => 'same:password',
				'token' => 'exists:token,token',
			]);

			if ($validator->passes()) {
				$credentials = [
					'email' => Input::get('email'),
				];

				Password::reset($credentials,
					function ($user, $password)
					{
						$user->password = Hash::make($password);
						$user->save();

						Auth::login($user);

						return Redirect::route('user/profile');
					}
				);
			}

			$data['email'] = Input::get('email');
			$data['errors'] = $validator->errors();

			return Redirect::to(URL::route('auth/reset') . $token)->withInput($data);
		}

		return View::make('auth/reset', $data);
	}

	public function profileAction()
	{
		$keyId = '2535925';
		$vCode = 'U27kS5TWI8Qb2V1oJYhaEGgcX6lxWyf3DRAZuFmFc0f865xtwBydJKvrJvLYkRXQ';
		$pheal = App::make('pheal', [$keyId, $vCode, 'char']);


		$newResponse = $pheal->AccountBalance(['characterId' => '2044783304']);
		$response = $pheal->serverScope->ServerStatus();

		$data = [
			'pheal_response' => $response,
			'character' => $newResponse,
		];

		return View::make('user/profile', $data);
	}

	public function logoutAction()
	{
		Auth::logout();
		return Redirect::route('auth/login');
	}
}
