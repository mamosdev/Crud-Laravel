<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Divisi;
use App\Models\Data_pegawai;
use App\Helpers\EncryptionHelper;
use App\Exports\PegawaiExport;
use App\Imports\PegawaiImport;
use Maatwebsite\Excel\Facades\Excel;


class HomeController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::select('pegawai.*','divisi.nama as nama_divisi')->join('divisi','divisi.id','=','pegawai.id_divisi')->get();
        // return $pegawai;
        $data = [
            'pegawai' => $pegawai,
            'divisi' => Divisi::all()
        ];
        return view('dashboard',$data);
    }

    public function get_datatables(Request $request)
    {
        $pegawai = new Data_pegawai();

        $start = $request->input('start') + 1;
        $list = [];
        $data = $pegawai->get_datatables($request);

        foreach ($data as $item) {
            $row = [];
            $row[] = $start++; //No
            $row[] = $item->nama; //nama pegawai
            $row[] = $item->jk; //jenis kelamin
            $row[] = $item->divisi->nama??'None'; //divisi
                $edit ="<a class = 'btn btn-primary mr-1' href='".url('editpegawai/'.EncryptionHelper::encrypt_str($item->id))."'> Edit </a>";
                $delete ="<a class='btn btn-danger mr-1' onclick='return confirm(\"Hapus Pegawai $item->nama ?\")' href='".url('delete/'.EncryptionHelper::encrypt_str($item->id))."'>Delete</a>";
            $row[] = $edit.$delete; //aksi
            $list[] = $row; //tampilkan
        }

        $output = [
            "draw" => $request->input('draw'),
            "recordsTotal" => $pegawai->count_all(),
            "recordsFiltered" => $pegawai->count_filtered($request),
            "data" => $list,
        ];

        return response()->json($output);
    }

    public function tambahpegawai()
    {
        $divisi = Divisi::all();
        return view('tambahpegawai', compact('divisi'));

    }

    public function store(Request $request)
    {
        $nama = $request->input('nama');
        $jk = $request->input('jk');
        $id_divisi = $request->input('id_divisi');


        $pegawai = new Pegawai;
        $pegawai->nama = $nama;
        $pegawai->jk = $jk;
        $pegawai->id_divisi = $id_divisi;


        $pegawai->save();
        return redirect('/')->with('success', 'Pegawai berhasil ditambahkan');

    }
    function edit($id_pegawai)
    {
        $id_pegawai_decrypted = EncryptionHelper::decrypt_str($id_pegawai);
        if (!$id_pegawai_decrypted) {
            return "parameter tidak valid";
        }
        $pegawai = Pegawai::find($id_pegawai_decrypted);
        if (!$pegawai) {
            return "pegawai tidak ditemukan!";
        }
        $data = [
            'pegawai' => $pegawai
        ];
        $pegawai = Pegawai::find($id_pegawai_decrypted);
        $divisi = Divisi::all();

        return view('editpegawai', compact('pegawai', 'divisi'));
    }

    function update(Request $request)
    {
        $id_pegawai = $request->input('id_pegawai');
        $nama = $request->input('nama');
        $jk = $request->input('jk');
        $id_pegawai_decrypted = EncryptionHelper::decrypt_str($id_pegawai);
        if (!$id_pegawai_decrypted) {
            return "parameter tidak valid";
        }
        $pegawai = Pegawai::find($id_pegawai_decrypted);
        if (!$pegawai) {
            return "pegawai tidak ditemukan!";
        }
        $pegawai->nama = $nama;
        $pegawai->jk = $jk;
        $pegawai->save();

        return redirect('/')->with('success', 'Data pegawai berhasil diperbarui');
    }
    function delete($id_pegawai){
        $id_pegawai_decrypted = EncryptionHelper::decrypt_str($id_pegawai);
        if (!$id_pegawai_decrypted) {
            return "parameter tidak valid";
        }
        // return $id_pegawai_decrypted;
        $pegawai = Pegawai::find($id_pegawai_decrypted);
        if (!$pegawai) {
            return "pegawai tidak ditemukan!";
        }
        $pegawai->delete();
        return redirect('/') ->with('success', 'Data pegawai berhasil dihapus');
    }

    public function export() 
    {
        return Excel::download(new PegawaiExport, 'Pegawai.xlsx');
    }

    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);
        Excel::import(new PegawaiImport, $request->file('file'));
        return redirect()->url('Pegawai')->with('success', 'Pegawai imported successfully.');
    
    }
    public function importpegawai()
    {
        $pegawai = Pegawai::all();
        return view('importpegawai',);

    }

}

