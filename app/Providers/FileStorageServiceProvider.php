<?php
use Illuminate\Support\ServiceProvider;
class FileStorageServiceProvider extends ServiceProvider 
{
    public function register()
    {
        $this->app->bind('AgendaInterface', 'AgendaRepository');
    }
}  