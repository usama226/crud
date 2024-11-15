@if (session('success'))
<div class="container mt-5">


    <!-- Success Alert -->
    <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

   @if (session('error'))
   <!-- Error Alert -->
   <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
       <i class="bi bi-x-circle-fill"></i> {{ session('error') }}
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
</div>
   @endif

<script>
    // Function to dismiss the success alert after 5 seconds
    setTimeout(function() {
        const successAlert = document.getElementById('successAlert');
        if (successAlert) {
            successAlert.classList.remove('show');
            successAlert.classList.add('fade');
        }
    }, 5000); // 5000ms = 5 seconds

    // Function to dismiss the error alert after 5 seconds
    setTimeout(function() {
        const errorAlert = document.getElementById('errorAlert');
        if (errorAlert) {
            errorAlert.classList.remove('show');
            errorAlert.classList.add('fade');
        }
    }, 5000); // 5000ms = 5 seconds
</script>
