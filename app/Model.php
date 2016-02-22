<?php

namespace App;

use App;
use DB;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Http\Exception\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

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

	public function filledOrFail()
	{

		$msg = sprintf('The "%s" Model must be filled.', static::class);

		if ($this->isEmpty()) {
			if (App::make('request')->ajax() || App::make('request')->wantsJson()) {
				throw new HttpResponseException(new JsonResponse([$msg],422));
			}
			throw new HttpResponseException(new Response($msg,422));
		}
		return true;
	}

	static public function getColumns()
    {
        switch (DB::connection()->getConfig('driver')) {
            case 'pgsql':
                $query = "SELECT column_name FROM information_schema.columns WHERE table_name = '".$this->getTable()."'";
                $column_name = 'column_name';
                $reverse = true;
                break;

            case 'mysql':
                $query = 'SHOW COLUMNS FROM '.(new static)->getTable();
                $column_name = 'Field';
                $reverse = false;
                break;

            case 'sqlsrv':
                $parts = explode('.', $this->getTable());
                $num = (count($parts) - 1);
                $table = $parts[$num];
                $query = "SELECT column_name FROM ".DB::connection()->getConfig('database').".INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'".$table."'";
                $column_name = 'column_name';
                $reverse = false;
                break;

            default:
                $error = 'Database driver not supported: '.DB::connection()->getConfig('driver');
                throw new Exception($error);
                break;
        }

        $columns = array();

        foreach(DB::select($query) as $column)
        {
            $columns[] = $column->$column_name;
        }

        if($reverse)
        {
            $columns = array_reverse($columns);
        }

        return $columns;
    }

    static public function filterColumns($columns)
    {
        if (is_string($columns)) {
            $columns = func_get_args();
        }
        return array_diff(static::getColumns(), array_diff(static::getColumns(), $columns));
    }
}
