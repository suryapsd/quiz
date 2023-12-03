<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Soal;
use App\Http\Requests\StoreSoalRequest;
use App\Http\Requests\UpdateSoalRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoalController extends Controller
{
    private  $active = 'Master';
    private  $title = 'Soal';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", Soal::class);
        return view('admin.soal.index', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "Soal_id"
        ]);
    }

    public function getData(Request $request)
    {
        
        $data = Soal::all();

        $datatables = DataTables::of($data);
		return $datatables
        ->addIndexColumn()
        ->addColumn('action', function($data){
            $actionBtn = "
            <a href='javascript:void(0)' data-id='{$data->id}'  class='btn btn-icon btn-primary editData' title='edit data'><i class='tf-icons ti ti-edit'></i></a>
            <a href='javascript:void(0)' onclick='deleteData(\"{$data->id}\")' data-id='{$data->id}' class='btn btn-icon btn-danger' title='hapus data'><i class='tf-icons ti ti-trash'></i></a>
            ";
            return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Soal::class);
        return view("admin.soal.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SoalRequest $request)
    {
        $this->authorize("create", Soal::class);
        $data = $request->validated();
        Soal::create($data);
        return redirect()->route("admin.soal.index")->with("success", "berhasil membuat soal");
    }

    /**
     * Display the specified resource.
     */
    public function show(Soal $soal)
    {
        $this->authorize("view", $soal);
        return view("admin.soal.detail")->with("soal", $soal);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Soal $soal)
    {
        $this->authorize("update", $soal);
        return view('admin.soal.edit')->with('Soal',$soal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SoalRequest $request, Soal $soal)
    {
        $this->authorize("update", $soal);
        $data = $request->validated();
        $soal->update($data);
        return redirect()->route('admin.soal.index')->with("success", "berhasil update soal");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Soal $soal)
    {
        $this->authorize("delete", Soal::class);
        $soal->delete();
        return redirect()->route('admin.soal.index')->with('error', "berhasil menghapus soal");
    }
}
