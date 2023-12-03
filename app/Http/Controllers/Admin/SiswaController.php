<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Sekolah;
use App\Http\Requests\SiswaRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    private  $active = 'Master';
    private  $title = 'Siswa';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", Siswa::class);
        return view('admin.siswa.index', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "siswa_id",
            "sekolahs" => Sekolah::all()
        ]);
    }

    public function getData(Request $request)
    {
        $this->authorize("viewAny", Siswa::class);
        $data = Siswa::query();

        // Filter by school if the school is selected
        if ($request->filled('id_sekolah')) {
            // If a specific school is selected, filter by school ID
            $data->where('id_sekolah', $request->id_sekolah);
        }

        $datatables = DataTables::of($data);
		return $datatables
        ->addIndexColumn()
        ->addColumn('jenis_kelamin', function($data){
            $jenis_kelamin = "";
            if ($data->jenis_kelamin == 'Laki-laki') {
                $jenis_kelamin = '<span class="badge rounded-pill bg-label-primary">Laki-laki</span>';
            } elseif ($data->jenis_kelamin == 'Perempuan') {
                $jenis_kelamin = '<span class="badge rounded-pill bg-label-danger">Perempuan</span>';
            } 
            return $jenis_kelamin;
        })
        ->editColumn('sekolah', function($row) {
            return optional($row->sekolah)->nama_sekolah ?? 'No Sekolah';
        })
        ->addColumn('action', function($data){
            $actionBtn = "
            <a href='/admin/siswa/$data->id/edit' class='btn btn-icon btn-primary' title='edit data'><i class='tf-icons ti ti-edit'></i></a>
            <a href='javascript:void(0)' onclick='deleteData(\"{$data->id}\")' data-id='{$data->id}' class='btn btn-icon btn-danger' title='hapus data'><i class='tf-icons ti ti-trash'></i></a>
            ";
            return $actionBtn;
        })
        ->rawColumns(['jenis_kelamin', 'sekolah', 'action'])
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
    public function store(SiswaRequest $request)
    {
        // $this->authorize("create", Siswa::class);
        // $data = $request->validated();
        // $data = Siswa::updateOrCreate(
        //     ['id' => $request->id],
        //     [
        //         'id_user' => $datas['id_user'],
        //         'id_sekolah' => $datas['id_sekolah'],
        //         'nama' => $datas['nama'],
        //         'no_wa' => $datas['no_wa'],
        //         'tinggi_badan' => $datas['tinggi_badan'],
        //         'jenis_kelamin' => $datas['jenis_kelamin'],
        //     ]
        // );   
        // if($data){
        //     $response = array('success'=>1,'msg'=>'Berhasil menyimpan data pendidikan instansi');
        // }else{
        //     $response = array('success'=>2,'msg'=>'Gagal menyimpan data pendidikan instansi');
        // }
        // return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $this->authorize("view", $siswa);
        return view('admin.siswa.detail', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "siswa_id",
            "siswa" => $siswa,
            "sekolahs" => Sekolah::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $this->authorize("update", $siswa);
        return view('admin.siswa.edit', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "siswa_id",
            "siswa" => $siswa,
            "sekolahs" => Sekolah::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiswaRequest $request, Siswa $siswa)
    {
        $this->authorize("update", $siswa);
        $data = $request->validated();
        $siswa->update($data);
        return redirect()->route('admin.siswa.index')->with("success", "berhasil update siswa");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $this->authorize("delete", [$sekolah, Auth::user()]);
        $siswa->delete();
        if($siswa){
            $response = array('success'=>1,'msg'=>'Berhasil menghapus data siswa');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data siswa');
        }
        return $response;
    }
}
