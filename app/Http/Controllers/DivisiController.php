<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\DataDivisi;
use App\Helpers\EncryptionHelper;

class DivisiController extends Controller
{
    public function divisi()
    {
        // $pegawai = Pegawai::select('pegawai.*','divisi.nama as nama_divisi')->join('divisi','divisi.id','=','pegawai.id_divisi')->get();
        // return $pegawai;
        $data = [
            'divisi' => Divisi::all()
        ];
        return view('divisi',$data);
    }

    public function get_datatables_divisi(Request $request)
    {
        $divisi = new DataDivisi();

        $start = $request->input('start') + 1;
        $list = [];
        $data = $divisi->get_datatables_divisi($request);

        foreach ($data as $item) {
            $row = [];
            $row[] = $start++;
            $row[] = $item->nama;
            // $row[] = $item->divisi->nama;
                $edit ="<a class = 'btn btn-primary mr-1' href='".url('editdivisi/'.EncryptionHelper::encrypt_str($item->id))."'> Edit </a>";
                $delete ="<a class='btn btn-danger mr-1' onclick='return confirm(\"Hapus Divisi $item->nama ?\")' href='".url('deletedivisi/'.EncryptionHelper::encrypt_str($item->id))."'>Delete</a>";
            $row[] = $edit.$delete;
            $list[] = $row;
        }

        $output = [
            "draw" => $request->input('draw'),
            "recordsTotal" => $divisi->count_all(),
            "recordsFiltered" => $divisi->count_filtered($request),
            "data" => $list,
        ];

        return response()->json($output);
    }

    public function tambahdivisi()
    {
        $divisi = Divisi::all();
        return view('tambah_divisi',);

    }

    public function storedivisi(Request $request)
    {
        $nama = $request->input('nama');
        $id_divisi = $request->input('id_divisi');

        $divisi = new Divisi;

        $divisi->nama = $nama;
        // $pegawai->jk = $jk;
        // $pegawai->id_divisi = $id_divisi;
        $divisi->save();
        return redirect('/')->with('success', 'Divisi berhasil ditambahkan');

    }
    function editdivisi($id_divisi)
    {
        $id_divisi_decrypted = EncryptionHelper::decrypt_str($id_divisi);
        if (!$id_divisi_decrypted) {
            return "parameter tidak valid";
        }
        $divisi = Divisi::find($id_divisi_decrypted);
        if (!$divisi) {
            return "Divisi tidak ditemukan!";
        }
        $data = [
            'divisi' => $divisi
        ];
        $divisi = Divisi::all();

        return view('edit_divisi',);
    }

    function updatedivisi(Request $request)
    {
        $id_divisi = $request->input('id_divisi');
        $nama = $request->input('nama');
        $id_divisi_decrypted = EncryptionHelper::decrypt_str($id_divisi);
        if (!$id_divisi_decrypted) {
            return "parameter tidak valid";
        }
        $divisi = Divisi::find($id_divisi_decrypted);
        if (!$divisi) {
            return "Divisi tidak ditemukan!";
        }
        $divisi->nama = $nama;
        $divisi->save();

        return redirect('/divisi')->with('success', 'Data Divisi berhasil diperbarui');
    }

    function deletedivisi($id_divisi){
        $id_divisi_decrypted = EncryptionHelper::decrypt_str($id_divisi);
        if (!$id_divisi_decrypted) {
            return "parameter tidak valid";
        }
        // return $id_pegawai_decrypted;
        $divisi = Divisi::find($id_divisi_decrypted);
        if (!$divisi) {
            return "Divisi tidak ditemukan!";
        }
        $divisi->delete();
        return redirect('/divisi') ->with('success', 'Data Divisi berhasil dihapus');
    }


}

