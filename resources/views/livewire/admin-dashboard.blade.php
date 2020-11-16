<div>    
    <div class="row">
        <div class="col-12"> 
            <div class="card">
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:40vh;">                    
                    {!! $weekly_chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12"> 
            <div class="card">
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:40vh;">                 
                    {!! $monthly_chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('qa_app::filter-dashboard-form', ['show_form' => false], key(Str::random(8)))
    
</div>

@push('scripts')    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $weekly_chart->script() !!}
    {!! $monthly_chart->script() !!}
    <script>
        window.addEventListener('reloadPage', (e) => {
            window.location.reload()
        })
    </script>
@endpush
