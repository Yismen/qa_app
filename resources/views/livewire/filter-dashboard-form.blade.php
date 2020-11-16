<div>    
    @if ($show_form)
        <form style="bottom: 35px; right: 50px;" class="badge-dark p-4 position-fixed w-25" wire:submit.prevent="applyFilters">
            <h6>
                {{ __('qa_app::messages.filter_audit') }}
                <button class="btn btn-sm btn-outline-light float-right font-weight-bold p-2 py-0 text-white" wire:click.prevent="hideForm" title="Minimize">-</button>
            </h6>
            <div class="form-group">
            <label for="form_id">{{ __('qa_app::messages.form') }}:</label>
            <select class="form-control" name="form_id" id="form_id" wire:model="form_id">
                <option value="">{{ __('qa_app::messages.all') }}</option>
                @foreach ($forms as $form)
                    <option value="{{ $form->id }}" wire:key="{{ $form->id }}">{{ $form->name }}</option>
                @endforeach
            </select>
            </div>

            <div class="form-group">
                <label for="user_id">{{ __('qa_app::messages.user') }}:</label>
                <select class="form-control" name="user_id" id="user_id" wire:model="user_id">
                    <option value="">{{ __('qa_app::messages.all') }}</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" wire:key="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-outline text-light border">{{ __('qa_app::messages.filter') }}</button>
            <button class="btn btn-warning float-right" wire:click.prevent="resetForm">{{ __('qa_app::messages.reset') }}</button>
        </form> 
    @else
        <div style="bottom: 35px; right: 50px;" class=" position-fixed ">
            <button class="badge-dark p-4 rounded-circle btn btn-outline-secondary" wire:click.prevent="showForm">{{ __('qa_app::messages.filter') }}</button>
        </div>
    @endif  
</div>
