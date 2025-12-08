@props(['labels', 'data'])

<div class="bg-white rounded-xl shadow-sm border p-6">
  <h3 class="text-lg font-semibold text-gray-800 mb-4">Most Popular Courses</h3>

  <div id="topCoursesChart" class="w-full h-72"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
  const labels = JSON.parse(`{!! json_encode($labels) !!}`);
  const data = JSON.parse(`{!! json_encode($data) !!}`);

  document.addEventListener("DOMContentLoaded", function() {
    var options = {
      chart: {
        type: 'bar',
        height: 300,
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          distributed: true
        }
      },
      series: [{
        name: 'Enrollments',
        data: data
      }],
      xaxis: {
        categories: labels,
        labels: {
          style: {
            fontSize: '14px'
          },
          formatter: val => val.length > 15 ? val.substring(0, 15) + '…' : val
        }
      },
      yaxis: {
        title: {
          text: 'Enrollments'
        }
      },
      grid: {
        strokeDashArray: 4,
        borderColor: '#e5e7eb'
      },
      dataLabels: {
        enabled: false
      },
      legend: {
        show: false
      },
    };

    var chart = new ApexCharts(
      document.querySelector("#topCoursesChart"),
      options
    );

    chart.render();
  });
</script>