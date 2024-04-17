<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\CreateSupportDto;
use App\DTO\Supports\UpdateSupportDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service
    )
    {

    }
    public function index(Request $request)
    {
        $supports = $this->service->paginate(
            page: $request->get("page",1),
            totalPerPage: $request->get('per_page',3),
            filter: $request->filter,

        );

        $filters = ['filter' => $request->get('filter', '')];

        return view('admin/supports/index', compact('supports', 'filters'));
    }

    public function show(string  $id){
        if(!$support = $this->service->findOne($id)){
            return redirect()->back();
        };
        return view('admin/supports/show', compact('support'));
    }

    public function create(){
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupport $request, Support $support){
       $this->service->new(CreateSupportDto::makeFromRequest($request));
        return redirect()->route('supports.index');
    }

    public function edit(string $id){
        if(!$support = $this->service->findOne($id)){
            return redirect()->back();
        }
        return view('admin/supports.edit', compact('support'));
    }

    public function update(StoreUpdateSupport $request, Support $support, string | int $id){
        $support = $this->service->update(UpdateSupportDto::makeFromRequest($request));
        if(!$support){
            return redirect()->back();
        }

        return redirect()->route('supports.index');
    }

    public function destroy(string $id){
        $this->service->delete($id);
        return redirect()->route('supports.index');
    }
}
