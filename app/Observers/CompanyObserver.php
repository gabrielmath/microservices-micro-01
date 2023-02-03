<?php

namespace App\Observers;

use App\Models\Company;

class CompanyObserver
{
    /**
     * Handle the Company "creating" event.
     *
     * @param \App\Models\Company $company
     * @return void
     */
    public function creating(Company $company): void
    {
        $company->url = \Str::slug($company->name, '-');
        $company->uuid = \Str::uuid();
    }

    /**
     * Handle the Company "updating" event.
     *
     * @param \App\Models\Company $company
     * @return void
     */
    public function updating(Company $company): void
    {
        $company->url = \Str::slug($company->name, '-');
    }

    /**
     * Handle the Company "deleted" event.
     *
     * @param \App\Models\Company $company
     * @return void
     */
    public function deleted(Company $company)
    {
        //
    }

    /**
     * Handle the Company "restored" event.
     *
     * @param \App\Models\Company $company
     * @return void
     */
    public function restored(Company $company)
    {
        //
    }

    /**
     * Handle the Company "force deleted" event.
     *
     * @param \App\Models\Company $company
     * @return void
     */
    public function forceDeleted(Company $company)
    {
        //
    }
}
