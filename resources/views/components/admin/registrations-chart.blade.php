@props(['labels', 'data'])

<div class="bg-white rounded-xl shadow-sm border p-6">
  <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('admin.registrations_this_week') }}</h3>

  <div id="registrationsChart" class="w-full h-72"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
  const chartLabels = JSON.parse(`{!! json_encode($labels) !!}`);
  const chartData = JSON.parse(`{!! json_encode($data) !!}`);
  document.addEventListener("DOMContentLoaded", function() {
    var options = {
      chart: {
        type: 'area',
        height: 300,
        toolbar: {
          show: false
        }
      },
      series: [{
        name: 'Registrations',
        data: chartData,
      }],
      xaxis: {
        categories: chartLabels,
        labels: {
          style: {
            fontSize: '14px'
          }
        }
      },
      dataLabels: {
        enabled: false
      },
      grid: {
        strokeDashArray: 4,
        borderColor: '#e5e7eb'
      },
      yaxis: {

        min: 0,
        labels: {
          style: {
            fontSize: '14px'
          }
        }
      },

    };

    var chart = new ApexCharts(
      document.querySelector("#registrationsChart"),
      options
    );

    chart.render();
  });
</script>