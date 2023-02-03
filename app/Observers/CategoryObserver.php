<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Handle the Category "creating" event.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function creating(Category $category): void
    {
        $category->url = \Str::slug($category->title, '-');
    }

    /**
     * Handle the Category "updating" event.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function updating(Category $category): void
    {
        $category->url = \Str::slug($category->title, '-');
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
