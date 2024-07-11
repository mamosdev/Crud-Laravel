<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Divisi;


class DataDivisi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'divisi';
    protected $quarted = [];
    protected $fillable = [
    ];

    protected $column_order = [null, 'nama']; // Kolom yang dapat diurutkan
    protected $column_search = ['nama']; // Kolom yang dapat dicari
    protected $order = ['id' => 'asc']; // Urutan default

    private function _get_datatables_query(Request $request)
    {
        $query = Divisi::select('*');

        if ($request->input('search.value')) {
            $searchValue = $request->input('search.value');
            $query->where(function($q) use ($searchValue) {
                foreach ($this->column_search as $i => $item) {
                    if ($i == 0) {
                        $q->where($item, 'like', "%{$searchValue}%");
                    } else {
                        $q->orWhere($item, 'like', "%{$searchValue}%");
                    }
                }
            });
        }

        if ($request->input('order.0.column')) {
            $orderColumn = $this->column_order[$request->input('order.0.column')];
            $orderDir = $request->input('order.0.dir');
            $query->orderBy($orderColumn, $orderDir);
        } else if ($this->order) {
            foreach ($this->order as $key => $value) {
                $query->orderBy($key, $value);
            }
        }

        return $query;
    }

    public function get_datatables_divisi(Request $request)
    {
        $query = $this->_get_datatables_query($request);
        if ($request->input('length') != -1) {
            $query->limit($request->input('length'))->offset($request->input('start'));
        }
        return $query->get();
    }

    public function count_filtered(Request $request)
    {
        $query = $this->_get_datatables_query($request);
        return $query->count();
    }

    public function count_all()
    {
        return Divisi::count();
    }
}