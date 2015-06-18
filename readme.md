# Defencer

Defencer is a simple way to separate validations before method of repository.

## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require": {
        "ozziest/defencers": "dev-master",
    }
}
```

## Usage

```php 
try {
	UserRepository::insert('John Doe');
} catch (Exception $e) {
	echo $e->getMessage();
}
```

## Repository Definition

```php 
class UserRepository extends \Ozziest\Defencer\Defencer {

	/**
	 * Get Defencer
	 *
	 * @return Array
	 */	
	public function getDefencers()
	{
		return array(
				'insert' => array(
						'UserRepositoryValidation@name'
					)
			);
	}

	/**
	 * Insert 
	 *
	 * @param  string		$name 
	 * @return null
	 */
	public function _insert($name)
	{
		echo "Inserted: $name";
	}

}
```

```php 
class UserRepositoryValidation extends \Ozziest\Defencer\Validator {
	
	public $fields = array(
            'name', 'age'
        );

    /**
     * Name 
     * 
     * @throw Exception
     */
	public function name()
	{
		if ($this->name == '') {
			throw new \Exception('Name is required!');
		}
	}

}
```

## Licence

[MIT](http://opensource.org/licenses/MIT)



