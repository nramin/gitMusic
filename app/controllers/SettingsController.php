<?php

class SettingsController extends BaseController {

	public function showSettings()
	{
		return View::make('settings');
	}
}