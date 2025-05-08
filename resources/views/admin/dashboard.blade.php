<x-app-layout>
  <main id="main" class="main py-4">
    <div class="container">
      <div class="pagetitle mb-4">
        <h1 class="fw-bold text-primary">Admin Dashboard</h1>
      </div>
    
      <section class="section dashboard">
        <div class="row">
          <!-- Cards Row -->
          <div class="col-lg-12">
            <div class="row">
    
              <!-- Categories Count -->
              <div class="col-xxl-4 col-md-6 mb-4">
                <div class="card info-card shadow-sm border-0 rounded-3 h-100">
                  <div class="card-body p-4">
                    <h5 class="card-title text-muted mb-3 border-bottom pb-3">
                      <i class="bi bi-grid-3x3-gap me-2 text-primary"></i>Total Categories
                    </h5>
                    <div class="d-flex align-items-center">
                      <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="bi bi-collection fs-2 text-primary"></i>
                      </div>
                      <div>
                        <h2 class="fw-bold mb-0">{{ $totalcategories }}</h2>
                        <p class="text-muted mb-0">Available product categories</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    
              <!-- Today's Orders -->
              <div class="col-xxl-4 col-md-6 mb-4">
                <div class="card info-card shadow-sm border-0 rounded-3 h-100">
                  <div class="card-body p-4">
                    <h5 class="card-title text-muted mb-3 border-bottom pb-3">
                      <i class="bi bi-cart me-2 text-success"></i>Today's Orders
                    </h5>
                    <div class="d-flex align-items-center">
                      <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="bi bi-bag-check fs-2 text-success"></i>
                      </div>
                      <div>
                        <h2 class="fw-bold mb-0">{{ $todaysOrders }}</h2>
                        <p class="text-muted mb-0">Orders placed today</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    
              <!-- Total Revenue -->
              <div class="col-xxl-4 col-md-6 mb-4">
                <div class="card info-card shadow-sm border-0 rounded-3 h-100">
                  <div class="card-body p-4">
                    <h5 class="card-title text-muted mb-3 border-bottom pb-3">
                      <i class="bi bi-currency-dollar me-2 text-info"></i>Total Revenue
                    </h5>
                    <div class="d-flex align-items-center">
                      <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                        <i class="bi bi-cash-stack fs-2 text-info"></i>
                      </div>
                      <div>
                        <h2 class="fw-bold mb-0">Rs.{{ number_format($totalRevenue ?? 0, 2) }}</h2>
                        <p class="text-muted mb-0">Overall earnings</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    
            </div>
          </div>
    
          <div class="row">
            <!-- Pie Chart -->
            <div class="col-lg-6 mb-4">
              <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                  <h5 class="card-title fw-bold mb-4 border-bottom pb-3">
                    <i class="bi bi-pie-chart me-2 text-primary"></i>Order Distribution
                  </h5>
                  <div class="chart-container" style="position: relative; height: 300px;">
                    <canvas id="orderPieChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Recent Orders -->
            <div class="col-lg-6 mb-4">
              <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                  <h5 class="card-title fw-bold mb-4 border-bottom pb-3">
                    <i class="bi bi-clock-history me-2 text-primary"></i>Recent Orders
                  </h5>
                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                      <thead class="table-light">
                        <tr>
                          <th>Order ID</th>
                          <th>Customer</th>
                          <th>Status</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($recentOrders) && count($recentOrders) > 0)
                          @foreach($recentOrders as $order)
                            <tr>
                              <td>#{{ $order->id }}</td>
                              <td>{{ $order->user->name ?? 'Guest' }}</td>
                              <td>
                                <span class="badge bg-{{ $order->payment_status == 'completed' ? 'success' : ($order->payment_status == 'pending' ? 'warning' : 'info') }}">
                                  {{ ucfirst($order->payment_status) }}
                                </span>
                              </td>
                              <td>Rs.{{ number_format($order->total_price, 2) }}</td>
                            </tr>
                          @endforeach
                        @else
                          <tr>
                            <td colspan="4" class="text-center py-3">No recent orders found</td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
  
  {{-- Chart.js Script --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const ctx = document.getElementById('orderPieChart');
      new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['Today\'s Orders', 'Previous Orders'],
          datasets: [{
            label: 'Orders',
            data: [{{ $todaysOrders }}, 100 - {{ $todaysOrders }}],
            backgroundColor: ['#4CAF50', '#f0f0f0'],
            borderColor: ['#4CAF50', '#f0f0f0'],
            borderWidth: 1,
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                usePointStyle: true,
                padding: 20
              }
            }
          },
          cutout: '65%'
        }
      });
    });
  </script>
</x-app-layout>