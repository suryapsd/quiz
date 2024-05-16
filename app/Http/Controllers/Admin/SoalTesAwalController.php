<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SoalTesAwal;
use App\Models\Instansi;
use Illuminate\Http\Request;
use App\Http\Requests\SoalTesAwalRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SoalTesAwalController extends Controller
{
    private  $active = 'Master';
    private  $title = 'Soal Tes Awal';

    /**
     * Display a listing of the resource.
     */
    public function listInstansi()
    {
        return view('admin.soal_awalan.index', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "instansi_soal_id",
        ]);
    }

    public function getData(Request $request)
    {
        $data = Instansi::withCount('soalTesAwals')->get();

        $datatables = DataTables::of($data);
		return $datatables
        ->addIndexColumn()
        ->editColumn('jumlah_soal', function($row) {
            return optional($row)->soal_tes_awals_count ?? '-';
        })
        ->addColumn('action', function($data){
            $actionBtn = "
                <a href='/admin/soal-awalan/$data->id/tambah-soal' class='btn btn-primary' data-bs-toggle='tooltip' data-bs-placement='top' title='tambah soal'>Tambah Soal</a>
                ";
            return $actionBtn;
        })
        ->rawColumns(['jumlah_soal','action'])
        ->make(true);
    }

    public function index($id_instansi)
    {
        return view('admin.soal_awalan.list_soal', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "soal_awalan_id",
            "instansi" => Instansi::find($id_instansi),
            "id_instansi" => $id_instansi
        ]);
    }

    public function getDataSoal(Request $request, $id_instansi)
    {
        $data = SoalTesAwal::where('id_instansi', $id_instansi)->get();

        $datatables = DataTables::of($data);
		return $datatables
        ->addIndexColumn()
        ->editColumn('soal', function($row) {
            $soal = optional($row)->soal ?? '-';
            preg_match_all('/<img.+?src=["\'](.+?)["\'].*?>/i', $soal, $matches);
            // // $matches[1] contains an array of image URLs
            // $imageUrls = $matches[1] ?? [];

            // // Create image tags for each URL
            // $imageTags = array_map(function ($url) {
            //     return "<img src=\"$url\" alt=\"\" style=\"width: 50px;\">";
            // }, $imageUrls);
            return  $soal;
        })
        ->addColumn('action', function($data){
            $actionBtn = "
            <a href='/admin/soal-awalan/{$data->id_instansi}/tambah-soal/{$data->id}/edit' data-id='{$data->id}'  class='btn btn-icon btn-primary editData' data-bs-toggle='tooltip' data-bs-placement='top' title='edit data'><i class='tf-icons ti ti-edit'></i></a>
            <a href='javascript:void(0)' onclick='deleteData(\"{$data->id}\")' data-id='{$data->id}' class='btn btn-icon btn-danger' data-bs-toggle='tooltip' data-bs-placement='top' title='hapus data'><i class='tf-icons ti ti-trash'></i></a>
            ";
            return $actionBtn;
        })
        ->rawColumns(['soal','action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_instansi)
    {
        return view('admin.soal_awalan.add', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "soal_awalan_id",
            "instansi" => Instansi::find($id_instansi),
            "id_instansi" => $id_instansi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id_instansi, SoalTesAwalRequest $request)
    {
        $datas = $request->validated();
        SoalTesAwal::create(
            [
                'id_instansi' => $id_instansi,
                'soal' => $datas['soal'],
                'jawaban_a' => $datas['jawaban_a'],
                'jawaban_b' => $datas['jawaban_b'],
                'jawaban_c' => $datas['jawaban_c'],
                'jawaban_d' => $datas['jawaban_d'],
                'kunci_jawaban' => $datas['kunci_jawaban'],
            ]
        );
        return redirect('admin/soal-awalan/' . $id_instansi  . '/tambah-soal')->with("success", "Berhasil menyimpan data soal tes awalan");
    }

    /**
     * Display the specified resource.
     */
    public function show(SoalTesAwal $soalTesAwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_instansi, $id)
    {   
        $instansi = Instansi::find($id_instansi);
        $soalTesAwal = SoalTesAwal::find($id);
        return view('admin.soal_awalan.edit', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "SoalAwalan_id",
            "id_instansi" => $id_instansi,
            "instansi" => $instansi,
            "soal" => $soalTesAwal
        ]);
    }
    
    // public function jumlahSoal(Request $request, $id)
    // {
    //     $soal_count = SoalTesAwal::where('id_instansi', $id)->count();
    //     if ($soal_count < $request->jumlah_soal) {
    //         $new_jumlah_soal = $request->jumlah_soal - $soal_count;
    //         for ($i = 0; $i < $new_jumlah_soal; $i++) {
    //             SoalTesAwal::create([
    //                 "id_instansi" => $id
    //             ]);
    //         }
    //     } else {
    //         $new_jumlah_soal = $soal_count - $request->jumlah_soal;
    //         $soalsToDelete = SoalTesAwal::where('id_instansi', $id)
    //             ->orderBy('id', 'desc')
    //             ->take($new_jumlah_soal)
    //             ->get();

    //         // Loop through and delete the selected records
    //         foreach ($soalsToDelete as $soal) {
    //             $soal->delete();
    //         }
    //     }
        
    //     return redirect()->back()->with("success", "berhasil update soal tes awalan");
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update($id_instansi, SoalTesAwalRequest $request, $id)
    {
        $datas = $request->validated();
        $soalTesAwal = SoalTesAwal::find($id);
        $soalTesAwal->update(
            [
                'soal' => $datas['soal'],
                'jawaban_a' => $datas['jawaban_a'],
                'jawaban_b' => $datas['jawaban_b'],
                'jawaban_c' => $datas['jawaban_c'],
                'jawaban_d' => $datas['jawaban_d'],
                'kunci_jawaban' => $datas['kunci_jawaban'],
            ]
        );
        return redirect('admin/soal-awalan/' . $id_instansi  . '/tambah-soal')->with("success", "berhasil update soal tes awalan");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_instansi, $id)
    {
        $soalTesAwal = SoalTesAwal::find($id);
        $soalTesAwal->delete();
        if($soalTesAwal){
            $response = array('success'=>1,'msg'=>'Berhasil menghapus data soal tes awalan');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data soal tes awalan');
        }
        return $response;
    }
}
