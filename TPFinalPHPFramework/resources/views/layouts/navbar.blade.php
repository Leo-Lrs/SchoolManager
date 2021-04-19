<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('students.index') }}">Students</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('modules.index') }}">Modules</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('promotions.index') }}">Promotions</a>
      </li>
    </ul>
    <form class="d-flex" style="margin-top: 10px">
      <input class="form-control " name='search' type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>
  </div>
</nav>