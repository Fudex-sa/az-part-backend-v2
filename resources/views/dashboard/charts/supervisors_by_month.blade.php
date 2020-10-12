

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');

    var chart = new Chart(ctx, {
        type: 'bar',

        data: {
            labels: ["{{ __('site.January') }}", "{{__('site.February')}}", "{{__('site.March')}}"
                     ,"{{__('site.April')}}", "{{__('site.May')}}", "{{__('site.June')}}"
                     ,"{{__('site.July')}}", "{{__('site.August')}}", "{{__('site.September')}}"
                    , "{{__('site.October')}}", "{{__('site.November')}}", "{{__('site.December')}}"],
                    
            datasets: [{
                label: '{{ __("site.users_registerations") }}',

                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',

                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1 ,
                
                data: [
                    @php
                        for($i = 1 ; $i <= 12 ; $i++){
                            echo  supervisors_by_month($i).',';
                        }
                    @endphp                     
                ],
                
            }]
        },

        options: {}
    });

</script>