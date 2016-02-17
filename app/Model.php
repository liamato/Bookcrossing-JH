<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent {

	protected $relationship = [];

	public function getRelationship()
	{
		return $this->relationship;
	}

	public function relations()
	{
		return array_keys($this->relationship);
	}

	public function loads($with)
	{
		if (is_string($with)) {
            $with = func_get_args();
        }

		$with = array_diff($this->relations(), array_diff($this->relations(), $with));
		foreach ($with as $relation) {
			$relation = $this->getRelationship()[$relation];
			if (!in_array($relation, $this->getHidden()) && !empty($relation)) {
				$this->addHidden($relation);
			}
		}
		return $this->load($with);
	}

	public function isEmpty()
	{
		return empty($this->original) && !$this->isDirty();
	}


}