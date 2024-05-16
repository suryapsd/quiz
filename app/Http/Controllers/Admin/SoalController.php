<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Soal;
use App\Models\JenisSoal;
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
        //
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
    public function store(Request $request)
    {
        $this->authorize("create", Soal::class);
        foreach ($request->inputs as $key => $item) {
            Soal::updateOrCreate(
                ['id' => $item['id_soal']],
                [
                    'soal' => $item['soal'],
                    'jawaban_a' => $item['jawaban_a'],
                    'jawaban_b' => $item['jawaban_b'],
                    'jawaban_c' => $item['jawaban_c'],
                    'jawaban_d' => $item['jawaban_d'],
                    'kunci_jawaban' => $item['kunci_jawaban'],
                ]
            );
        }
        return redirect()->route('admin.jenis-soal.index')->with("success", "Berhasil menimpan data soal");
    }

    /**
     * Display the specified resource.
     */
    public function show(Soal $soal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Soal $soal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Soal $soal)
    {
        $this->authorize("update", $soal);

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
        return redirect()->route('admin.soal.index')->with("success", "berhasil update soal");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Soal $soal)
    {
        $this->authorize("delete", [$soal, Auth::user()]);
        $jenis_soal = JenisSoal::find($soal->id_jenis_soal);
        $soal->delete();
        $count_soal = Soal::where('id_jenis_soal', $jenis_soal->id)->count();
        $jenis_soal->update([
            "jumlah_soal" => $count_soal
        ]);
        if($jenis_soal){
            $response = array('success'=>1,'msg'=>'Berhasil menghapus data soal');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data soal');
        }
        return $response;
    }
}
