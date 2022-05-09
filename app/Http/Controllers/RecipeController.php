<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return 'список рецептов';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('create-recipe-form', compact('ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_array = $request->post();
        //сначала создаем запись в таблице рецептов
        //получаем id свежесозданного рецепта
        //создаем записи в пивот-таблице со ссылкой на рецепт и на ингредиенты
        foreach ($post_array as $key => $value) {
            if (($key !== 'ingredients') && ($key !== '_token')) {
                $recipe_array[$key] = $value; 
            }
        }
        $recipe_array['ccal'] = 0;
        $recipe_array['proteins'] = 0;
        $recipe_array['fats'] = 0;
        $recipe_array['carbs'] = 0;
        $recipe = Recipe::create($recipe_array);
        foreach ($post_array['ingredients'] as $ingredient_id => $quantity) {
            if ($quantity) {
                $recipe->ingredients()->attach($ingredient_id, ['quantity' => $quantity]);
            }
            
        }
        $recipe->calcNutSum();
        return $recipe->name.' успешно добавлен в базу данных';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {   
        return view('components.recipe-table', ['recipe' => $recipe->calculateTheRecipe()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        //
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function updateRecipe(Recipe $recipe)
    {

        return view('update-recipe-form', [
            'recipe' => $recipe->calculateTheRecipe(),
            'recipe_id' => $recipe->id,
            'recipe_name' => $recipe->name
        ]);
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        dd($request->post());
        return view('update-recipe-form', [
            'recipe' => $recipe->calculateTheRecipe(),
            'recipe_id' => $recipe->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        //
    }
}
