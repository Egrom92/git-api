<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use OptimistDigital\NovaSettings\NovaSettings;
use Johnathan\NovaTrumbowyg\NovaTrumbowyg;
use Whitecube\NovaFlexibleContent\Flexible;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        NovaSettings::addSettingsFields([
            Text::make('Подзаголовок', 'description'),
            Text::make('Регистрация место', 'reg_place'),
            Text::make('Ссылка Google map Регистрация место', 'google_reg_place'),
            TimeField::make('Регистрация время', 'reg_time'),
            Text::make('Вечеринка место', 'party_place'),
            Text::make('Ссылка Google map Вечеринка место', 'google_party_place'),
            TimeField::make('Вечеринка время', 'party_time'),
        ], [], 'Home page');

        NovaSettings::addSettingsFields([
            NovaTrumbowyg::make('Our history', 'our_history'),
        ], [], 'Our history');

        NovaSettings::addSettingsFields([
            Flexible::make('Content')
                ->addLayout('Question', 'question', [
                    Text::make('Question'),
                    NovaTrumbowyg::make('Answer')
                ])
        ], [], 'FAQ');

        NovaSettings::addSettingsFields([
            NovaTrumbowyg::make('Gifts'),
        ], [], 'Gifts');

        NovaSettings::addSettingsFields([
            Text::make('Title', 'important_title'),
            NovaTrumbowyg::make('Body', 'important_body'),
        ], [], 'Important');
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new Help,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new \OptimistDigital\NovaSettings\NovaSettings
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
