<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\LunchboxPrototype;
use App\Models\IngredientRecipe;

class Recipe extends LunchboxPrototype
{
    use HasFactory;

    /**
     * The array with nested arrays of the child components data.
     * To merge data from ingredients table (nutrients) and pivot table (quantity) 
     *
     * @var array
     */
    protected $components;

    /**
     * Return the array with nested arrays of the child components data
     *
     * @return array;
     */
    public function getComponents() {
        if ($this->components) {
            return $this->components;
        } else {
            return $this->mergeComponentsDataFromDB(); 
            // записывает значение в $this->components и возвращает его
        }
        
    }
    
    /**
     * Set the array with nested arrays of the child components data
     *
     * @param integer $ingredientId
     * @param array $variables
     * @return array
     */
    public function setComponents($ingredientId, $variables) {
        $this->components[$ingredientId] = $variables;
    } 


    /**
     * Relation many to many with igredients
     *
     */
    public function ingredients() {
        return $this->belongsToMany(Ingredient::class);
    }

    /**
     * Return quantity value of each component as an array 
     * where key is ingredient_id and value is quantity of an ingredient in the recipe
     * 
     * @return array
     * 
     */
    public function getQuantityOfComponents() {
        $components = IngredientRecipe::where('recipe_id', $this->id)->get();
        $quantity = [];
        foreach ($components as $component) {
            $quantity[$component->ingredient_id] = $component->quantity;
        }
        return $quantity;
    }

    /**
     * Return nutrients values of each ingredient as an array
     * where key is ingredient_id and value is nutrient values of an ingredient as an array
     * where key is a field name and value is a value of the field
     * 
     * @return array
     */
    public function getNutrientsOfIngredients() {
        $nutrients = [];
        foreach ($this->ingredients as $ingredient) {
            $k = $this->countable;
            $k[] = 'name'; //давай сразу имя ингредиента получим тоже
            $k[] = 'id';   //и id
            foreach ($k as $nutrient) {
                $variables[($nutrient !== 'name' && $nutrient !== 'id') ? $nutrient.$this->nutPostfix : $nutrient] = $ingredient->{$nutrient};
            }
            $nutrients[$ingredient->id] = $variables;
        }
        return $nutrients;
    }

    /**
     * Set component property 
     * merging quantity from pivot table and nutrients from ingredient table
     * and return it
     * 
     */
    protected function mergeComponentsDataFromDB() {
        $quantity = $this->getQuantityOfComponents();
        $nutrients = $this->getNutrientsOfIngredients();

        foreach ($nutrients as $ingredientId => $variables) {
            $add = $quantity[$ingredientId];
            $variables['quantity'] = $add;
            $this->components[$ingredientId] = $variables;
        }
        return $this->components;
    }

    /**
     * Calculate quantity of each nutrient in all components based on quantity of component and nutrition data of ingredients
     */
    public function calcNutQuantity() {
        foreach ($this->countable as $nutrient ) {
            foreach ($this->components as &$component ) {
                $component[$nutrient] = $component[$nutrient.$this->nutPostfix]*$component['quantity']/100;
                
            }
        }

        return $this->components;
    }

    /**
     * To summarize nutrients and ccal by each field
     * 
     */
    public function sumNutrients() {
        $sums = [];
        $k = $this->countable;
        $k[] = 'quantity'; //сразу общее количество посчитаем тоже
        foreach ($k as $nutrient) {
            $n_column = array_column($this->components, $nutrient);
            $n_sum = array_sum($n_column);
            $sums[$nutrient] = $n_sum;
        }

        return $sums;
    }

    /**
     * To add the row with sums of the each nutrient to components 
     */
    public function addSumRowIntoComponents() {
        $sums = $this->sumNutrients();
        $sums['name'] = 'total';
        $this->components[] = $sums;
        return $this->components;
    }

    /**
     * To calculate the whole array for passing to a view in a single row
     */

    public function calculateTheRecipe() {
        $this->getComponents(); // merges data from ingredients and pivot tables, but if it has done already, the function does not
        $this->calcNutQuantity();
        $this->addSumRowIntoComponents();
        return $this->components;
    }



    public function calcNutSumAndUpdateDB($notSaveDB = 0) { // монстроузная функция, вряд ли я буду ее поддерживать, а следовательно использовать ее нежелательно
        $nutrients = $this->countable; //массив с названиями полей, которые нутриенты, их мы будем суммировать
        
        $ingredients = $this->ingredients; //ингредиенты в рецепте
        
        $componentsCollection = IngredientRecipe::where('recipe_id', $this->id)->get(); //записи в пивот таблице        

        foreach ($nutrients as $nutrient) {
            $sum[$nutrient] = 0;
            foreach ($ingredients as $ingredient) {
                $n_value = $ingredient->{$nutrient};
                foreach ($componentsCollection as $component) {
                    if ($component->ingredient_id === $ingredient->id) {
                        $quantity = $component->quantity;
                        $q_nutrient = $n_value*$quantity/100;//получили кол-во нутриента в компоненте рецепта
                        //теперь надо записать его в модель компонента
                        $component->{$nutrient} = $q_nutrient;
                        if (!$notSaveDB) {
                            $component->save();//сохраняем нутриенты компонентов в пивот-таблицу
                        }
                        //теперь надо записать сумму
                        $sum[$nutrient] += $q_nutrient;
                    }
                }
            }
            //получили массив с суммами нутриентов
            //теперь надо записать сумму в свойство рецепта
            $this->{$nutrient} = $sum[$nutrient];
            //dd($this->{$nutrient});
            $property = $this->{$nutrient};
            echo "Рецепт $this->name содержит $property нутриента $nutrient <br>";
            if (!$notSaveDB) {
                $this->save(); //сохраняем строку с суммами нутриентов в таблицу рецептов
            }
        }
    }


}
