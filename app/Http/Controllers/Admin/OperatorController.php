<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Operator;
use App\Models\User;
use App\Http\Requests\OperatorRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OperatorController extends Controller
{
    private  $active = 'Master';
    private  $title = 'Operator';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.operator.index', [
            "active" => $this->active,
            "title" => $this->title,
            "table_id" => "operator_id"
        ]);
    }

    public function getData(Request $request)
    {
        $data = Operator::all();

        $datatables = DataTables::of($data);
		return $datatables
        ->addIndexColumn()
        ->editColumn('username', function($row) {
            return optional($row->user)->username ?? '-';
        })
        ->editColumn('email', function($row) {
            return optional($row->user)->email ?? '-';
        })
        ->addColumn('action', function($data){
            $actionBtn = "
            <a href='javascript:void(0)' data-id='{$data->id}'  class='btn btn-icon btn-primary editData' data-bs-toggle='tooltip' data-bs-placement='top' title='edit data'><i class='tf-icons ti ti-edit'></i></a>
            <a href='javascript:void(0)' onclick='deleteData(\"{$data->id}\")' data-id='{$data->id}' class='btn btn-icon btn-danger' data-bs-toggle='tooltip' data-bs-placement='top' title='hapus data'><i class='tf-icons ti ti-trash'></i></a>
            ";
            return $actionBtn;
        })
        ->rawColumns(['username','email','action'])
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
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'username' => 'required|unique:users,username,' . $request->id_user,
                'email' => 'required|email|unique:users,email,' . $request->id_user,
                'password' => 'required|min:8',
                'nama' => 'required',
                'no_telepon' => 'nullable|numeric',
                'alamat' => 'nullable',
            ], [
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah digunakan.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal harus 8 karakter.',
                'nama.required' => 'Nama wajib diisi.',
                'no_telepon.numeric' => 'Nomor telepon harus berupa angka.',
            ]);

            $datas = $request->only([
                'username',
                'email',
                'password',
                'nama',
                'no_telepon',
                'alamat',
            ]);

            $userData  = User::updateOrCreate(
                ['id' => $request->id_user],
                [
                    'username' => $datas['username'],
                    'email' => $datas['email'],
                    'role' => 'admin',
                    'password' => Hash::make($datas['password']),
                ]
            );
            
            $operator = Operator::updateOrCreate(
                ['id' => $request->id_operator],
                [
                    'id_user' => $userData->id,
                    'nama' => $datas['nama'],
                    'no_telepon' => $datas['no_telepon'],
                    'alamat' => $datas['alamat'],
                ]
            );

            DB::commit();
            return response()->json(['success'=>1,'msg'=>'Berhasil menyimpan data operator']);
        } catch (\Exception $exception) {
            // Batalkan transaksi jika terjadi kesalahan
            DB::rollBack();
            // Cek apakah exception adalah instance dari ValidationException
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                $validationErrors = $exception->errors();
                return response()->json(['success' => 2, 'msg' => 'Gagal menyimpan data operator.', 'errors' => $validationErrors], 422);
            }
            return response()->json(['success' => 2, 'msg' => 'Gagal menyimpan data operator.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $operator = Operator::with('user')->find($id);
        return response()->json($operator);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $operator = Operator::find($id);
        if ($operator) {
            $operator->delete();
            User::where('id', $operator->id_user)->delete();
            $response = ['success' => 1, 'msg' => 'Berhasil menghapus data operator'];
        } else {
            $response = ['success' => 2, 'msg' => 'Data operator tidak ditemukan'];
        }
    
        return $response;
    }
}
