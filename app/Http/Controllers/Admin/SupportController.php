<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();

        return view('admin/supports/index', compact('supports'));
    }

    public function show(string | int $id){
        if(!$support = Support::find($id)){
            return redirect()->back();
        };
        return view('admin/supports/show', compact('support'));
    }

    public function create(){
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupport $request, Support $support){
        $data = $request->all();
        $data ['status'] = 'a';

        $support->create($data);
        return redirect()->route('supports.index');
    }

    public function edit(Support $support, string | int $id){
        if(!$support = $support->where('id',$id)->first()){
            return redirect()->back();
        }
        return view('admin/supports.edit', compact('support'));
    }

    public function update(StoreUpdateSupport $request, Support $support, string | int $id){
        if(!$support = $support->find($id)){
            return redirect()->back();
        }
        $support->update($request->only([
            'subject',
            'body'
        ]));
        return redirect()->route('supports.index');
    }

    public function destroy(Support $support, string | int $id){
        if(!$support = $support->find($id)){
            return redirect()->back();
        }
        $support->delete();
        return redirect()->route('supports.index');
    }
}
