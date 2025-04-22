<?php
namespace Modules\Categories\src\Http\Controllers;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Categories\src\Http\Requests\CategoryRequest;
use Modules\Categories\src\Repositories\CategoriesRepository;

class CategoriesController extends Controller {
    protected $categoryRepo;

    public function __construct(CategoriesRepository $categoryRepo) {
        $this->categoryRepo = $categoryRepo;
    }

    public function index(){
        $pageTitle = "Manager category";

        return view('categories::list', compact('pageTitle'));
    }
    public function data(){
        $categories = $this->categoryRepo->getCategories();

        $categories = DataTables::of($categories)
        // ->addColumn('edit', function($category) {
        //     return "<a class='btn btn-warning' href='".route('admin.categories.edit',$category)."'>Edit</a>";
        // })
        // ->addColumn('delete', function($category) {
        //     return '<a class="btn btn-danger delete-action" href="'.route('admin.categories.delete',$category).'" >Delete</a>';
        // })
        // ->addColumn('link', function($category) {
        //     return '<a class="btn btn-primary" href="" >See more</a>';
        // })
        // ->editColumn('created_at', function($category) {
        //     return Carbon::parse($category->created_at)->format('d/m/Y H:i:s');
        // })
        // ->rawColumns(['edit', 'delete','link'])
        ->toArray();

        $categories['data'] = $this->getCategoriesTable($categories['data']);

        return($categories);
    }

    public function getCategoriesTable($categories, $char = '', &$result = []) {
        if(!empty($categories)){
            foreach($categories as $category) {
                $row = $category;
                $row['name'] = $char.$category['name'];
                $row['edit'] = "<a class='btn btn-warning' href='".route('admin.categories.edit',$category['id'])."'>Edit</a>";
                $row['delete'] = '<a class="btn btn-danger delete-action" href="'.route('admin.categories.delete',$category['id']).'" >Delete</a>';
                $row['link'] = '<a class="btn btn-primary" href="" >See more</a>';
                $row['created_at'] = Carbon::parse($category['created_at'])->format('d/m/Y H:i:s');
                unset($row['sub_categories']);
                unset($row['updated_at']);
                $result[] = $row;
                if(!empty($category['sub_categories'])) {
                    $this->getCategoriesTable($category['sub_categories'], $char.'--',$result);
                }
            }
        }

        return $result;
    }



    public function create(){
        $pageTitle = "Create category";

        $categories = $this->categoryRepo->getAllCategories();
        return view('categories::add', compact('pageTitle', 'categories'));
    }
    public function store(CategoryRequest $request){

        $this->categoryRepo->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.categories.index')->with('msg',__('categories::messages.add.success'));
    }
    public function edit($id){
        $category = $this->categoryRepo->find($id);
        $pageTitle = "Edit category";

        if(!$category){
            abort(404);
        }

        $categories = $this->categoryRepo->getAllCategories();

        return view('categories::edit',compact('category','pageTitle','categories'));
    }
    public function update(CategoryRequest $request, $id){
        $data = $request->except('_token');

        $this->categoryRepo->update($data, $id);

        return back()->with('msg',__('categories::messages.update.success'));
    }
    public function delete($id){
        $this->categoryRepo->delete($id);
        return back()->with('msg',__('categories::messages.delete.success'));
    }
}
