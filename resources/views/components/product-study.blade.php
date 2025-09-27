<div class="col-sm-6 col-xl-4">
    <div class="card p-2 border">
        <div class="rounded-top overflow-hidden">
            <div class="card-overlay-hover">
               <img src="{{ asset(@$product->thumbnailImage->external_link) }}" 
                class="card-img-top" 
                style="width: 600px; height: 300px; object-fit: cover;" 
                alt="{{ $product->name }}" />

            </div>
            <!-- Hover element -->
            <div class="card-img-overlay">
                <div class="card-element-hover d-flex justify-content-end">
                    <a href="#" class="icon-md bg-white rounded-circle text-center">
                        <i class="fas fa-shopping-cart text-danger"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            
            <!-- Title -->
            <h5 class="card-title">
                <a href="{{ route('study-materials.details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
            </h5>

            <!-- Badge and Price -->
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">

                    @if (checkDiscount($product))
                        <!-- Check if discount is applicable -->
                        <div class="me-2 text-nowrap">
                            <h6 class="text-success mb-0 fw-bold">₹ {{ $product->offer_price }}</h6>
                        </div>
                        <div>
                            <span class="fw-bold text-dark text-nowrap" style="text-decoration: line-through;">₹
                                {{ $product->price }}</span>
                        </div>
                    @else
                        <span class="text-dark mb-0 fw-bold">₹ {{ $product->price }}</span>
                    @endif

                </div>
                <form class="shopping-cart-form">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input name="qty" type="hidden" min="1" max="100" value="1" />
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                </form>

            </div>


        </div>
    </div>
</div>
