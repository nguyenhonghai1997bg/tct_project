<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Traits\FileUploadTrait;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    use FileUploadTrait;
    protected $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }
    /**
     * show all Catalogs
     * @return view
     */
    public function index()
    {
        $listNews = $this->news->paginate(10);

        return view('admin.news.index', compact('listNews'));
    }

    public function destroy($id)
    {
        $news = $this->news->findOrFail($id);
        $newsImg = $this->removeFile(public_path('images/news/' . $news->image));
        $news->destroy($id);

        return redirect()->route('news.index')->with('status', 'Xóa thành công');
    }

    public function edit(int $id)
    {
        $news = $this->news->first();

        return view('admin.news.edit', compact('news'));
    }

    public function update(UpdateNewsRequest $request, $id)
    {
        $data = $request->all();
        if($request->image) {
            $newsImg = $this->saveFile($request->image, 'news');
            $data['image'] = $newsImg;
        }
        $data['slug'] = \Str::slug($data['title'], '-');
        $news = $this->news->find($id);
        $news->update($data);

        return redirect()->back()->with('status', 'Sửa thành công');
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(StoreNewsRequest $request)
    {
        $data = $request->all();
        $newsImg = $this->saveFile($request->image, 'news');
        $data['image'] = $newsImg;
        $data['slug'] = \Str::slug($data['title'], '-');
        $this->news->create($data);

        return redirect()->back()->with('status', 'Thêm thành công');
    }
}
