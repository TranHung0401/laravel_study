<?php
namespace Modules\Courses\src\Http\Controllers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Courses\src\Http\Requests\CoursesRequest;
use Modules\Courses\src\Repositories\CoursesRepository;

class CoursesController extends Controller 
{
    protected $coursesRepo;

    public function __construct(CoursesRepository $coursesRepo) {
        $this->coursesRepo = $coursesRepo;
    }

    public function index() {
        $pageTitle = "Manager courses";

        // $users = $this->userRepo->getUser(5);

        return view('courses::list', compact('pageTitle'));
    }   

    public function data() {
        $courses = $this->coursesRepo->getAllCourses();
        $data = DataTables::of($courses)
        ->addColumn('edit', function($courses) {
            return "<a class='btn btn-warning' href='".route('admin.courses.edit',$courses)."'>Edit</a>";
        })
        ->addColumn('delete', function($courses) {
            return '<a class="btn btn-danger delete-action" href="'.route('admin.courses.delete',$courses).'" >Delete</a>';
        })
        ->editColumn('created_at', function($courses) {
            return Carbon::parse($courses->created_at)->format('d/m/Y H:i:s');
        })
        ->rawColumns(['edit', 'delete'])
        ->toJson();

        return $data;
    }
    
    public function create() {
        $pageTitle = "Create courses";
        return view('courses::add', compact('pageTitle'));
    } 

    public function store(CoursesRequest $request) {
        
    }

    public function edit($id) {

        $course = $this->coursesRepo->find($id);
        $pageTitle = "Edit course";

        if(!$course){
            abort(404);
        }

        return view('courses::edit',compact('course','pageTitle'));

    }

    public function update(CoursesRequest $request,$id) {
        // if(!empty($request->password)){
        //     $password = bcrypt($request->password);
        // }
        $data = $request->except('_token','password');

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $this->courseRepo->update($data, $id);

        return back()->with('msg',__('course::messages.update.success'));
    }

    public function delete($id) {
        $this->courseRepo->delete($id);
        return back()->with('msg',__('course::messages.delete.success'));
    }
}