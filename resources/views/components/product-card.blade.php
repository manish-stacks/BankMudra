<div class="col-12 col-sm-6 col-xl-4 mb-4">
    <div class="card shadow h-100">
        <a href="{{ url('/papers/' . $paper->slug) }}">
    <img src="{{ asset($paper->thumb) }}" class="card-img-top" alt="course image"  
        style="width: 600px; height: 400px; object-fit: cover; display: block;">
</a>

        <span class="badge position-absolute top-0 start-0 m-2">
            @if($paper->ispaid === 2)
                <span class="badge bg-info fs-6 p-1">75% off</span>
            @else
                <span class="badge bg-success fs-6 p-1">Free</span>
            @endif
        </span>
        <div class="card-body pb-0">
            <div class="d-flex justify-content-between mb-2">
                <a href="#" class="badge bg-purple bg-opacity-10 text-purple" style="font-size: 12px;">All level</a>
                <a href="#" class="h6 fw-light mb-0" style="font-size: 14px;"><i class="far fa-heart"></i></a>
            </div>
            <a href="{{ url('/papers/' . $paper->slug) }}" class="text-decoration-none">
                <h5 class="card-title" style="text-transform: uppercase;">{{ $paper->name }}</h5>
            </a>
            <!--<p class="mb-2 text-truncate-2">{{ $paper->description }}</p>-->
            <div class="d-flex justify-content-between">
                <div><i class="far fa-clock text-danger me-2"></i>{{ $paper->duration }} Min</div>
                <div><i class="fas fa-question-circle text-orange me-2"></i>{{ $paper->totalNoQuestion }} Questions</div>
            </div>
        </div>
        <div class="card-footer pt-0 pb-3">
            <hr>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center">
                    @if($paper->cost == 0)
                        <h5 class="text-success mb-0 fw-bold me-2">₹ Free</h5>
                    @else
                        <h5 class="text-success mb-0 fw-bold me-2">₹ {{ $paper->cost }}</h5>
                        <span class="fw-bold text-dark" style="text-decoration: line-through;">₹ 1599</span>
                    @endif
                </div>
                <x-button :id="$paper->id" :cost="$paper->cost" onclick="buyCourse('{{ $paper->id }}', {{ $paper->cost }})" />
            </div>
        </div>
    </div>
</div>

{{-- <script>
    const currentStudentId = "{{ Auth::guard('student')->user()->id ?? '' }}";
    const siteUrl = document.querySelector('meta[name="site-url"]').content;

    const buyCourse = async (testId, productPrice) => {
        console.log("Attempting to buy course:", { testId, productPrice }); // Debugging line
        
        // Check if the student is logged in
        if (!currentStudentId) {
            localStorage.setItem('intendedUrl', window.location.href);
            return (window.location.href = `${siteUrl}/login`);
        }

        // If productPrice is 0, add directly to the dashboard
        if (productPrice === 0) {
            console.log("Product is free. Adding to dashboard...");
            await addTestToDashboard(testId, productPrice);
        } else {
            // Product price is greater than 0, show an error
            console.log("Product requires payment. Redirecting to payment page...");
            toastr.error("Please pay the course fee to access the test.");
        }
    };

    const addTestToDashboard = async (testId, productPrice) => {
        try {
            const response = await fetch(`${siteUrl}/api/add-test-to-dashboard`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    testId,
                    studentId: currentStudentId,
                    productPrice
                }),
            });

            const { success, message, error } = await response.json();
            if (success) {
                toastr.success(message || 'Test added successfully!');
            } else {
                toastr.error(error || 'Error occurred');
            }
        } catch (err) {
            console.error('Error adding test to dashboard:', err);
            toastr.error('Failed to add test to dashboard. Please try again.');
        }
    };
</script> --}}
