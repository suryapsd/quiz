<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Http\Requests\SekolahRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SekolahController extends Controller
{
    private  $active = 'Master';
    private  $title = 'Sekolah';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", Sekolah::class);
        return view('admin.sekolah.index', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "sekolah_id"
        ]);
    }

    public function getData(Request $request)
    {
        $this->authorize("viewAny", Sekolah::class);
        $data = Sekolah::all();

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SekolahRequest $request)
    {
        $this->authorize("create", Sekolah::class);
        $datas = $request->validated();
        $data = Sekolah::updateOrCreate(
            ['id' => $request->id],
            [
                'nama_sekolah' => $datas['nama_sekolah'],
                'alamat' => $datas['alamat'],
                'keterangan' => $datas['keterangan'],
            ]
        );   
        if($data){
            $response = array('success'=>1,'msg'=>'Berhasil menyimpan data pendidikan instansi');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menyimpan data pendidikan instansi');
        }
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Sekolah $sekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sekolah $sekolah)
    {
        $this->authorize("update", $sekolah);
        return response()->json($sekolah);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SekolahRequest $request, Sekolah $sekolah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sekolah $sekolah)
    {
        $this->authorize("delete", [$sekolah, Auth::user()]);
        $sekolah->delete();
        if($sekolah){
            $response = array('success'=>1,'msg'=>'Berhasil menghapus data sekolah');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data sekolah');
        }
        return $response;
    }
}
