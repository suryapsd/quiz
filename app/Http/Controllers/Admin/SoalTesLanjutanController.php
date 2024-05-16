<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SoalTesLanjutan;
use App\Models\PendidikanInstansi;
use Illuminate\Http\Request;
use App\Http\Requests\SoalTesLanjutanRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SoalTesLanjutanController extends Controller
{
    private  $active = 'Master';
    private  $title = 'Soal Tes Lanjutan';

    /**
     * Display a listing of the resource.
     */
    public function listPendidikanInstansi()
    {
        return view('admin.soal_lanjutan.index', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "pendidikan_soal_id",
        ]);
    }

    public function getData(Request $request)
    {
        $data = PendidikanInstansi::withCount('soalTesLanjutans')->get();

        $datatables = DataTables::of($data);
		return $datatables
        ->addIndexColumn()
        ->editColumn('instansi', function($row) {
            return  optional($row->instansi)->nama_instansi ?? '-';
        })
        ->editColumn('jumlah_soal', function($row) {
            return optional($row)->soal_tes_lanjutans_count ?? '-';
        })
        ->addColumn('action', function($data){
            $actionBtn = "
                <a href='/admin/soal-lanjutan/$data->id/tambah-soal' class='btn btn-primary' data-bs-toggle='tooltip' data-bs-placement='top' title='tambah soal'>Tambah Soal</a>
                ";
            return $actionBtn;
        })
        ->rawColumns(['instansi', 'jumlah_soal','action'])
        ->make(true);
    }

    public function index($id_pendidikan_instansi)
    {
        return view('admin.soal_lanjutan.list_soal', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "soal_lanjutan_id",
            "pendidikan" => PendidikanInstansi::find($id_pendidikan_instansi),
            "id_pendidikan_instansi" => $id_pendidikan_instansi
        ]);
    }

    public function getDataSoal(Request $request, $id_pendidikan_instansi)
    {
        $data = SoalTesLanjutan::where('id_pendidikan_instansi', $id_pendidikan_instansi)->get();

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
            <a href='/admin/soal-lanjutan/{$data->id_pendidikan_instansi}/tambah-soal/{$data->id}/edit' data-id='{$data->id}'  class='btn btn-icon btn-primary editData' data-bs-toggle='tooltip' data-bs-placement='top' title='edit data'><i class='tf-icons ti ti-edit'></i></a>
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
    public function create($id_pendidikan_instansi)
    {
        return view('admin.soal_lanjutan.add', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "soal_lanjutan_id",
            "pendidikan" => PendidikanInstansi::find($id_pendidikan_instansi),
            "id_pendidikan_instansi" => $id_pendidikan_instansi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id_pendidikan_instansi, SoalTesLanjutanRequest $request)
    {
        $datas = $request->validated();
        SoalTesLanjutan::create(
            [
                'id_pendidikan_instansi' => $id_pendidikan_instansi,
                'soal' => $datas['soal'],
                'jawaban_a' => $datas['jawaban_a'],
                'jawaban_b' => $datas['jawaban_b'],
                'jawaban_c' => $datas['jawaban_c'],
                'jawaban_d' => $datas['jawaban_d'],
                'kunci_jawaban' => $datas['kunci_jawaban'],
            ]
        );
        return redirect('admin/soal-lanjutan/' . $id_pendidikan_instansi  . '/tambah-soal')->with("success", "Berhasil menyimpan data soal tes lanjutan");
    }

    /**
     * Display the specified resource.
     */
    public function show(SoalTesLanjutan $soalTesLanjutan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_pendidikan_instansi, $id)
    {   
        $pendidikan = PendidikanInstansi::find($id_pendidikan_instansi);
        $soalTesLanjutan = SoalTesLanjutan::find($id);
        return view('admin.soal_lanjutan.edit', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "SoalAwalan_id",
            "id_pendidikan_instansi" => $id_pendidikan_instansi,
            "pendidikan" => $pendidikan,
            "soal" => $soalTesLanjutan
        ]);
    }
    
    // public function jumlahSoal(Request $request, $id)
    // {
    //     $soal_count = SoalTesLanjutan::where('id_pendidikan_instansi', $id)->count();
    //     if ($soal_count < $request->jumlah_soal) {
    //         $new_jumlah_soal = $request->jumlah_soal - $soal_count;
    //         for ($i = 0; $i < $new_jumlah_soal; $i++) {
    //             SoalTesLanjutan::create([
    //                 "id_pendidikan_instansi" => $id
    //             ]);
    //         }
    //     } else {
    //         $new_jumlah_soal = $soal_count - $request->jumlah_soal;
    //         $soalsToDelete = SoalTesLanjutan::where('id_pendidikan_instansi', $id)
    //             ->orderBy('id', 'desc')
    //             ->take($new_jumlah_soal)
    //             ->get();

    //         // Loop through and delete the selected records
    //         foreach ($soalsToDelete as $soal) {
    //             $soal->delete();
    //         }
    //     }
        
    //     return redirect()->back()->with("success", "berhasil update soal tes lanjutan");
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update($id_pendidikan_instansi, SoalTesLanjutanRequest $request, $id)
    {
        $datas = $request->validated();
        $soalTesLanjutan = SoalTesLanjutan::find($id);
        $soalTesLanjutan->update(
            [
                'soal' => $datas['soal'],
                'jawaban_a' => $datas['jawaban_a'],
                'jawaban_b' => $datas['jawaban_b'],
                'jawaban_c' => $datas['jawaban_c'],
                'jawaban_d' => $datas['jawaban_d'],
                'kunci_jawaban' => $datas['kunci_jawaban'],
            ]
        );
        return redirect('admin/soal-lanjutan/' . $id_pendidikan_instansi  . '/tambah-soal')->with("success", "berhasil update soal tes lanjutan");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_pendidikan_instansi, $id)
    {
        $soalTesLanjutan = SoalTesLanjutan::find($id);
        $soalTesLanjutan->delete();
        if($soalTesLanjutan){
            $response = array('success'=>1,'msg'=>'Berhasil menghapus data soal tes lanjutan');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data soal tes lanjutan');
        }
        return $response;
    }
}
