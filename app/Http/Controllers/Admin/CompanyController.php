<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;

class CompanyController extends Controller
{
    protected $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }
    /**
     * show all Catalogs
     * @return view
     */
    public function index()
    {
        $company = $this->company->first();

        return view('admin.companies.index', compact('company'));
    }

    public function destroy($id)
    {
        $company = $this->company->destroy($id);

        return redirect()->route('companies.index')->with('status', 'Xóa thành công');
    }

    public function edit(int $id)
    {
        $company = $this->company->first();

        return view('admin.companies.edit', compact('company'));
    }

    public function update(StoreCompanyRequest $request, $id)
    {
        $data = $request->all();
        $company = $this->company->find($id);
        $company->update($data);

        return redirect()->back()->with('status', 'Sửa thành công');
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        $data = $request->all();
        $this->company->create($data);

        return redirect()->back()->with('status', 'Thêm thành công');
    }
}
