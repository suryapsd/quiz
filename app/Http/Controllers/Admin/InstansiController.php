<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Http\Requests\InstansiRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstansiController extends Controller
{
    private  $active = 'Master';
    private  $title = 'Instansi';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", Instansi::class);
        return view('admin.instansi.index', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "instansi_id"
        ]);
    }

    public function getData(Request $request)
    {
        $this->authorize("viewAny", Instansi::class);
        $data = Instansi::all();

        $datatables = DataTables::of($data);
		return $datatables
        ->addIndexColumn()
        ->addColumn('action', function($data){
            $actionBtn = "
            <a href='/admin/instansi/$data->id/pendidikan-instansi' class='btn btn-icon btn-success' title='list pendidikan instansi'><i class='tf-icons ti ti-building-arch'></i></a>
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
    public function store(InstansiRequest $request)
    {
        $this->authorize("create", Instansi::class);
        $datas = $request->validated();
        $data = Instansi::updateOrCreate(
            ['id' => $request->id],
            [
                'nama_instansi' => $datas['nama_instansi'],
                'min_tinggi_badan' => $datas['min_tinggi_badan'],
            ]
        );   
        if($data){
            $response = array('success'=>1,'msg'=>'Berhasil menyimpan data instansi');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menyimpan data instansi');
        }
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Instansi $instansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instansi $instansi)
    {
        $this->authorize("update", $instansi);
        return response()->json($instansi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstansiRequest $request, Instansi $instansi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instansi $instansi)
    {
        $this->authorize("delete", [$instansi, Auth::user()]);
        $instansi->delete();
        if($instansi->save()){
            $response = array('success'=>1,'msg'=>'Berhasil menghapus data instansi');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data instansi');
        }
        return $response;
    }
}
