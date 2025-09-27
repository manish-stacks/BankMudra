<div class="card-container">
    <div class="card border bg-transparent p-2 h-100" style="margin: 0 10px;">
        <div class="rounded-top overflow-hidden">
            <div class="card-overlay-hover position-relative">
                <a href="{{ url('/papers/' . $paper->slug) }}">
                    <img src="{{ url($paper->thumb) }}" class="card-img-top" alt="course image" style="object-fit: cover;">
                </a>
               <span class="badge position-absolute top-0 start-0 m-2">
            @if($paper->ispaid === 2)
                <span class="badge bg-info fs-6 p-1">75% off</span>
            @else
                <span class="badge bg-success fs-6 p-1">Free</span>
            @endif
        </span>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ url('/papers/' . $paper->slug) }}" class="text-decoration-none">
                <h5 class="card-title" style="text-transform: uppercase;">{{ $paper->name }}</h5>
            </a>
            <div class="d-flex justify-content-between">
                <div><i class="far fa-clock text-danger me-2"></i>{{ $paper->duration }} Min</div>
                <div><i class="fas fa-question-circle text-orange me-2"></i>{{ $paper->totalNoQuestion }} Questions</div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2 mt-4">
               <div class="d-flex align-items-center">
                    @if($paper->cost == 0)
                        <h5 class="text-success mb-0 fw-bold me-2">₹ Free</h5>
                    @else
                        <h5 class="text-success mb-0 fw-bold me-2">₹ {{ $paper->cost }}</h5>
                        <span class="fw-bold text-dark" style="text-decoration: line-through;">₹ 1599</span>
                    @endif
                </div>
                <a href="javascript:void(0)" class="btn btn-success mb-0" onclick="buyCourse({{ $paper->id }}, {{ $paper->cost }})">
                    <i class="fas fa-shopping-cart"></i> Buy Now
                </a>
            </div>
        </div>
    </div>
</div>
