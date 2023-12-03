<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\PendidikanInstansi;
use App\Http\Requests\PendidikanInstansiRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendidikanInstansiController extends Controller
{
    private  $active = 'Master';
    private  $title = 'Pendidikan Instansi';

    /**
     * Display a listing of the resource.
     */
    public function index($id_instansi)
    {
        $this->authorize("viewAny", PendidikanInstansi::class);
        return view('admin.pendidikan_instansi.index', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "pendidikan_instansi_id",
            "instansi" => Instansi::find($id_instansi),
        ]);
    }

    public function getData(Request $request, $id_instansi)
    {
        $this->authorize("viewAny", PendidikanInstansi::class);
        $data = PendidikanInstansi::where('id_instansi', $id_instansi)->get();

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
    public function store(PendidikanInstansiRequest $request, $id_instansi)
    {
        $this->authorize("create", PendidikanInstansi::class);
        $datas = $request->validated();
        $data = PendidikanInstansi::updateOrCreate(
            ['id' => $request->id],
            [
                'id_instansi' => $id_instansi,
                'nama_pendidikan' => $datas['nama_pendidikan'],
                'min_tinggi_badan' => $datas['min_tinggi_badan'],
                'min_nilai_tes_lanjutan' => $datas['min_nilai_tes_lanjutan'],
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
    public function show(PendidikanInstansi $pendidikanInstansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_instansi, PendidikanInstansi $pendidikanInstansi)
    {
        $this->authorize("update", $pendidikanInstansi);
        return response()->json($pendidikanInstansi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PendidikanInstansiRequest $request, PendidikanInstansi $pendidikanInstansi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_instansi, PendidikanInstansi $pendidikanInstansi)
    {
        $this->authorize("delete", [$pendidikanInstansi, Auth::user()]);
        $pendidikanInstansi->delete();
        if($pendidikanInstansi){
            $response = array('success'=>1,'msg'=>'Berhasil menghapus data pendidikan instansi');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data pendidikan instansi');
        }
        return $response;
    }
}
