<?php

namespace Dainsys\QAApp\Http\Livewire;

use Dainsys\QAApp\Repositories\FormRepository;
use Dainsys\QAApp\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FilterDashboardForm extends Component
{
    /**
     * Properties to be binded to the query string
     *
     * @var array
     */
    protected $queryString = [
        'user_id' => ['except' => ''],
        'form_id' => ['except' => ''],
    ];
    /**
     * List of qa forms
     *
     * @var Illuminate\Support\Query\Collection;
     */
    public $forms;
    /**
     * List of qa users
     *
     * @var Illuminate\Support\Query\Collection;
     */
    public $users;
    /**
     * Control if the form is shown
     *
     * @var boolean
     */
    public $show_form = false;
    /**
     * User Id Model
     *
     * @var string
     */
    public $user_id = '';
    /**
     * Form Id Model
     *
     * @var string
     */
    public $form_id = '';

    /**
     * Renders the view
     *
     * @return View
     */
    public function render(): View
    {
        return view('qa_app::livewire.filter-dashboard-form');
    }
    /**
     * Component constructor
     *
     * @return void
     */
    public function mount()
    {
        $this->forms = FormRepository::all();
        $this->users = UserRepository::all();
    }
    /**
     * Show filter form, hides floating button
     *
     * @return void
     */
    public function showForm()
    {
        $this->show_form = true;
    }
    /**
     * Hide filter form, shows floating button
     *
     * @return void
     */
    public function hideForm()
    {
        $this->show_form = false;
    }
    /**
     * Listen for the any property is updated. Fires filterFormUpdated event if the property is in the reportables array
     *
     * @param [type] $property
     * @return void
     */
    public function applyFilters()
    {
        $this->emitUp('filterFormUpdated', [
            'user_id' => $this->user_id,
            'form_id' => $this->form_id,
        ]);
    }

    public function resetForm()
    {
        $this->user_id = '';
        $this->form_id = '';

        $this->emitUp('filterFormUpdated', [
            'user_id' => $this->user_id,
            'form_id' => $this->form_id,
        ]);
    }
}
