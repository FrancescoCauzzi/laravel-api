<div class="container-fluid px-5 bg-black __footer">
    <div class="d-flex flex-wrap justify-content-between align-items-center py-3 ">
      <p class="col-md-4 mb-0 text-white fw-bold">© <?php
        // Get the current timestamp
        $timestamp = time();
        // Format the timestamp as a date string using the date() function
        //$date = date('Y-m-d', $timestamp);
        // Get the current year
        $year = date('Y', $timestamp);
        // Output the year string
        echo $year;

        ?> Company, Inc</p>

      <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <div class="logo_boolean">
            <img src="{{Vite::asset('resources/img/boolean-logo.png')}}" alt="">
        </div>

      </a>

      <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="{{url('/')}}" class="nav-link px-2 text-white fw-bold">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-white fw-bold">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-white fw-bold">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-white fw-bold">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-white fw-bold">About</a></li>
      </ul>
    </footer>
  </div>
