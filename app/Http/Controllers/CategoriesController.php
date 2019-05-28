<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\newCategoryRequest;
use App\Http\Requests\updateCategoryRequest;
use App\ServiceType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $parents = array();
    private $patent_iteration_variable = array();
    public function index(Category $category)
    {
        hasPermission('show categories');
        $parent = $category->id ? $category->id : 0;
        $trashTrigger = 0;
        if($category->id){
            $this->parents[$category->id]=$category->name;
            $this->getTreeKeys($category->parent_id);
        }else{
            $category->name = 'categories';
        }
        $this->parents[0]=trans('categories\categories.Categories_title');
        $categories = Category::with(['image', 'service_type'])->where('parent_id', $parent)->get();
        return view('control_panel.categories.categories',compact('category','categories','parent','trashTrigger'))->with('parents',$this->parents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $categories)
    {
        hasPermission('create category');
        $parent = 0;
        $root_id = null;
        $parent_id = null ;
        $level = 0;
        $service_types = 0;
        if($categories->id){
            $parent = $categories->id;
            $parent_id = $categories->id;
            $level = $categories->level + 1;
            $this->parents[$categories->id]=$categories->name;
            $this->getTreeKeys($categories->parent_id);
            if(!$categories->root_id) {
                $root_id = $categories->id;
            }else{
                $root_id = $categories->root_id;
            }
        }
//        dd($level);
        if(!$level) {
            $service_types = ServiceType::all();
        }
$this->parents[0]=trans('categories\categories.Categories_title');        $category = new Category();
        $category->level = $level;
        return view('control_panel.categories.create',compact('category','parent','parent_id','service_types','root_id','level'))->with('parents',$this->parents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newCategoryRequest $request)
    {
        hasPermission('store category');
//        dd($request);
        $category = Category::create($request->only('service_type_id','level','description_en','description_ar','parent_id','root_id','name_en','name_ar'));
        if($category->parent_id) {
            $category->parent->update(['is_leaf' => 0]);
        }
        return redirect()->back()->with(['msg' => 'new category data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        hasPermission('edit category');
        $parent = $category->parent_id;
        $root_id = $category->root_id == 0 ? null : $category->root_id;
        $parent_id = $category->parent_id == 0 ? null : $category->parent_id;
        $level = $category->level;
        $this->parents[$category->id]=$category->name;
        $this->getTreeKeys($category->parent_id);
$this->parents[0]=trans('categories\categories.Categories_title');        $service_types = 0;
        $parent_choices = Category::with(['sons'=>function($query) use($category){
            $query->select('id','name','root_id','parent_id','is_leaf','level')->where('id','!=',$category->id)->withCount(['categories']);
        }])->find($root_id);
//        dd($parent_choices);
        if(!$level) {
            $service_types = ServiceType::withCount(['categories' => function ($query) use ($category) {
                $query->where('id', $category->id);
            }])->get();
        }
//        dd($category);
        return view('control_panel.categories.update',compact('category','parent','parent_id','service_types','root_id','level','parent_choices'))->with('parents',$this->parents);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(updateCategoryRequest $request, Category $category)
    {
        hasPermission('update category');
        $category->load(['parent.categories'=>function($query) use($category){
            $query->where('id','!=',$category->id);
        }]);
        if($request->parent_id!=$category->parent_id){
            if(!$category->parent->categories->count()){
                $category->parent->update(['is_leaf'=>1]);
            }
            $new_parent = Category::find($request->parent_id);
            $new_parent->update(['is_leaf'=>0]);
            $category->update(['level'=>$new_parent->level+1]);
        }
        $category->update($request->only('description_en','description_ar','parent_id','root_id','name_en','name_ar'));
        return redirect()->back()->with(['msg' => 'category data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        hasPermission('delete category');
        $category->load(['parent.categories'=>function($query) use($category){
            $query->where('id','!=',$category->id);
        }]);
        if($category->parent) {
            if (!$category->parent->categories->count()) {
                $category->parent->update(['is_leaf' => 1]);
            }
        }
        $category->delete();
        return redirect()->back()->with(['msg' => 'category data is deleted', 'type' => 'success']);
    }
    public function trashedCategories(Category $category)
    {
        hasPermission('show trashed categories');
        $trashTrigger = 1;
        $this->parents[0]=trans('categories\categories.Categories_title');
        $parent = $category->id ?? 0;
        if($category->id) {
            $this->parents[$category->id] = $category->name;
            $this->patent_iteration_variable = Category::find($category->parent_id);
        }
        $categories = Category::where('parent_id',$parent)->onlyTrashed()->get();
//        dd($parent);
        return view('control_panel.categories.categories',compact('category','categories','parent','trashTrigger'))->with('parents',$this->parents);

    }
    public function restoreCategories(Category $category){
        hasPermission('restore category');
        $category->restore();
        return redirect()->back()->with(['msg' => 'category data is restored', 'type' => 'success']);
    }
    protected function getTreeKeys($id){
        $this->patent_iteration_variable = Category::find($id);
        if($this->patent_iteration_variable) {
            for($i = 0;  ; $i++) {
                $this->parents[$this->patent_iteration_variable->id]=$this->patent_iteration_variable->name;
                if($this->patent_iteration_variable->root_id == 0){
                    break;
                }
                $this->patent_iteration_variable = Category::find($this->patent_iteration_variable->parent_id);
//                dd($this->parents,$this->patent_iteration_variable);
            }
        }
    }

}
