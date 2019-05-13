@extends('dashboard.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
    <li class="breadcrumb-item active">Index</li>
@endsection

@section('content')

<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
      <div class="row bg-white has-shadow">
        <!-- Item -->
        <div class="col-xl-3 col-sm-6">
          <div class="item d-flex align-items-center">
            <div class="icon bg-violet"><i class="icon-user"></i></div>
            <div class="title"><span>New<br>Clients</span>
              <div class="progress">
                <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
              </div>
            </div>
            <div class="number"><strong>25</strong></div>
          </div>
        </div>
        <!-- Item -->
        <div class="col-xl-3 col-sm-6">
          <div class="item d-flex align-items-center">
            <div class="icon bg-red"><i class="icon-padnote"></i></div>
            <div class="title"><span>Work<br>Orders</span>
              <div class="progress">
                <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
              </div>
            </div>
            <div class="number"><strong>70</strong></div>
          </div>
        </div>
        <!-- Item -->
        <div class="col-xl-3 col-sm-6">
          <div class="item d-flex align-items-center">
            <div class="icon bg-green"><i class="icon-bill"></i></div>
            <div class="title"><span>New<br>Invoices</span>
              <div class="progress">
                <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
              </div>
            </div>
            <div class="number"><strong>44</strong></div>
          </div>
        </div>
        <!-- Item -->
        <div class="col-xl-3 col-sm-6">
          <div class="item d-flex align-items-center">
            <div class="icon bg-orange"><i class="icon-check"></i></div>
            <div class="title"><span>Open<br>Cases</span>
              <div class="progress">
                <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
              </div>
            </div>
            <div class="number"><strong>35</strong></div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection
