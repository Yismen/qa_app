<div class="card mb-2">
    <div class="card-header bg-white">Weekly QA Results</div>
    <div class="card-body">
        @include('qa_app::audits._table-results')
    </div>
</div>
<div class="card mb-2">
    <div class="card-header bg-white">Monthly QA Results</div>
    <div class="card-body">
        @include('qa_app::audits._table-results')
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="card mb-2">
            <div class="card-header bg-white">Latest Top 10 Results</div>
            <div class="card-body">
                @include('qa_app::audits._table-results')
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="card mb-2">
            <div class="card-header bg-white">Latest Bottom 10 Results</div>
            <div class="card-body">
                @include('qa_app::audits._table-results')
            </div>
        </div>
    </div>
</div>