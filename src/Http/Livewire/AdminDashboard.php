<?php

namespace Dainsys\QAApp\Http\Livewire;

use Dainsys\QAApp\Repositories\Dashboard\Monthly;
use Dainsys\QAApp\Repositories\Dashboard\Weekly;
use Livewire\Component;

class AdminDashboard extends Component
{
    protected function getListeners()
    {
        return [
            'filterFormUpdated' => 'reRender'
        ];
    }

    public function render()
    {
        return view('qa_app::livewire.admin-dashboard', [
            'weekly_chart' => Weekly::chart(),
            'monthly_chart' => Monthly::chart(),
        ]);
    }

    public function reRender($payload)
    {
        request()->merge($payload);

        $this->dispatchBrowserEvent('reloadPage');
    }
}
