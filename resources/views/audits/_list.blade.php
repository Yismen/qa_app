<div class="card">
    <div class="card-header bg-white">
        <h4>{{ __('qa_app::audit.list.header') }}</h4>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm table-inverse mb-0">
                <thead class="thead-inverse">
                    <tr>
                        <th>{{ __('qa_app::labels.production_date') }}</th>
                        <th>{{ __('qa_app::labels.user') }}</th>
                        <th>{{ __('qa_app::labels.qa_form') }}</th>
                        <th>{{ __('qa_app::labels.points_reached') }}</th>
                        <th>{{ __('qa_app::labels.pass_fail') }}</th>
                        <th colspan="2">{{ __('qa_app::labels.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($audits as $audit)
                        <tr class="{{ $audit->passes  ? '' : 'text-danger'}}">
                            <td scope="row">
                                {{-- <a href="{{ route('qa_app.dashboard.admin', ['production_date' => $audit->production_date->format('Y-m-d')]) }}" target="__dashboard">
                                    {{ $audit->production_date->format('Y-M-d') }}
                                </a> --}}
                                
                                {{ $audit->production_date->format('Y-M-d') }}
                            </td>
                            <td>
                                <a href="{{ route('qa_app.dashboard.admin', ['user_id' => $audit->user->id]) }}" target="__dashboard">
                                    {{ $audit->user->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('qa_app.dashboard.admin', ['form_id' => $audit->form->id]) }}" target="__dashboard">
                                    {{ $audit->form->name }}
                                </a>
                            </td>
                            <td>
                                {{ number_format($audit->points, 2) }}
                            </td>
                            <td>
                                {{ $audit->passes ? __('qa_app::labels.passed') : __('qa_app::labels.failed') }}
                            </td>
                            <td>
                                <a href="{{ route('qa_app.audit.show', $audit->id) }}" class="btn btn-secondary btn-sm">
                                    {{ __('qa_app::labels.details') }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('qa_app.audit.edit', $audit->id) }}" class="btn btn-warning btn-sm">
                                    {{ __('qa_app::labels.edit') }}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
    @if ($audits->hasPages())
        <div class="card-footer bg-white p-2">{{ $audits->links() }}</div>
    @endif
</div>