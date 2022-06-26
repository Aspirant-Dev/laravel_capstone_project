<ul class="nav nav-tabs " id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active fw-bold" id="description-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab" aria-controls="description" aria-selected="true">Product Details</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link fw-bold" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link fw-bold" id="rating-tab" data-bs-toggle="tab" data-bs-target="#rating" type="button" role="tab" aria-controls="rating" aria-selected="false">Rating</button>
    </li>
</ul>

<div class="tab-content p-3" id="myTabContent">
    <div class="tab-pane fade show active " id="desc" role="tabpanel" aria-labelledby="description-tab">
        {!! $products->description !!}
    </div>
    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

    </div>
    <div class="tab-pane fade" id="rating" role="tabpanel" aria-labelledby="rating-tab">
        @if ($ratings->count() == 0 )
            <h4> <span> </span> No customer rate this product</h4>
        @elseif ($ratings->count() == 1)
            <h4>{{ $ratings->count() }} <span> </span> customer rate this product</h4>
        @else
            <h4>{{ $ratings->count() }} <span> </span> customers rate this product</h4>
        @endif
        <!-- Button trigger modal -->
        <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Rate this product
        </a>
    </div>
</div>
