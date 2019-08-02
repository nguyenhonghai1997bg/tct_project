<ul class="categories-list-slide-show">
    @foreach($categories2 as $category)
        <li><a href="#">{{ $category->name }}</a></li>
    @endforeach
</ul>
