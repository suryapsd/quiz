<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SoalTesLanjutan;
use App\Http\Requests\SoalTesLanjutanRequest;
use Yajra\DataTables\DataTables;

class SoalTesLanjutanController extends Controller
{
    private  $active = 'Master';
    private  $title = 'Tes Lanjutan';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", SoalTesLanjutan::class);
        return view('admin.tes_lanjutan.index', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "tes_lanjutan_id"
        ]);
    }

    public function getData(Request $request)
    {
        
        $data = SoalTesLanjutan::all();

        $datatables = DataTables::of($data);
		return $datatables
        ->addIndexColumn()
        ->addColumn('action', function($data){
            $actionBtn = "
            <a href='javascript:void(0)' data-id='{$data->id}'  class='btn btn-icon btn-primary editData' title='edit data'><span class='tf-icons bx bx-edit-alt'></span></a>
            <a href='javascript:void(0)' onclick='deleteData(\"{$data->id}\")' data-id='{$data->id}' class='btn btn-icon btn-danger' title='hapus data'><span class='tf-icons bx bx-trash'></span></a>
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
        $this->authorize("create", SoalTesLanjutan::class);
        return view("admin.tes_lanjutan.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SoalTesLanjutanRequest $request)
    {
        $this->authorize("create", SoalTesLanjutan::class);
        $data = $request->validated();
        SoalTesLanjutan::create($data);
        return redirect()->route("admin.tes_lanjutan.index")->with("success", "berhasil membuat soal tes lanjutan");
    }

    /**
     * Display the specified resource.
     */
    public function show(SoalTesLanjutan $soalTesLanjutan)
    {
        $this->authorize("view", $soalTesLanjutan);
        return view("admin.tes_lanjutan.detail")->with("soalTesLanjutan", $soalTesLanjutan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SoalTesLanjutan $soalTesLanjutan)
    {
        $this->authorize("update", $soalTesLanjutan);
        return view('admin.tes_lanjutan.edit')->with('soalTesLanjutan',$soalTesLanjutan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SoalTesLanjutanRequest $request, SoalTesLanjutan $soalTesLanjutan)
    {
        $this->authorize("update", $soalTesLanjutan);
        $data = $request->validated();
        $soalTesLanjutan->update($data);
        return redirect()->route('admin.tes_lanjutan.index')->with("success", "berhasil update soal tes lanjutan");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoalTesLanjutan $soalTesLanjutan)
    {
        $this->authorize("delete", SoalTesLanjutan::class);
        $soalTesLanjutan->delete();
        return redirect()->route('admin.tes_lanjutan.index')->with('error', "berhasil menghapus soal tes lanjutan");
    }
}
