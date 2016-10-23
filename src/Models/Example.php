<?php

namespace Papi\Models;

/**
 * Papi\Models\Example
 * Example model that interacts with and abstracts from the data source
 * Models should contain the abstraction layer to the data source.
 */
class Example
{
	/**
	 * getSomething()
	 * get something from data source
	 * @return array The data found in data source
	 */
    public function getSomething($id)
    {
		// get data from data source using id
		// this could be via PDO, ZEND DB or another api service

		// convert data to required format
		$data = ['Some', 'Data'];

        return $data;
    }

	/**
	 * editSomething()
	 * add something to data source
	 * @return mixed The id/thing you added if successfull, false on fail, empty array on fail, throw exception, whatever you want
	 */
    public function editSomething($something)
    {
		// add data to data source using id
		// this could be via PDO, ZEND DB or another api service

		// generate response
		$data = ['id' => 1, 'name' => 'Bob'];

        return $data;
    }

	/**
	 * addSomething()
	 * add something to data source
	 * @return mixed The id/thing you added if successfull, false on fail, empty array on fail, throw exception, whatever you want
	 */
    public function addSomething($something)
    {
		// add data to data source using id
		// this could be via PDO, ZEND DB or another api service

		// generate response
		$data = ['id' => 1, 'name' => 'Bob'];

        return $data;
    }

	/**
	 * deleteSomething()
	 * delete something from data source
	 * @return mixed The id/thing you deleted if successfull, false on fail, empty array on fail, throw exception, whatever you want
	 */
    public function deleteSomething($id)
    {
		// delete or flag as deleted on data source using id
		// this could be via PDO, ZEND DB or another api service

		// generate response
		$data = ['id' => 1, 'name' => 'Bob'];

        return $data;
    }
}
