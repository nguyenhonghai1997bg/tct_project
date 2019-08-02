<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Review\ReviewRepositoryInterface;

class ProductController extends Controller
{
    protected $productRepository;
    protected $reviewRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ReviewRepositoryInterface $reviewRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $product = $this->productRepository->with('images')->findOrFail($id);
            $reviews = $product->reviews()->orderBy('id', 'DESC')->paginate(4, ['*'], 'page_review');

            return view('products.review', compact('reviews'));
        }

        $product = $this->productRepository->with('images')->findOrFail($id);
        $product->update(['view' => $product->view + 1]);
        $moreProducts = $this->productRepository->moreProduct($id, $product->price, $product->category_id);
        $reviews = $product->reviews()->orderBy('id', 'DESC')->paginate(4, ['*'], 'page_review');
        $countReview = $this->reviewRepository->where('product_id', $id)->count();
        $avg = ceil(\App\Review::where('product_id', $product->id)->avg('rating'));

        return view('detail_product', compact('product', 'moreProducts', 'reviews', 'countReview', 'avg'));
    }

    public function search(Request $request)
    {
        $products = $this->productRepository->userSearch($request->key, $request->category_id)->paginate(\App\Product::PERPAGE);
        $maxPrice = \App\Product::max('price');

        return view('search_products', compact('products', 'maxPrice'));
    }

    public function searchByPrice(Request $request)
    {
        $maxPrice = \App\Product::active()->max('price');
        $to = $request->to ?? $maxPrice;
        $from = $request->from ?? 0;
        $products = $this->productRepository->userSearchByPrice($request->key, $request->category_id, $from, $to);

        return view('products.search', compact('products', 'maxPrice'));
    }

    public function listSale()
    {
        $maxPrice = \App\Product::active()->max('price');
        $to = $request->to ?? $maxPrice;
        $from = $request->from ?? 0;
        $products = \App\Product::active()->whereNotNull('sale_id')->with('sale')->paginate(\App\Product::PERPAGE);
        
        return view('products.search', compact('products', 'maxPrice'));
    }

    public function allTopSale()
    {
        $maxPrice = \App\Product::active()->max('price');
        $to = $request->to ?? $maxPrice;
        $from = $request->from ?? 0;
        $products = $this->productRepository->allTopSale();

        return view('products.search', compact('products', 'maxPrice'));
    }

    public function allTopOrder()
    {
        $maxPrice = \App\Product::active()->max('price');
        $to = $request->to ?? $maxPrice;
        $from = $request->from ?? 0;
        $products = $this->productRepository->allTopOrder();

        return view('products.search', compact('products', 'maxPrice'));
    }
}
