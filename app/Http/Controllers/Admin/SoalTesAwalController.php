<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SoalTesAwal;
use App\Http\Requests\SoalTesAwalRequest;
use Yajra\DataTables\DataTables;

class SoalTesAwalController extends Controller
{
    private  $active = 'Master';
    private  $title = 'Tes Awal';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", SoalTesAwal::class);
        return view('admin.tes_awal.index', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "tes_awal_id"
        ]);
    }

    public function getData(Request $request)
    {
        
        $data = SoalTesAwal::all();

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
        $this->authorize("create", SoalTesAwal::class);
        return view("admin.tes_awal.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SoalTesAwalRequest $request)
    {
        $this->authorize("create", SoalTesAwal::class);
        $data = $request->validated();
        SoalTesAwal::create($data);
        return redirect()->route("admin.tes_awal.index")->with("success", "berhasil membuat soal tes awal");
    }

    /**
     * Display the specified resource.
     */
    public function show(SoalTesAwal $soalTesAwal)
    {
        $this->authorize("view", $soalTesAwal);
        return view("admin.tes_awal.detail")->with("soal tes awal", $soalTesAwal);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SoalTesAwal $soalTesAwal)
    {
        $this->authorize("update", $soalTesAwal);
        return view('admin.tes_awal.edit')->with('soalTesAwal',$soalTesAwal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SoalTesAwalRequest $request, SoalTesAwal $soalTesAwal)
    {
        $this->authorize("update", $soalTesAwal);
        $data = $request->validated();
        $soalTesAwal->update($data);
        return redirect()->route('admin.tes_awal.index')->with("success", "berhasil update soal tes awal");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoalTesAwal $soalTesAwal)
    {
        $this->authorize("delete", SoalTesAwal::class);
        $soalTesAwal->delete();
        return redirect()->route('admin.tes_awal.index')->with('error', "berhasil menghapus soal tes awal");
    }
}
