<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
	
	/**
      * The database table used by the model.
      * @var string
      */
	protected $table = 'customers';

	 /**
      * The key used by the model.
      * @var string
      */
	protected $primaryKey = 'customer_id';

	protected $fillable = [
		'firsname',
		'lastname',
		'email',
		'phone',
		'password',
		'nationality',
		'birthday',
		'gender',
		'customer_type_id'
		];

}