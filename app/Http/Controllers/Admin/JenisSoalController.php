<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\JenisSoal;
use App\Models\PendidikanInstansi;
use App\Models\Soal;
use App\Http\Requests\JenisSoalRequest;
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
        $this->authorize("viewAny", JenisSoal::class);
        return view('admin.jenis_soal.index', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "JenisSoal_id"
        ]);
    }

    public function getData(Request $request)
    {
        $this->authorize("viewAny", JenisSoal::class);
        $data = JenisSoal::withCount('soals')->get();

        $datatables = DataTables::of($data);
		return $datatables
        ->addIndexColumn()
        ->editColumn('pendidikan', function($row) {
            return optional($row->pendidikan_instansi)->nama_pendidikan ?? '-';
        })
        ->editColumn('soal', function($row) {
            return $row->soals_count ?? '-';
        })
        ->addColumn('action', function($data){
            $actionBtn = "
            <a href='/admin/jenis-soal/$data->id/edit' class='btn btn-icon btn-primary' title='edit data'><i class='tf-icons ti ti-edit'></i></a>
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
        $this->authorize("create", JenisSoal::class);
        return view('admin.jenis_soal.create', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "JenisSoal_id",
            "pendidikan" => PendidikanInstansi::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->authorize("create", JenisSoal::class);
        try {
            // Validasi data input
            $request->validate([
                'nama_jenis_soal' => 'required|string',
                // 'id_pendidikan_instansi' => 'required|string',
                'inputs.*.soal' => 'required|string',
                'inputs.*.jawaban_a' => 'required|string',
                'inputs.*.jawaban_b' => 'required|string',
                'inputs.*.jawaban_c' => 'required|string',
                'inputs.*.jawaban_d' => 'required|string',
                'inputs.*.kunci_jawaban' => 'required|in:A,B,C,D',
            ]);

            // Simpan data soal
            $jenis_soal = JenisSoal::create([
                'id_pendidikan_instansi' => $request->input('id_pendidikan_instansi'),
                'keterangan' => $request->input('keterangan'),
                'nama_jenis_soal' => $request->input('nama_jenis_soal'),
            ]);
            $file = $request->file('inputs');

            // Simpan detail pertanyaan
            foreach ($request->inputs as $key => $item) {
                $soalData = [
                    'id_jenis_soal' => $jenis_soal->id,
                    'soal' => $item['soal'],
                    'jawaban_a' => $item['jawaban_a'],
                    'jawaban_b' => $item['jawaban_b'],
                    'jawaban_c' => $item['jawaban_c'],
                    'jawaban_d' => $item['jawaban_d'],
                    'kunci_jawaban' => $item['kunci_jawaban'],
                ];

                // if (isset($file[$key]['file_jawaban_a'])) {
                //     $fileName = $key.time() . '.' . $file[$key]['file_jawaban_a']->extension();
                //     $query = $file[$key]['file_jawaban_a']->move(public_path('upload/file_jawaban_a'), $fileName);
                //     $soalData['file_jawaban_a'] = $fileName;
                // }
            
                Soal::create($soalData);
            }

            return redirect()->route('admin.jenis-soal.index')->with('success', 'Soal berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangkap dan log pesan kesalahan
            \Log::error('Error during data storage: ' . $e->getMessage());

            // Redirect dengan pesan kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
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
    public function update(Request $request, JenisSoal $jenisSoal)
    {
        $this->authorize("update", $jenisSoal);
        try {
            $request->validate([
                'nama_jenis_soal' => 'required|string',
                // 'id_pendidikan_instansi' => 'required|string',
                'inputs.*.soal' => 'required|string',
                'inputs.*.jawaban_a' => 'required|string',
                'inputs.*.jawaban_b' => 'required|string',
                'inputs.*.jawaban_c' => 'required|string',
                'inputs.*.jawaban_d' => 'required|string',
                'inputs.*.kunci_jawaban' => 'required|in:A,B,C,D',
            ]);

            // Update data dari $request sesuai kolom yang sesuai di tabel
            $jenisSoal->update([
                'id_pendidikan_instansi' => $request->input('id_pendidikan_instansi'),
                'keterangan' => $request->input('keterangan'),
                'nama_jenis_soal' => $request->input('nama_jenis_soal'),
            ]);

            // Lakukan update untuk setiap pertanyaan (loop melalui inputs)
            foreach ($request->inputs as $key => $item) {
                Soal::updateOrCreate(
                    ['id' => $item['id_soal']],
                    [
                        'id_jenis_soal' => $jenisSoal->id,
                        'soal' => $item['soal'],
                        'jawaban_a' => $item['jawaban_a'],
                        'jawaban_b' => $item['jawaban_b'],
                        'jawaban_c' => $item['jawaban_c'],
                        'jawaban_d' => $item['jawaban_d'],
                        'kunci_jawaban' => $item['kunci_jawaban'],
                    ]
                );
            }

            return redirect()->route('admin.jenis-soal.index')->with('success', 'Soal berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangkap dan log pesan kesalahan
            \Log::error('Error during data storage: ' . $e->getMessage());

            // Redirect dengan pesan kesalahan
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
            $response = array('success'=>1,'msg'=>'Berhasil menyimpan data jenis soal');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menyimpan data jenis soal');
        }
        return $response;
    }
}
