<ul class="categories-list-slide-show">
    @foreach($categories2 as $category)
        <li>
        	<a href="{{ route('products.by_category', ['categoryId' => $category->id, 'categorySlug' => $category->slug]) }}">{{ $category->name }}</a>
        </li>
    @endforeach
</ul>
