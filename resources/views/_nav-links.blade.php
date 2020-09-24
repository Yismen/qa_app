@if (Gate::allows('qa_app.is_admin') || Gate::allows('qa_app.is_auditor') || Gate::allows('qa_app.is_user'))
    <li class="nav-item dropdown">
        <a id="lockyNavDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            QA App
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="lockyNavDropdown">
            @if(auth()->check() && Gate::allows('qa_app.is_user'))
                <a class="dropdown-item" href="{{ route('qa_app.dashboard.user', auth()->user()->id) }}">{{ __('My Dashboard') }}</a>
            @endif
            @if(Gate::allows('qa_app.is_auditor'))
                <a class="dropdown-item" href="{{ route('qa_app.dashboard.admin') }}">{{ __('Dashbaord') }}</a>
                <a class="dropdown-item" href="{{ route('qa_app.audit.index') }}">{{ __('Audits') }}</a>
            @endif
            @if(Gate::allows('qa_app.is_admin'))
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('qa_app.form.index') }}">{{ __('QA Forms') }}</a>
                <a class="dropdown-item" href="{{ route('qa_app.question_type.index') }}">{{ __('Question Types') }}</a>
                <a class="dropdown-item" href="{{ route('qa_app.question_option.index') }}">{{ __('Question Options') }}</a>
                <a class="dropdown-item" href="{{ route('qa_app.question.index') }}">{{ __('Questions') }}</a>
            @endif
        </div>
    </li>
@endif