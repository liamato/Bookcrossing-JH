<?php

namespace App\Composers;

use Illuminate\View\View;
use App\School;

class CurrentSchoolComposer
{
	public function compose(View $view)
	{
		$view->with('school', \App::make(School::class));
	}

}