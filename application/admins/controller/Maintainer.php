<?php


namespace app\admins\controller;


class Maintainer extends Base
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return view('maintainer/index');
	}

}