<?php


class Menu
{
	public $meals;
	
	function __construct()
	{
		$this->meals = $this->getMeals();
	}

	public function getMeals()
	{
		require('models/Meal.php');
		$meal1 = new Meal(7, 'fr');
		$meal2 = new Meal(8, 'fr');
		$meal3 = new Meal(9, 'fr');
		$meal4 = new Meal(10, 'fr');
		$meal5 = new Meal(11, 'fr');
		$meal6 = new Meal(12, 'fr');
		
		return [$meal1, $meal2, $meal3, $meal4, $meal5, $meal6];
	}
}