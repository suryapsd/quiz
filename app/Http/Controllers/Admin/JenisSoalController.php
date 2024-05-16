<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\JenisSoal;
use App\Models\PendidikanInstansi;
use App\Models\Soal;
use App\Http\Requests\JenisSoalRequest;
use App\Http\Requests\SoalRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisSoalController extends Controller
{
    private  $active = 'Master';
    private  $title = 'Jenis Soal';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize("viewAny", JenisSoal::class);
        return view('admin.jenis_soal.index', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "JenisSoal_id",
            "pendidikan" => PendidikanInstansi::all()
        ]);
    }

    public function getData(Request $request)
    {
        // $this->authorize("viewAny", JenisSoal::class);
        $data = JenisSoal::withCount('soals')->get();

        $datatables = DataTables::of($data);
		return $datatables
        ->addIndexColumn()
        ->editColumn('pendidikan', function($row) {
            return optional($row->pendidikan_instansi)->nama_pendidikan ?? '-';
        })
        ->editColumn('keterangan', function($row) {
            return $row->keterangan ?? '-';
        })
        ->addColumn('action', function($data){
            $actionBtn = "
            <a href='/admin/jenis-soal/$data->id/edit' class='btn btn-icon btn-primary' title='edit data'><i class='tf-icons ti ti-edit'></i></a>
            <a href='javascript:void(0)' onclick='deleteData(\"{$data->id}\")' data-id='{$data->id}' class='btn btn-icon btn-danger' title='hapus data'><i class='tf-icons ti ti-trash'></i></a>
            ";
            return $actionBtn;
        })
        ->rawColumns(['keterangan','pendidikan','action'])
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
    public function store(JenisSoalRequest $request)
    {
        $this->authorize("create", JenisSoal::class);

        try {
            $datas = $request->validated();
            $data = JenisSoal::create([
                'nama_jenis_soal' => $datas['nama_jenis_soal'],
                'id_pendidikan_instansi' => $datas['id_pendidikan_instansi'],
                'jumlah_soal' => $datas['jumlah_soal'],
                'keterangan' => $datas['keterangan'],
            ]);

            for ($i = 0; $i < $datas['jumlah_soal']; $i++) {
                Soal::create([
                    "id_jenis_soal" => $data->id
                ]);
            }

            return response()->json(['success' => 1, 'msg' => 'Berhasil menyimpan data jenis soal.', 'id' => $data->id]);
        } catch (\Exception $e) {
            return response()->json(['success' => 2, 'msg' => 'Gagal menyimpan data jenis soal. ' . $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisSoal $jenisSoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisSoal $jenisSoal)
    {
        $this->authorize("update", $jenisSoal);
        $soal = Soal::where('id_jenis_soal', $jenisSoal->id)->get();
        return view('admin.jenis_soal.edit', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "JenisSoal_id",
            "jenis_soal" => $jenisSoal,
            "soal" => $soal,
            "pendidikan" => PendidikanInstansi::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisSoalRequest $request, JenisSoal $jenisSoal)
    {
        $this->authorize("update", $jenisSoal);
        try {
            $jumlah_soal = $jenisSoal->jumlah_soal;

            $jenisSoal->update([
                'nama_jenis_soal' => $request->nama_jenis_soal,
                'id_pendidikan_instansi' => $request->id_pendidikan_instansi,
                'keterangan' => $request->keterangan,
                'jumlah_soal' => $request->jumlah_soal,
            ]);

            if ($jumlah_soal < $request->jumlah_soal) {
                $new_jumlah_soal = $request->jumlah_soal - $jumlah_soal;
                for ($i = 0; $i < $new_jumlah_soal; $i++) {
                    Soal::create([
                        "id_jenis_soal" => $jenisSoal->id
                    ]);
                }
            } else {
                $new_jumlah_soal = $jumlah_soal - $request->jumlah_soal;
                $soalsToDelete = Soal::where('id_jenis_soal', $jenisSoal->id)
                    ->orderBy('id', 'desc')
                    ->take($new_jumlah_soal)
                    ->get();
    
                // Loop through and delete the selected records
                foreach ($soalsToDelete as $soal) {
                    $soal->delete();
                }
            }

            return redirect()->back()->with('success', 'Jenis soal berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisSoal $jenisSoal)
    {
        $this->authorize("delete", [$jenisSoal, Auth::user()]);
        // Hapus relasi di tabel Soal
        $jenisSoal->soals()->delete();
        // Hapus jenis soal itu sendiri
        $jenisSoal->delete();
        if($jenisSoal){
            $response = array('success'=>1,'msg'=>'Berhasil menghapus data jenis soal');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data jenis soal');
        }
        return $response;
    }
}
