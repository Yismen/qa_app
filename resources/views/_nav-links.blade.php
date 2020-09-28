@if (Gate::allows('qa_app.is_admin') || Gate::allows('qa_app.is_auditor') || Gate::allows('qa_app.is_user'))
    <li class="nav-item dropdown">
        <a id="lockyNavDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            QA App
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="lockyNavDropdown">
            @if(auth()->check() && Gate::allows('qa_app.is_user'))
                <a class="dropdown-item" href="{{ route('qa_app.dashboard.user', auth()->user()->id) }}">{{ __('qa_app::links.my_dashboard') }}</a>
            @endif
            @if(Gate::allows('qa_app.is_auditor'))
                <a class="dropdown-item" href="{{ route('qa_app.dashboard.admin') }}">{{ __('qa_app::links.app_dashboard') }}</a>
                <a class="dropdown-item" href="{{ route('qa_app.audit.index') }}">{{ __('qa_app::links.audits') }}</a>
            @endif
            @if(Gate::allows('qa_app.is_admin'))
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('qa_app.form.index') }}">{{ __('qa_app::links.qa_form') }}</a>
                <a class="dropdown-item" href="{{ route('qa_app.question_type.index') }}">{{ __("qa_app::links.question_type") }}</a>
                <a class="dropdown-item" href="{{ route('qa_app.question_option.index') }}">{{ __('qa_app::links.question_option') }}</a>
                <a class="dropdown-item" href="{{ route('qa_app.question.index') }}">{{ __('qa_app::links.question') }}</a>
            @endif
        </div>
    </li>
@endif